@extends('layouts/main')

@section('title')
CAL Inventory
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
            <div class='list-group col-md-12'  >
                <a class='list-group-item active'>User Info</a>
                <a class='list-group-item'><b>Name: </b> {{$user->name}}</a>
                <a class='list-group-item'><b>Email: </b> {{$user->email}}</a>
            </div>
        </div>

                        
        <div class="col-lg-6">
        <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Transactions
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">

    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Fabric</th>
                <th>Roll</th>
                <th>Details</th>
                <th>Date</th>

            </tr>
        </thead>
        <tbody>

 
            @foreach($transactions as $transaction)

                <tr >
                    <?php 

                    $created = new Carbon($transaction->updated_at);
                   
                    ?>
                    <td> {{$transaction->fabric_code}}</td>
                    <td> {{$transaction->roll_code}}   </td>
                    <td>
                        @if($transaction->type=="DEBIT")
                        Debited
                        @elseif($transaction->type=="CREDIT")
                        Credited
                        @endif
                        {{$transaction->change}}
                        
                    </td>
                    <td>{{$transaction->updated_at}}</td>
                   

                </tr>

            @endforeach
        </tbody>
    </table>


    </div>

   
</div>
</div>
</div>
</div>
   
        </div>
    </div>

    <div class="row">
        {{ Form::open(array('class' => 'form-signin', 'role' => 'form', 'action' => 'reports' )) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Report Generator
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
         <div class="form-group @if ($errors->has('type')) has-error @endif">
                <label>Type</label>
                {{Form::select('type', array('DEBIT' => 'Debit', 'CREDIT' => 'Credit'));}}
       
            @if ($errors->has('type')) 
                <p class="help-block">{{ $errors->first('type') }}</p>  
            @endif

        </div>
      
        <div class="form-group @if ($errors->has('month')) has-error @endif">
                <label>Month</label>
                {{ Form::selectMonth('month') }}
       
            @if ($errors->has('month')) 
                <p class="help-block">{{ $errors->first('month') }}</p>  
            @endif

        </div>
       <div class="form-group @if ($errors->has('year')) has-error @endif">
                <label>Year</label>
                {{ Form::selectYear('year', 2015, date("Y")) }}
       
            @if ($errors->has('year')) 
                <p class="help-block">{{ $errors->first('year') }}</p>  
            @endif

        </div>

        <div class="col-lg-12" align="center">
            <input type="submit" class="btn btn-success left-sbs sbmt" value="Generate"> 
        </div>
        {{ Form::close(); }}
    </div>
   
@stop

@section('footer')

@stop