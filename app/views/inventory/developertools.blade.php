@extends('layouts/main')

@section('title')
Developer Tools
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



<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading" align='center'>
                    CalInv Developer Online Repository
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12" align="center">

                <div style="width: auto; max-width: 600px;">

                    <div class="github-widget" data-repo="DeviantInnovations/calinv2"></div>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading" align='center'>
                    How to Update the System?
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12" align="center">
                <p>

                </p>
   
                </div>
            </div>
        </div>
    </div>
</div>

</div>
   
@stop

@section('footer')

@stop