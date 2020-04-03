@extends('admin.main')
@section('css')
<link rel="stylesheet" href="{{ asset('libs/select2/dist/css/select2.min.css')}}" type="text/css" />
@stop
@section('content')

<div id="content" class="flex ">
    <div class="page-container card" id="page-container">
        <!-- <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0">Add Business  Level 
            <a href="{{ url('admin/businessLists') }}" class="btn btn-raised btn-wave w-xs blue" style="float: right;color: white;">Back</a>
            </h2>
        </div>         -->
    <div class="padding">

        <head>
            <style type="text/css">
            #map{ width:100%; height: 500px; }
            </style>            
            <title>Save Marker Example</title>
        </head>
        <body>
            <h4>Select a location!</h4>
            <p>Click on a location on the map to select it. Drag the marker to change location.</p>            
            <!--map div-->
            <div id="map"></div>            
            <!--our form-->
        </body>



    <div class="tab-content mb-4">
        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
            <form method="post" action="{{ url('admin/addRestaurant') }}" enctype="multipart/form-data">
                @csrf                
                
                <div class="form-group row">
                    <div class="col-md-6">
                    <label> Latitude: </label> <input type="text" id="lat" name="lat" class="col-md-12 form-control" style="line-height: 2;">
                    </div>
                    <div class="col-md-6">
                    <label> Longitude: </label> <input type="text" id="lng" name="lng" class="col-md-12 form-control" style="line-height: 2;">
                    </div>                                                
                </div>

                <div class="form-group">
                    <input type="text" name="title" class="col-md-12 form-control" placeholder="Title" style="line-height: 2;" required="required">
                </div>
                
                <div class="form-group">
                    <input type="text" name="address" class="col-md-12 form-control" placeholder="Address" style="line-height: 2;">
                </div>

                <div class="form-group">
                    <!-- pattern="[0-9]{3} [0-9]{3} [0-9]{4}" -->                    
                    <textarea name="phone" class="col-md-6 form-control" placeholder="phone" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <input type="text" name="email" class="col-md-12 form-control" placeholder="email" style="line-height: 2;">
                </div>

                <div class="form-group">
                    <input type="text" name="fax" class="col-md-12 form-control" placeholder="fax" style="line-height: 2;">
                </div>

                <div class="form-group">
                    <input type="text" name="url" class="col-md-12 form-control" placeholder="Web site link" style="line-height: 2;" >
                </div>    
                
                <div class="form-group">
                    <input type="text" name="video" class="col-md-12 form-control" placeholder="Video" style="line-height: 2;">
                </div> 
                
                <div class="form-group">
                    <input type="text" name="facebook" class="col-md-12 form-control" placeholder="Facebook" style="line-height: 2;">
                </div> 
                <div class="form-group">
                    <input type="text" name="twitter" class="col-md-12 form-control" placeholder="Twitter" style="line-height: 2;">
                </div> 
                <div class="form-group">
                    <input type="text" name="instagram" class="col-md-12 form-control" placeholder="Instagram" style="line-height: 2;">
                </div> 
                <div class="form-group row">
                    
                    <div class="col-md-6">
                        <input type="number"  step=".01" name="min_price" class="col-md-12 form-control" placeholder="Min Price" style="line-height: 2;">
                    </div>
                    <div class="col-md-6">
                        <input type="number"  step=".01" name="max_price" class="col-md-12 form-control" placeholder="Max Price" style="line-height: 2;">
                    </div>                                        
                </div> 

                <div class="form-group">                    
                    <textarea type="hidden" name="time" class="col-md-12 form-control" value="" placeholder="manual time" rows="2" style='display:none;'></textarea>
                </div> 

                <div class="form-group">
                    <label class="md-switch">
                      <input name="favorite" type="checkbox" checked="" value="">
                      <i class="blue"></i>
                      Favorites
                    </label>
                </div>

                <div class="form-group">
                        <label>Select City</label>
                        <select id="city_id" name="city_id" class="col-md-12 form-control" placeholder="City" require>  
                        <optgroup label="Cities">
                                @foreach($cities as $hour)
                                <option value="{{$hour->id}}"> {{$hour->city_name }}</option>  
                                @endforeach
                            </optgroup>                                                
                    </select>
                </div> 


                <div class="form-group">
                        <label>Select Hour</label>
                        <select id="hour_id" name="hour_id[]" class="col-md-12 form-control" placeholder="Hour" multiple require>  
                        <optgroup label="Hours">
                                @foreach($hours as $hour)
                                <option value="{{$hour->id}}"> {{$hour->start_time." - ".$hour->end_time."  ".$hour->week_of_day}}</option>  
                                @endforeach
                            </optgroup>                                                
                    </select>
                </div> 

                
                <div class="form-group">
                        <!-- <label>Select2 multi select</label> -->
                        <label>Select Category</label>
                        <select id="category_id" name="category_id[]" class="col-md-12 form-control" multiple require>                        
                        <optgroup label="Categories">
                                @foreach($categories as $cat)
                                <option value="{{$cat->id}}"> {{$cat->name}}</option>  
                                @endforeach
                            </optgroup>                                                
                    </select>
                </div>                             


                <div class="form-group">
                        <!-- <label>Select2 multi select</label> -->
                        <label>Select Facilities</label>
                        <select id="facility_id" name="facility_id[]" class="col-md-12 form-control" multiple require>                        
                        <optgroup label="Facilities">
                                @foreach($facilities as $cat)
                                <option value="{{$cat->id}}"> {{$cat->title}}</option>  
                                @endforeach
                            </optgroup>                                                
                    </select>
                </div>       


            
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea id="ckeditor" name="desc" class="col-md-12" required="required">                           
                        </textarea>
                    </div>                        
                </div>
                
                 
                <div class="form-group">
                    <Label>Post Image</Label>
                    <input type="file" name="img[]" class="col-md-12 form-control" placeholder="Image" style="line-height: 4;" required="required" multiple="multiple"/>                    
                </div>


              

                <div class="col-md-6 form-group" style="padding: 0px;">                    
                    <button class="btn btn-raised btn-wave mb-2 w-xs blue" style="float: right;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('script')
<script src="{{ asset('libs/select2/dist/js/select2.min.js') }}" ></script>
<script src="{{ asset('assets/js/plugins/select2.js') }}" ></script>
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCRNY-cTsigdvQMVHNaq5ShA1yteywcb64&sensor=false&libraries=places'></script>

<script src="{{ asset('libs/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
//CKEditor
CKEDITOR.replace('ckeditor');
CKEDITOR.config.height = 300;
</script>>


<script type="text/javascript">


//Set up some of our variables.
var map; //Will contain map object.
var marker = false; ////Has the user plotted their location marker? 
var geocoder;        
//Function called to initialize / create the map.
//This is called when the page has loaded.
function initMap() {
 
    geocoder = new google.maps.Geocoder();

    //The center location of our map.
    var centerOfMap = new google.maps.LatLng(53.9338362, -116.5765025);
    //53.9338362, -116.5765025
    //Map options.
    var options = {
      center: centerOfMap, //Set center.
      zoom: 7 //The zoom value.
    };
 
    //Create the map object.
    map = new google.maps.Map(document.getElementById('map'), options);
 
    //Listen for any clicks on the map.
    google.maps.event.addListener(map, 'click', function(event) {                
        //Get the location that the user clicked.
        var clickedLocation = event.latLng;
        //If the marker hasn't been added.
        if(marker === false){
            //Create the marker.
            marker = new google.maps.Marker({
                position: clickedLocation,
                map: map,
                draggable: true //make it draggable
            });
            //Listen for drag events!
            google.maps.event.addListener(marker, 'dragend', function(event){
                markerLocation();
            });
        } else{
            //Marker has already been added, so just change its location.
            marker.setPosition(clickedLocation);
        }
        //Get the marker's location.
        markerLocation();
    });
}
        
//This function will get the marker's current location and then add the lat/long
//values to our textfields so that we can save the location.
function markerLocation(){
    //Get location.
    var currentLocation = marker.getPosition();
    //Add lat and lng values to a field that we can save.
    document.getElementById('lat').value = currentLocation.lat(); //latitude
    document.getElementById('lng').value = currentLocation.lng(); //longitude
    //geocodePosition(marker.getPosition());
}
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      //updateMarkerAddress(responses[0].formatted_address);
      document.getElementById('address').value = responses[0].formatted_address;
    } else {
      //updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}        
        
google.maps.event.addDomListener(window, 'load', initMap);

    $(document).ready( function() {
        $('#category_id').select2();
        $('#hour_id').select2();
        $('#facility_id').select2();
        $('#city_id').select2();
    });


    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds){
            break;
            }
        }
    }

</script>
@stop


