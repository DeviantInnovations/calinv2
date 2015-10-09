
@extends('layouts/external')



@section('main')

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		   {{ Form::open(array('class' => 'form-login', 'role' => 'form')) }}
    
		        <h2 class="form-login-heading">Registration</h2>
		        <div class="login-wrap">

 @if(Session::get('msgsuccess'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgsuccess') }}</center>
      </div>
      {{ Session::forget('msgsuccess') }}
    @endif
    @if(Session::get('msgfail'))
      <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgfail') }}</center>
      </div>
      {{ Session::forget('msgfail') }}
    @endif
		       	
   
    	 <div class="form-group @if ($errors->has('name')) has-error @endif">
         
                {{ Form::text('name', Session::get('name'), array('class' => 'form-control', 'placeholder' => 'Name','maxlength'=>'255')) }}
       
                @if ($errors->has('name')) 
                    <p class="help-block">{{ $errors->first('name') }}</p> 
                @endif
        </div>
		         
		<div class="form-group @if ($errors->has('username')) has-error @endif">
       
                {{ Form::text('username',Session::get('username'), array('class' => 'form-control  ', 'placeholder' => 'Username','maxlength'=>'255')) }}
  
            @if ($errors->has('username')) 
                <p class="help-block">{{ $errors->first('username') }}</p>  
            @endif

        </div>

        <div class="form-group @if ($errors->has('password')) has-error @endif">
       
                <input name="password" type="password" class="form-control" placeholder="Password" maxlength="255">
           
                @if ($errors->has('password')) 
                    <p class="help-block">{{ $errors->first('password') }}</p> 
                @endif
        </div>
        <div class="form-group @if ($errors->has('password')) has-error @endif">
          
                <input name="password_confirmation" type="password" class="form-control" placeholder="Retype Password" maxlength="255">
                
        
               
        </div>
        <div class="form-group @if ($errors->has('email')) has-error @endif">
         
                {{ Form::email('email', Session::get('email'), array('class' => 'form-control', 'placeholder' => 'Email','maxlength'=>'255')) }}
       
                @if ($errors->has('email')) 
                    <p class="help-block">{{ $errors->first('email') }}</p> 
                @endif
        </div>
		           


		            <br>
		            {{ Form::submit('Register', ['class' => 'btn btn-theme btn-block']) }}
		           
		            <hr>
		            <div class="registration">
		                Already have an account?<br/>
		                <a class="" href="/login">
		                    Login Existing Account
		                </a>
		            </div>
	  	
		        </div>
	
		     	  {{ Form::close() }}	
	  	
	  	</div>
	  </div>


@stop
  