@extends('admin.main')
@section('content')

<div class="page-container">



<div id="content" class="flex ">
    <div class="page-container-1" id="page-container">

        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0">Edit Company
            <a href="{{ url('city/index') }}" class="btn btn-primary" style="float: right;color: white;">Back</a>
            </h2>
        </div>


        <div class="padding">
        <div class="tab-content mb-4">
            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                <form  id="AccountFrm" data-plugin="parsley" data-option="{}"  method="post" action="{{ url('city/editCity')}}" enctype="multipart/form-data">                
                    @csrf

                        <input type="hidden" name="id" value="{{ $city->id }}">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"> City Name </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="city_name" name="city_name"  value="{{$city->city_name}}" class="form-control" placeholder="City Name" required="required">
                                    </div>
                                </div>
                             
                                
                                
                                <div class="form-group" style="padding: 0px;">                    
                                    <button class="btn btn-primary" style="float: right;">Save</button>
                                </div>

                            </div>
                        </div>

                    
                </form>
            </div>
        </div>
    </div>
</div>


<div>

@stop




@section('script')
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">   
    
    var deleteId = "";
    var type = 0;

    function deleteUser(id){        
        deleteId = id;
    }    
    $(document).ready( function() {                        
        var id = $("#country").val();                
        var phoneMask = IMask(
        document.getElementById('office_phone'), {
            mask: '000-000-0000'
        });

        var phoneMask = IMask(
        document.getElementById('office_fax'), {
            mask: '000-000-0000'
        });

    });

   
    $('#state').on('change', function() {   
        var id = this.value;        
        var unitid = $("#city");
        initState(id , unitid, 0);               
    });

    $('#mail_state').on('change', function() {   
        var unitid = $("#mail_city");
        var id = this.value;        
        initState(id, unitid, type);  
    });
    
    $("#delBtn").click(function(){    
        var id = deleteId;
        //var request = $.get('{{ URL::to('admin/deleteUser')}}' + "?id=" + id);        
    });             

    function initState(id, unitid, type){        
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
          type: 'POST',
          data: { id:id},
          url: "{{ URL::to('api/getCity')}}",
          success: function(result) {     
                var res = result.results;
                if(res == 200){

                    units = result.city;    
                    $(unitid).empty();
                    var toAppend = '';
                    $.each(units,function(i,o){                
                        toAppend += '<option value=' + o.auto_num +' style="color:black;" >'+ o.city_name +'</option>';                               
                    });
                    $(unitid).append(toAppend);

                    if(type == 1){
                        var e = document.getElementById("city");
                        var val = e.options[e.selectedIndex].value;
                        //select2
                        //$('#mail_city').val(val);
                        //$('#mail_city').select2().trigger('change');
                        //select
                        document.getElementById("mail_city").value = val;
                        $('#mail_city').trigger("change");
                    }

                }else{
                    alert("Failed");
                }
          }
             
        });
    }


    function popup(){
        var chk = document.getElementById("popCheckbox").checked;
        if(chk){            

            $("#mailing_address1").val( document.getElementById("physical_address1").value );
            $("#mailing_address2").val( document.getElementById("physical_address2").value );
            $("#mailing_zip").val( document.getElementById("physical_zip").value );

            var e = document.getElementById("state");
            var val = e.options[e.selectedIndex].value;
            v ar text = e.options[e.selectedIndex].text;

            type = 1;
            //$('#mail_state').val(val);
            //$('#mail_state').select2().trigger('change');

            document.getElementById("mail_state").value = val;
            $('#mail_state').trigger("change");

            //document.getElementById("mail_state").selectedIndex = val;

            //var unitid = $("#city2");
            //initState(val , unitid, type);

        }
    }

   

</script>

@stop

