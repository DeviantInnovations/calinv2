
@extends('layouts.main')

@section('title')
    Browse Inventory
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
                    Search Results
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Code</th>
                <th>Detail</th>
                <th>Yards</th>
                <th>Rolls</th>

            </tr>
        </thead>
        <tbody>

     @if(Session::get('noresults'))
    <tr>
        <td colspan='6'>
        <center>{{ Session::get('noresults') }}</center>
        </td>
    </tr>
      {{ Session::forget('noresults') }}
    @endif

            @foreach($fabrics as $fabric)

           
                <tr >
                    <td>{{ $fabric->code  }}</td>
                    <td>{{ $fabric->details  }}</td>
                    
                    <td>
                       <?php
                        $sumYards = Roll::where("fabric_id",$fabric->id)->sum("yards");
                        $rollCount = Roll::where("fabric_id",$fabric->id)->count();
                        ?>
                        {{$sumYards}}
                    </td>
                    <td>
                        {{$rollCount}}
                    </td>
                    <td>

                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="{{ '#rolls_' . $fabric->id }}"  data-toggle="tooltip" data-placement="top"  title="View">View</button>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $fabrics->links(); }}</center>
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

 @foreach($fabrics as $fabric)
    <?php 
        $modalName = "rolls";
        
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $fabric->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">{{$fabric->code}} View </b>
                </div>
                <div class="modal-body">
                    <font color="black">

<div class="panel-heading" align='center'>
                    Rolls
                </div>

                <div align="center">
                        <a href="{{asset('uploads/fabric/'.$fabric->file)}}" data-lightbox="{{$fabric->code}}" title="{{$fabric->code}}">
                        <img class="img-thumbnail" src="{{asset('uploads/fabric/'.$fabric->file)}}" style="width: 80px; height: 80px;" />
                    </div>
                    <br>
    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Code</th>
                <th>Yards</th>
                

            </tr>
        </thead>
        <tbody>
            <?php $rolls = Roll::where('fabric_id', $fabric->id)->get()?>
            @foreach($rolls as $roll)

                <tr >
                    <td>{{ $roll->code  }}</td>
                    <td>
                      {{$roll->yards}}
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>

    </div>
    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        
            <?php
                        $sumYards = Roll::where("fabric_id",$fabric->id)->sum("yards");
                        $rollCount = Roll::where("fabric_id",$fabric->id)->count();
                        ?>
            <tr>
                <th>Total Yards</th>
                <th>{{$sumYards}}</th>
                

            </tr>

            <tr>
                
                <th>Total Rolls</th>
                <th>{{$rollCount}}</th>
                

            </tr>

    </table>

    </div>
            </font>
                </div>
                
            </div>
        </div>
    </div> 
@endforeach

@stop