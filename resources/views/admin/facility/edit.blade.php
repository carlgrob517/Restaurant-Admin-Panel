@extends('admin.main')
<link rel="stylesheet" href="{{ asset('libs/select2/dist/css/select2.min.css')}}" type="text/css" />
@section('content')
<div id="content" class="flex ">
    <div class="page-container card" id="page-container">
        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0">Edit Facility
            <a href="{{ url('admin/facility') }}" class="btn btn-raised btn-wave w-xs blue" style="float: right;color: white;">Back</a>
            </h2>
        </div>
                
        <div class="padding">
        <div class="tab-content mb-4">
            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
                <form method="post" action="{{ url('admin/editFacility')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $facility->id }}">
                    
                    <div class="form-group">
                        <input type="text" name="title" class="col-md-12 form-control" placeholder="Email" style="line-height: 2;" value="{{ $facility->title }}" required="required">
                    </div> 

                    <div class="form-group">
                        <input type="file" name="image" class="col-md-12 form-control" placeholder="Desc" style="line-height: 2;" value="" required="required">
                    </div>   

                    

                    
                    <div class="col-md-6 form-group" style="padding: 0px;">                        
                        <button class="btn btn-raised btn-wave mb-2 w-xs blue" style="float: right;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop


@section('script')
<script src="{{ asset('libs/select2/dist/js/select2.min.js') }}" ></script>
<script src="{{ asset('assets/js/plugins/select2.js') }}" ></script>
<script>
$('#category_id').select2();
</script>
@stop
