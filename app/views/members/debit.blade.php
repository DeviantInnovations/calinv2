
@extends('layouts.main')

@section('title')
    Debit
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
    
    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form', )) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Debit
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      
        <div class="form-group @if ($errors->has('code')) has-error @endif">
          
                {{ Form::text('code',Session::get('code'), array('class' => 'form-control  ', 'placeholder' => 'Roll Code','maxlength'=>'50')) }}
       
            @if ($errors->has('code')) 
                <p class="help-block">{{ $errors->first('code') }}</p>  
            @endif

        </div>
        <div class="form-group @if ($errors->has('yards')) has-error @endif">
          
                {{ Form::text('yards',Session::get('yards'), array('class' => 'form-control  ', 'placeholder' => 'Yards','maxlength'=>'50')) }}
       
            @if ($errors->has('yards')) 
                <p class="help-block">{{ $errors->first('yards') }}</p>  
            @endif

        </div>

        <div class="col-lg-12" align="center">
            <input type="submit" class="btn btn-success left-sbs sbmt" value="Credit"> 
        </div>
        {{ Form::close(); }}
   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop

@section('dialogs')

@stop