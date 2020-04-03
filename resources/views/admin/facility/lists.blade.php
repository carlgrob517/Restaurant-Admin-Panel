@extends('admin.main')
@section('content')     


    <div class="page-container-1  padding " id="page-container">
        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0" style="padding-bottom: 35px;">Facilities
            <a href="{{ url('admin/addFacility') }}" class="btn btn-raised btn-wave  blue" style="float: right;color: white;">Add Facility</a>
            </h2>
        </div>

        <div class="padding card pt-5 ">
            <div class="table-responsive">
                <table id="datatable" class="table table-theme table-row v-middle" data-plugin="dataTable" style="margin-top: -15px;">
                    <thead>
                        <tr>
                            <th><span class="text-muted">Image </span></th>
                            <th><span class="text-muted">Title</span></th>
                            <th><span class="text-muted">Created</span></th>
                            <th><span class="text-muted">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($facilities as $user)
                            <tr>
                                <td>                                
                                <img src="{{ url($user->image) }}" style="width:90px;height:90px;"/>
                                </td>
                                <td>
                                    {{$user->title}}
                                </td>
                              
                                <td>
                                    {{$user->created_at}}
                                </td>
                                <td>
                                    <a href="{{ url('admin/editFacility', $user->id)}}" class="btn btn-raised btn-wave w-xs" style="color:black;">Edit</a>                                    
                                    <button onclick="deleteD({{$user->id}})" class="btn btn-raised btn-wave w-xs blue" data-toggle="modal" data-target="#m">Delete</button>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- modal -->
<div id="m" class="modal" data-backdrop="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Are you sure to execute this action?</h5>
        </div>
        <!-- <div class="modal-body text-center p-lg">
        <p></p>
        </div> -->
        <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">No</button>
        <button id="delBtn" type="button" class="btn btn-primary delBtn" data-dismiss="modal">Yes</button>
        </div>
    </div><!-- /.modal-content -->
    </div>
</div>
@stop



@section('script')
<script type="text/javascript">       
    var deleteId = "";
    function deleteD(id){
        deleteId = id;
    }

    $("#delBtn").click(function(){    
        var id = deleteId;
        //var request = $.get('{{ URL::to('admin/deleteUser')}}' + "?id=" + id);
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
          type: 'POST',
          data: { id:id},
          url: "{{ URL::to('api/deleteFacility')}}",
          success: function(result) {     
                var res = result.results;
                if(res == 200){
                    location.reload();
                }else{
                    alert("Failed");
                }
          }        
        });
    });             
</script>
@stop