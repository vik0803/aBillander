<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use Hash;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'firstname', 'lastname', 
						   'home_page', 'is_admin', 'active', 'language_id'];

	/**
	 * Validation rules
	 * 
	 */
    public static $rules = array(
    	'email'       => array('required', 'email'),
    	'password'    => array('required', 'min:2', 'max:32'),
        'language_id' => 'exists:languages,id',
    );


	/**
	 * Protect Password on Model update
	 * 
	 */
    public function setPasswordAttribute($value)
    {
		if( !empty($value)) 
		{
			$this->attributes['password'] = Hash::make($value);
		}

	}

//	public function getPasswordAttribute($value)
//	{
//	    return "";
//	}

	/**
	 * Handy method
	 * 
	 */
	public function getFullName()
	{
		return $this->firstname.' '.$this->lastname;
	}

	/**
	 * Handy method
	 * 
	 */
	public function isAdmin()
	{
		return $this->is_admin;
	}



    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function language()
    {
        return $this->belongsTo('App\Language');
    }

}
