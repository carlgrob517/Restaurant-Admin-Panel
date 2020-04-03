@extends('admin.main')
@section('content')

<div class="page-container">

    <div class="page-container-1" id="page-container">
       

        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0">Edit About
            <!-- <a href="{{ url('admin/category') }}" class="btn btn-primary" style="float: right;color: white;">Back</a> -->
            </h2>
        </div>

    <div class="padding">

    <div class="tab-content mb-4">
        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">

            <form  data-plugin="parsley" data-option="{}"  method="post" action="{{ url('about/edit') }}" enctype="multipart/form-data">
                @csrf                
                <input type="hidden" name="id" value="{{$about->id}}" />
                
                <div class="form-group">
                    <input type="text" name="title" value="{{$about->title}}" class="   form-control" placeholder="English Name"  required="required">
                </div>
             

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea id="ckeditor" name="description" class="col-md-12">
                            {{$about->description}}
                        </textarea>
                    </div>                        
                </div>
    

           
                
                <div class="form-group row">
                    <div class="mx-3">
                        @if (strpos($about->image, 'png') !== false || strpos($about->image, 'jpg') !== false )
                            <img src="{{ url($about->image) }}" class="" style="width:150px;height:90px;" />
                        @endif                                                
                    </div>
                    <div class="col-md-10">
                        <input type="file" name="img" class="form-control" placeholder="File">
                    </div>                                        
                </div>
                                              
                
                <div class=" form-group" style="padding: 0px;">                    
                    <button class="btn btn-primary" style="float: right;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('script')
<script src="https://unpkg.com/imask"></script>
<script src="{{ asset('libs/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">   
    $(document).ready( function() {    
        var phoneMask = IMask(
        document.getElementById('office_num'), {
            mask: '000-000-0000'
        });

        var phoneMask = IMask(
        document.getElementById('home_num'), {
            mask: '000-000-0000'
        });
        
    });
</script>
<script type="text/javascript">
//CKEditor
CKEDITOR.replace('ckeditor');
CKEDITOR.config.height = 300;
</script>>



@stop




