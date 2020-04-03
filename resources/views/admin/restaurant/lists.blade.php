@extends('admin.main')
@section('content')     
    <div class="page-container-1 padding" id="page-container">
        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0" style="padding-bottom: 35px;">Restaurants            
            
                 <a href="{{ url('admin/addRestaurant') }}" class="btn btn-primary" style="float: right;">Add Restaurant</a>         
            <!--
            <a href="{{ url('import/index')}}" class="btn btn-primary" style="float:right;margin-right: 20px;"> Import </a>
            <a href="{{ url('import/export')}}" class="btn btn-primary" style="float:right;margin-right: 20px;"> Export </a>
            </h2>  -->
        </div>

        <div class="padding card pt-5 ">
            <div class="table-responsive">
                
                <!-- <table id="datatable" class="table table-theme table-row v-middle" data-plugin="dataTable" style="margin-top: -15px;"> -->

                <table class="table table-theme v-middle" data-plugin="bootstrapTable"
                    id="table"
                    data-toolbar="#toolbar"
                    data-search="true"
                    data-search-align="left"
                    data-show-columns="true"
                    data-show-export="false"
                    data-detail-view="false"
                    data-mobile-responsive="true"
                    data-pagination="true"
                    data-page-list="[10, 25, 50, 100, ALL]"
                    >
                    
                    <thead>
                        <tr>
                            <th><span class="text-muted">Name</span></th>
                            <th><span class="text-muted">Image</span></th>
                            <th><span class="text-muted">Description</span></th>
                            <th><span class="text-muted">Created</span></th>
                            <th><span class="text-muted">Status</span></th>
                            <th><span class="text-muted">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurants as $user)
                            <tr>
                                <td>
                                {{$user->title}}
                                </td>

                                <td>                                
                                <img src="{{ url($user->img) }}" style="width:200px;height:150px;"/>
                                </td>

                                <td>                                                                
                                <?php echo $user->description; ?>
                                </td>                                                            
                                <td>
                                {{$user->created_at}}
                                </td>

                                <td>
                                    <div class="form-group">
                                        <label class="md-switch">
                                        <input id="{{$user->id}}" name="status"  onclick="onClickStatus(this);" type="checkbox" {{$user->status == "1"?"checked":""}} >
                                        <i class="blue"></i>
                                        
                                        </label>
                                    </div>
                                </td>

                                <td>
                                    <div class="row mr-3" style="">
                                    <a href="{{ url('admin/editRestaurant', $user->id)}}" class="btn btn-primary mr-3" >Edit</a>                                    
                                    <button onclick="deleteUser({{$user->id}})" class="btn btn-primary" data-toggle="modal" data-target="#m">Delete</button>
                                    </div>
                                    
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button id="delBtn" type="button" class="btn btn-primary delBtn" data-dismiss="modal">Yes</button>
        </div>
    </div><!-- /.modal-content -->
    </div>
</div>
@stop


@section('script')
<script type="text/javascript">   
    $(document).ready(function() {        
    });

    var deleteId = "";
    function deleteUser(id){
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
          url: "{{ URL::to('admin/deleteRestaurant')}}",
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

    function onClickStatus(cb){
        var status = "0";
        if(cb.checked){
            status = "1";
        }

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
          type: 'POST',
          data: { id:cb.id, status:status},
          url: "{{ URL::to('api/updateStatus')}}",
          success: function(result) {     
                var res = result.results;
                if(res == 200){
                    //location.reload();
                }else{
                    alert("Failed");
                }
          }

        });

    }      
</script>

@stop