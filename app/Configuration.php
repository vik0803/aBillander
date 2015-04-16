<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model 
{
    protected $fillable = [ 'name', 'value' ];

	public static $rules = [
        'name' => 'required',
    ];

	/** @var array Configuration cache */
	protected static $_CONF;


	public static function loadConfiguration()
	{
		self::$_CONF = array();

		$results = Configuration::All();

		if ($results->count())
			foreach ($results as $result)
			{
				self::$_CONF[$result->name] = $result->value;
			}
	}

	/**
	  * Update configuration key and value into database (automatically insert if key does not exist)
	  *
	  * @param string $key Key
	  * @param mixed $values $values is an array if the configuration is multilingual, a single string else.
	  * @param boolean $html Specify if html is authorized in value
		*
	  * @return boolean Update result
	  */
	public static function updateValue($key, $values, $html = false)
	{
		// if (!Validate::isConfigName($key))
	 	// 	die(Tools::displayError());

		$current_value = Configuration::get($key);

		/* Update classic values */
		
			/* If the current value exists but the _CONF_IDS[$key] does not, it mean the value has been set but not save, we need to add */
		 	if ( $current_value !== false )
		 	{
		 		$values = pSQL($values, $html);

				/* Do not update the database if the current value is the same one than the new one */
				if ($values == $current_value)
					$result = true;
				else
				{
					$model = Configuration::where('name', '=', $key)->firstOrFail();
					$model->value = $values;

					// $result = $db->AutoExecute(_DB_PREFIX_.'configuration', 
					// 	array('value' => $values, 'date_upd' => date('Y-m-d H:i:s')),
					// 	'UPDATE', '`id_configuration` = '.(int)self::$_CONF_IDS[$key], true, true);
					// if ($result)
					if ($result=$model->save())
						self::$_CONF[$key] = stripslashes($values);
				}
			}
			// If key does not exists, create it
			else
			{
				$result = self::_addConfiguration($key, $values);
				if ($result)
				{
					self::$_CONF[$key] = stripslashes($values);   // Configuration::set($key, $values, $id_shop_group, $id_shop);
				}
			}
	
		return (bool)$result;
	}

	/**
	  * Get a single configuration value (in one language only)
	  *
	  * @param string $key Key wanted
	  * @param integer $id_lang Language ID
	  * @return string Value
	  */
	public static function get($key, $id_lang = null)
	{
		if (!self::$_CONF)
		{
			Configuration::loadConfiguration();
			// If conf if not initialized, try manual query
//			if (!self::$_CONF)
//				return Db::getInstance()->getValue('SELECT `value` FROM `'._DB_PREFIX_.'configuration` WHERE `name` = "'.pSQL($key).'"');
		}
		if (isset(self::$_CONF[$key]))
			return self::$_CONF[$key];
		return false;
	}

	/**
	  * Get several configuration values 
	  *
	  * @param array $keys Keys wanted
	  * @param integer $id_lang Language ID
	  * @return array Values
	  */
	public static function getMultiple($keys)
	{
	 	if (!is_array($keys) || !is_array(self::$_CONF) || ($id_lang && !is_array(self::$_CONF_LANG)))
	 		die(Tools::displayError());

		$resTab = array();
		if (!$id_lang)
			foreach ($keys as $key)
				if (array_key_exists($key, self::$_CONF))
					$resTab[$key] = self::$_CONF[$key];
		elseif (array_key_exists($id_lang, self::$_CONF_LANG))
			foreach ($keys as $key)
				if (array_key_exists($key, self::$_CONF_LANG[(int)$id_lang]))
					$resTab[$key] = self::$_CONF_LANG[(int)($id_lang)][$key];
		return $resTab;
	}

	/**
	  * Set TEMPORARY a single configuration value
	  *
	  * @param string $key Key wanted
	  * @param mixed $values $values is an array if the configuration is multilingual, a single string else.
		*
	  */
	public static function set($key, $values)
	{
		// if (!Validate::isConfigName($key))
	 	//	die(Tools::displayError());

	 	/* Update classic values */
		self::$_CONF[$key] = $values;
	}

	/**
	  * Insert configuration key and value into database
	  *
	  * @param string $key Key
	  * @param string $value Value
	  * @eturn boolean Insert result
	  */
	protected static function _addConfiguration($key, $value = null)
	{
		$newConfig = new Configuration();
		$newConfig->name = $key;
		if (!is_null($value))
			$newConfig->value = $value;
		return $newConfig->save() ? intval( $newConfig->id ) : false;
	}

	/**
	  * Delete a configuration key in database 
	  *
	  * @param string $key Key to delete
	  * @return boolean Deletion result
	  */
	public static function deleteByName($key)
	{
		// If the key is invalid or if it does not exists, do nothing.
	 	// if (!Validate::isConfigName($key))
		// 	return false;

		/* Delete the key from the main configuration table */
		// if (Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'configuration` WHERE `id_configuration` = '.(int)self::$_CONF_IDS[$key].' LIMIT 1'))
		// 	unset(self::$_CONF[$key]);		// self::$_CONF = null;
		// else
		// 	return false;
		
		$model = Configuration::where('name', '=', $key)->firstOrFail();
		if ($model->delete())
			unset(self::$_CONF[$key]);		// self::$_CONF = null;
		else
			return false;

		return true;
	}
}



if (!defined('_PS_MAGIC_QUOTES_GPC_'))
	define('_PS_MAGIC_QUOTES_GPC_',         get_magic_quotes_gpc());
	
if (!defined('_PS_MYSQL_REAL_ESCAPE_STRING_'))
	define('_PS_MYSQL_REAL_ESCAPE_STRING_', function_exists('mysql_real_escape_string'));


/**
 * Sanitize data which will be injected into SQL query
 *
 * @param string $string SQL data which will be injected into SQL query
 * @param boolean $htmlOK Does data contain HTML code ? (optional)
 * @return string Sanitized data
 */
function pSQL($string, $htmlOK = false)
{
	if (_PS_MAGIC_QUOTES_GPC_)
		$string = stripslashes($string);

	if (!is_numeric($string))
	{
		$string = _PS_MYSQL_REAL_ESCAPE_STRING_ ? mysql_real_escape_string($string) : addslashes($string);
		if (!$htmlOK)
			$string = strip_tags(nl2br2($string));
	}

	return $string;
}

function bqSQL($string)
{
	return str_replace('`', '\`', pSQL($string));
}

/**
 * Convert \n and \r\n and \r to <br />
 *
 * @param string $string String to transform
 * @return string New string
 */
function nl2br2($string)
{
	return str_replace(array("\r\n", "\r", "\n"), '<br />', $string);
}

