
@extends('admin.main')
@section('content')

<div class="page-container">

    <div id="content" class="flex ">
        <div class="page-container-1" id="page-container">
            <div class="page-title padding pb-0 ">
                <h2 class="text-md mb-0">Add City
                <a href="{{ url('city/index') }}" class="btn btn-primary" style="float: right;color: white;">Back</a>
                </h2>
            </div>        
        <div class="padding">


        <div class="tab-content">
            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                <form id="AccountFrm" data-plugin="parsley" data-option="{}" method="post" action="{{ url('city/addCity') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-body">


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"> City Name </label>
                                <div class="col-sm-8">
                                    <input type="text" id="city_name" name="city_name" class="form-control" placeholder="City Name" required="required">
                                </div>
                            </div>
                            

                            <div class="form-group" style="padding: 0px;">                    
                                <button type="butmit" class="btn btn-primary" style="float: right;">Save</button>
                            </div>

                        </div>
                    </div>

                  
                </form>
            </div>
        </div>
    </div>
</div>
@stop


@section('script')
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">   
    
    var api_key = "1mzP2T12A4dB7H0e";
    var abantecart_ssl_url = "https://prohealthdetect.com/phd-store/index.php";
    var deleteId = "";
    function deleteUser(id){        
        deleteId = id;
    }
    var type = 0;

    $(document).ready( function() {                
        var id = $("#country").val();
        //initState(id);
        
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

        // $.ajaxSetup({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        //     'Access-Control-Allow-Origin': '*'
        // }
        // });
        
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
                        $('#mail_city').val(val);
                        $('#mail_city').select2().trigger('change');
                    }    

                    
                }else{
                    alert("Failed");
                }
          }
             
        });
    }

    function saveCompany(){
        createAccount();
    }

    function createAccount()
		{
			var values = {};            			
			//values['email'] = Math.random() + values['email'];

			values['rt'] = 'a/account/create';
            values['api_key'] = api_key;    
            
            if($("#first_name").val() == "" || $("#last_name").val() == ""){
                alert("Input First Name and Last Name");
                return;
            }
            if($("#company_name").val() == null || $("#company_name").val() == ""){
                alert("Input Company name");
                return;
            }

            if($("#physical_address1").val() == ""){
                alert("Input Shipping Address");
                return;
            }
            if($("#mailing_address1").val() == ""){
                alert("Input Billing Address");
                return;
            }

            if($("#office_phone").val() == ""){
                alert("Input Office Phone");
                return;
            }
            if($("#physical_zip").val() == ""){
                alert("Input Physical Zip");
                return;
            }
            if($("#mailing_zip").val() == ""){
                alert("Input Mailing Zip");
                return;
            }

            var company = $("#company_name").val();
            values['loginname'] = company.replace(/\s/g,'') + "517"; ///company.replace(/^\s+|\s+$/gm,'').trim().replace(" ", "").replace("  ", "") + "517";

           
            values['firstname'] = $("#first_name").val();
            values['lastname'] = $("#last_name").val();
            values['company'] = $("#company_name").val();
            if($("#office_email").val() == ""){
                alert("Input Email");
                return;
            }

            values['email'] = $("#office_email").val();
            values['telephone'] = $("#office_phone").val();
            values['fax'] = $("#office_fax").val();

           

            values['address_1'] = $("#physical_address1").val();
            values['address_2'] = $("#physical_address2").val();
            
            var cit = $("#physical_city");            
            values['city'] = $("#city option:selected").text();


            values['postcode'] = $("#physical_zip").val();
            values['country_id'] = $("#country").val();

            var sat = $("#state");            
            values['zone_id'] = $("#state option:selected").text();

            values['password'] = "aaAA11!!";
            values['confirm'] = "aaAA11!!";
            values['newsletter'] = "0";
            values['agree'] = "1";
            
            //values['token'] = "2f7f30e3efeb0d73744680ac7c0c11e6";                      
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //         'Access-Control-Allow-Origin': '*',
            //         'Access-Control-Allow-Origin': 'http://localhost:8080',
            //         'Access-Control-Allow-Credentials': 'false'
            //     }
            // });

			$.ajax({
				type: 'POST',
				url: abantecart_ssl_url,
				data: values,
				dataType: 'text',
				success: function(res)
				{
                    var registerRes = JSON.parse(res);
                    var status = JSON.stringify(registerRes.status);
                    if(status == "1"){                        
                        addCompany();                 
                    }else{
                        console.log(eval('('+res+')'));
                        var obj = JSON.parse(res);        
                        var warning  = JSON.stringify(obj.error_warning); //E-Mail Address is already registered
                        var indexOfFirst = warning.indexOf("E-Mail Address is already registered");
                        if(indexOfFirst != -1){
                            addCompany();
                        }else{
                            alert(JSON.stringify(obj.errors));
                        }
					    
                    }					
				},
				error: function(obj, status, msg)
				{
					console.log(obj);
					console.log(status);
					console.log(msg);
                    alert(obj.responseText);
					//showResponse(this, obj.responseText);
				}
			});
        }
        

    function addCompany(){
        var params = {};
        $.each($('#AccountFrm').serializeArray(), function(i, field) {
            params[field.name] = field.value;
        });
        $.ajax({
            type: 'POST',
            url: "{{ URL::to('api/getAddcompany')}}",
            data: params,                            
            success: function(res)
            {
                var results = res.results;       
                if(results == "200"){

                    var url = '{{ URL::to("admin/addUser", ":id") }}';
                    url = url.replace('%3Aid', res.id);
                    //var id = "admin/addUser/" + res.id; ='{{ URL::to("' +  id + '") }}'
                    location.href= url;
                    
                }else{

                }		
            },
            error: function(obj, status, msg)
            {                               
                alert(obj.responseText);                               
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
            var text = e.options[e.selectedIndex].text;

            type = 1;
            $('#mail_state').val(val);
            $('#mail_state').select2().trigger('change');

            //var unitid = $("#city2");
            //initState(val , unitid, type);

        }
    }



</script>

@stop


