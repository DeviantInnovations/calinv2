
@extends('layouts.main')

@section('title')
    Member Management
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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Members
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">


    <div class="table-responsive">
        <table  id="tablesorter-table"  align="center" style="color:black" class="table table-striped display tablesorter" id="main-table" border=0>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
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

            @foreach($members as $member)


                <tr >
                    <td>{{ $member->name  }}</td>
                    
                    <td>{{ $member->email }}</td>
                    <td>
                        <a href="/admin/members/edit/{{$member->id}}">
                              <button class="btn btn-primary" ><i class="fa fa-pencil-square-o"></i></button>
                        </a> 
               
                        @if($member->status==1)
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="{{ '#deactivate_' . $member->id }}"  data-toggle="tooltip" data-placement="top"  title="Deactivate Member">Deactivate</button>
                        @else
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="{{ '#activate_' . $member->id }}"  data-toggle="tooltip" data-placement="top"  title="Activate Member">Activate</button>
                        @endif
                    </td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $members->links(); }}</center>
    </div>

   
</div>
</div>
</div>
</div>
</div>
    
  
    </div>







@stop

@section('dialogs')
@foreach($members as $member)
    <?php 
        $modalName = "deactivate";
        $message = "Are you sure you want to deactivate member {$member->name} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $member->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Deactivate Member</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/members/deactivate/{{$member->id}}" class="btn btn-warning" id="confirm">Deactivate </a>
                </div>
            </div>
        </div>
    </div>              
@endforeach
@foreach($members as $member)
    <?php 
        $modalName = "activate";
        $message = "Are you sure you want to activate member {$member->name} ?";
    ?>
   
    <div class="modal fade" id="{{ $modalName . '_' . $member->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <b style="color:white;">Activate Member</b>
                </div>
                <div class="modal-body">
                    <font color="black">{{ $message }}</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                    <a href="/admin/members/activate/{{$member->id}}" class="btn btn-success" id="confirm">Activate </a>
                </div>
            </div>
        </div>
    </div>              
@endforeach
@stop