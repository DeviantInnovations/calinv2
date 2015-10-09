
@extends('layouts.main')

@section('title')
    Account Settings
@stop

@section('main')


<div class="row">
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

    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form', 'METHOD'=> 'POST', 'action' => '/edit/account')) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Edit Account
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      <div class="form-group @if ($errors->has('name')) has-error @endif">
         
                {{ Form::text('name', $member->name, array('class' => 'form-control', 'placeholder' => 'Name','maxlength'=>'255')) }}
       
                @if ($errors->has('name')) 
                    <p class="help-block">{{ $errors->first('name') }}</p> 
                @endif
        </div>
                 
        <div class="form-group @if ($errors->has('username')) has-error @endif">
       
                {{ Form::text('username', $member->username, array('class' => 'form-control  ', 'placeholder' => 'Username','maxlength'=>'255')) }}
  
            @if ($errors->has('username')) 
                <p class="help-block">{{ $errors->first('username') }}</p>  
            @endif

        </div>

        
        <div class="form-group @if ($errors->has('email')) has-error @endif">
         
                {{ Form::input('email','email', $member->email, array('class' => 'form-control', 'placeholder' => 'Email','maxlength'=>'255')) }}
       
                @if ($errors->has('email')) 
                    <p class="help-block">{{ $errors->first('email') }}</p> 
                @endif
        </div>
                   
        
                   
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$member->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/" class="btn btn-danger sbmt-b">Cancel</a>
     
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
