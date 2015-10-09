
@extends('layouts.main')

@section('title')
    Fabric Management
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

    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form', 'files' => true)) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Edit Fabric
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      

         <div class="form-group @if ($errors->has('code')) has-error @endif">
            <input type="hidden" name="id" value="{{$fabric->id}}">
                {{ Form::text('code', $fabric->code, array('class' => 'form-control  ', 'placeholder' => 'Code','maxlength'=>'255')) }}
      
            @if ($errors->has('code')) 
                <p class="help-block">{{ $errors->first('code') }}</p>  
            @endif

        </div>

        <div class="form-group @if ($errors->has('details')) has-error @endif">
        
                {{ Form::text('details',$fabric->details, array('class' => 'form-control  ', 'placeholder' => 'Details','maxlength'=>'255')) }}
       
            @if ($errors->has('details')) 
                <p class="help-block">{{ $errors->first('details') }}</p>  
            @endif

        </div>
        <div class="form-group <?php if($errors->first('file'))
              echo 'row has-error has-feedback'
              ?>" >
   
                <input type="file" class="form-control" id="file" name="file" >
           
              
        </div>
       
      
        <div class="col-lg-12" align="center">
            <input type="hidden" name="id" value="{{$fabric->id}}">
        {{ Form::submit('Save', ['class' => 'btn btn-success left-sbs sbmt']) }}
        <a href="/admin/fabrics" class="btn btn-danger sbmt-b">Cancel</a>
        </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







@stop
