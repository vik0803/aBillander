<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\ContactMessage as ContactMessage;
use View;

class ContactMessagesController extends Controller {


   protected $comment;

   public function __construct(ContactMessage $comment)
   {
        $this->comment = $comment;
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// Poor Man validation
		// $this->validate($request, ContactMessage::$rules);
		// if ($validation->fails())
		if ( !$request->get('notes'))
		{
			$return = '';
			// foreach ($validation->errors()->all() as $err) {
			$return .= '<li class="error">' . l('The Comments field is required.', [], 'layouts') . '</li>';
			// }
			return $return;
		}

		$comment = $this->comment->create($request->all());
/*
		$send = Mail::send('ajaxemail', array('message' => Input::get('message')), function($message)
			{
				$message->to(Input::get('to'))
				->replyTo(Input::get('from'))
				->subject(Input::get('subject'));
			}
		);
		return $send;

		 \Mail::send('emails.contact',
	        array(
	            'name' => $request->get('name'),
	            'email' => $request->get('email'),
	            'user_message' => $request->get('message')
	        ), function($message)
	    {
	        $message->from('wj@wjgilmore.com');
	        $message->to('wj@wjgilmore.com', 'Admin')->subject('TODOParrot Feedback');
	    });
*/
		return 1;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
