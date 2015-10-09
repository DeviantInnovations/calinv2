<?php
 

 
class MemberController extends BaseController {
 
 
  public function edit($member_id)
  {


      $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      {
        Session::put('msgfail', 'Failed to find member.');
         return Redirect::back();
      }

    $rules = array(
      'username'    => 'required|alphaNum|min:3|max:20', 
      'email'    => 'required|email|min:3|max:100',
      'name'    => 'required|min:3|max:100',
      

    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {
       
    

        $user = User::find($member_id);

        if(Input::get('username')!= $user->username)
        $user->username = strip_tags(Input::get('username'));

        if(Input::get('email')!=$user->email)
        $user->email = strip_tags(Input::get('email'));

        $user->name = strip_tags(Input::get('name'));

        $user->type = $user->type;
        $user->save();

        
        Session::put('msgsuccess', 'Successfully edited user.');
       

        return Redirect::to('/admin/members');

    }
  }
 



  public function deactivate($member_id)
  {

       $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($member_id);
      
        $member->status = 0;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully deactivated user.');
       
        return Redirect::to("/admin/members");

    
  }


  public function activate($member_id)
  {

       $exist = User::where('id', $member_id)->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find user.');
         return Redirect::back()->withInput();
      }

        $member = User::find($member_id);
      
        $member->status = 1;

        $member->save();

      
        Session::put('msgsuccess', 'Successfully activated user.');
       
        return Redirect::to("/admin/members");

    
  }
  public function resetPassword()
  {

       $exist = User::where('email', Input::get('email'))->count();

      if($exist == 0)
      { 
         Session::put('msgfail', 'Fail to find email.');
         return Redirect::back()->withInput();
      }

        $user =User::where('email', Input::get('email'))->first();
        $member = User::find($user->id);
        $pass = substr(md5(uniqid(rand(), true)), 16, 16);
        $member->password = Hash::make($pass);

        $member->save();
                   $message->to(Input::get('email'), 'CAL Inventory')->subject('Your password has been reset.');

        Session::put('userPassword', $pass);
        
        Mail::send('emails.password_reset', array('key' => 'value'), function($message)
               {
                   $message->from('calinv@gmail.com', 'CAL Inventory');
               });
      
        Session::put('msgsuccess', 'Your new password has been sent to your email.');
       
        
      
        return Redirect::to("/");

    
  }

  public function editProfile()
  {


    $rules = array(
      'username'    => 'required|alphaNum|min:3|max:20', 
      'email'    => 'required|email|min:3|max:100',
      'name'    => 'required|min:3|max:100',
    );
    $validator = Validator::make(Input::all(), $rules);

  
    if ($validator->fails()) {
      
        Session::put('msgfail', 'Invalid input.');
         return Redirect::back()
         ->withErrors($validator)
          ->withInput(); 
    } 
    else {
       
    

        $user = User::find(Auth::user()->id);

        if(Input::get('username')!= $user->username)
        $user->username = strip_tags(Input::get('username'));

        if(Input::get('email')!=$user->email)
        $user->email = strip_tags(Input::get('email'));

        $user->name = strip_tags(Input::get('name'));
        $user->type = $user->type;

        $user->save();

        
        Session::put('msgsuccess', 'Successfully edited profile.');
       

        return Redirect::to('/edit/account');

    }
  }
 
 
}