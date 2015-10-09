
@extends('layouts.main')

@section('title')
    Fabrics Management
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
                    Fabrics
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Code</th>
                <th>Details</th>
                <th>Image</th>
                <th>Action </th>

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
                    <td><a href="{{asset('uploads/fabric/'.$fabric->file)}}" data-lightbox="{{$fabric->code}}" title="{{$fabric->code}}">
                        <img class="img-thumbnail" src="{{asset('uploads/fabric/'.$fabric->file)}}" style="width: 80px; height: 80px;" /></td>
                   
                    <td>
                        <a href="/admin/fabrics/edit/{{$fabric->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                         
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#delete_' . $fabric->id }}"  data-toggle="tooltip" data-placement="top"  title="Delete Fabric"><i class="fa fa-times"></i></button>
                        <br>
                        <br>
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="{{ '#rolls_' . $fabric->id }}"  data-toggle="tooltip" data-placement="top"  title="Rolls">Rolls</button>

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
    
    
    {{ Form::open(array('class' => 'form-signin', 'role' => 'form', 'method' => 'POST', 'files' => true)) }}
   

        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Add Fabric
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
        
      

        <div class="form-group @if ($errors->has('code')) has-error @endif">
        
                {{ Form::text('code',Session::get('code'), array('class' => 'form-control  ', 'placeholder' => 'Code','maxlength'=>'255')) }}
      
            @if ($errors->has('code')) 
                <p class="help-block">{{ $errors->first('code') }}</p>  
            @endif

        </div>

        <div class="form-group @if ($errors->has('details')) has-error @endif">
        
                {{ Form::text('details',Session::get('details'), array('class' => 'form-control  ', 'placeholder' => 'Details','maxlength'=>'255')) }}
       
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
            <input type="submit" class="btn btn-success left-sbs sbmt" value="Add">
      
     
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
@foreach($fabrics as $fabric)
    <?php 
        $modalName = "delete";
        $message = "Are you sure you want to delete fabric {$fabric->code} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $fabric->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Delete Fabric</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/fabrics/delete/{{$fabric->id}}" class="btn btn-warning" id="confirm">Delete Fabric </a>
                </div>
            </div>
        </div>
    </div> 

    <?php 
        $modalName = "rolls";
        
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $fabric->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">{{$fabric->code}} Rolls </b>
                </div>
                <div class="modal-body">
                    <font color="black">

<div class="panel-heading" align='center'>
                    Rolls
                </div>
    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Code</th>
                <th>Yards</th>
                <th>Action </th>

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
                    <td>
                        <a href="/admin/fabrics/rolls/delete/{{$roll->id}}">
                              <button class="btn btn-warning" ><i class="fa fa-times"></i></button>
                        </a> 

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
                <div class="modal-footer">
                    {{ Form::open(array('class' => 'form-signin', 'role' => 'form', 'method' => 'POST', 'action'=>'/admin/fabrics/rolls/add')) }}
                    <div class="input">
                    {{ Form::text('code',Session::get('code'), array('class' => 'form-control  ', 'placeholder' => 'Code','maxlength'=>'50')) }}
                    {{ Form::text('yards',Session::get('yards'), array('class' => 'form-control  ', 'placeholder' => 'Yards','maxlength'=>'50')) }}
                    <input type="hidden" name="id" value="{{$fabric->id}}">
                </div>
                    <br>
                 <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-success" value="Add Roll">
     
        {{ Form::close(); }}
        <br>
                   
                </div>
            </div>
        </div>
    </div> 


@endforeach
@stop