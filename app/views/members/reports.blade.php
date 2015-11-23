
@extends('layouts.main')

@section('title')
    Report
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
                    Report
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Code</th>
                @if($type=="DEBIT")
                <th>Debited Yards</th>
                @else
                <th>Credited Yards</th>
                @endif

            </tr>
        </thead>
        <tbody>

     

            @foreach($reports as $report)

           
                <tr >
                    <td>{{ $report->fabric_code  }}</td>
                    @if($type=="DEBIT")
                    <th>{{ $report->debit  }}</th>
                    @else
                    <th>{{ $report->credit  }}</th>
                    @endif
                   
                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $reports->links(); }}</center>
    </div>

   
</div>
</div>
</div>
</div>
</div>
    
    <div class="col-lg-6">
            
    </div>
    
</div>


@stop

@section('dialogs')


@stop