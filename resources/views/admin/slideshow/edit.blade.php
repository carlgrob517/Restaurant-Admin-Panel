@extends('admin.main')
@section('content')

<div class="page-container">

    <div class="page-container-1" id="page-container">
        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0">Add Slide Show
            <a href="{{ url('admin/slideshow') }}" class="btn btn-primary" style="float: right;color: white;">Back</a>
            </h2>
            
        </div>        
    <div class="padding">

    <div class="tab-content mb-4">
        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">

            <form  data-plugin="parsley" data-option="{}"  method="post" action="{{ url('admin/editSlideshow') }}" enctype="multipart/form-data">
                @csrf                
                <input type="hidden" name="id" value="{{$slideshow->id}}" />

                <div class="form-group">
                    <input type="text" name="title" class="  form-control" value="{{$slideshow->title}}" placeholder="Title"   required="required">
                </div>           
                <div class="form-group">
                    <input type="text" name="url" class="  form-control" value="{{$slideshow->url}}" placeholder="Url">
                </div>
                
                <div class="form-group">
                    <input type="file" name="img" class="  form-control" placeholder="File"    >
                </div>

                
                <div class="form-group">
                    <label class="md-switch">
                      <input name="status" type="checkbox" {{ $slideshow->status == "1" ? "checked" : ""}} >
                      <i class="blue"></i>
                      Status
                    </label>
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

@stop




