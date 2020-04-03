@extends('admin.main')
@section('content')   
    
<div class="page-container" id="page-container" >
	
	<div class="page-title padding pb-0 ">
		<h2 class="text-md mb-0">Dashboard</h2>
	</div>

	<div class="padding">
	<div class="row row-sm">		
		<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="block px-4 py-3">
	          <div class="row">

              <div class="col-lg-3 col-6">
	              <div class="d-flex align-items-center i-con-h-a my-1">
	                <div>
	                  <span class="avatar w-40 b-a b-2x">
	                    <i class="i-con i-con-users b-2x text-warning"><i></i></i>
	                  </span>
	                </div>
	                <div class="mx-3 mt-3">
	                  <a href="" class="d-block ajax"><strong>550</strong></a>
	                  <small class="text-muted">Total de ordenes</small>
	                </div>
	              </div>
                </div>
                
	            <div class="col-lg-3 col-6">
	              <div class="d-flex align-items-center i-con-h-a my-1">
	                <div>
	                  <span class="avatar w-40 b-a b-2x">
                      <i class="i-con i-con-history b-2x text-success"><i></i></i>
	                  </span>
	                </div>
	                <div class="mx-3  mt-3">
	                  <a href="" class="d-block ajax"><strong>60</strong></a>
	                  <small class="text-muted">Total de ganancias</small>
	                </div>
	              </div>
                </div>
                
	            <div class="col-lg-3 col-6">
	              <div class="d-flex align-items-center i-con-h-a my-1">
	                <div>
	                  <span class="avatar w-40 b-a b-2x">
                      <i class="i-con i-con-users b-2x text-warning"><i></i></i>
	                  </span>
	                </div>
	                <div class="mx-3  mt-3">
	                  <a href="" class="d-block ajax"><strong>13</strong></a>
	                  <small class="text-muted">Restaurants</small>
	                </div>
	              </div>
	            </div>
	            
	            <div class="col-lg-3 col-6">
	              <div class="d-flex align-items-center i-con-h-a my-1">
	                <div>
	                  <span class="avatar w-40 b-a b-2x">
                      <i class="i-con i-con-users b-2x text-warning"><i></i></i>
	                  </span>
	                </div>
	                <div class="mx-3  mt-3">
	                  <a href="" class="d-block ajax"><strong>302</strong></a>
	                  <small class="text-muted">Total de usuarios </small>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	        <div class="row row-sm">
	        	<div class="col-md-12">
			        <div class="card p-4">
			        	

                        
			        </div>
		        </div>
	        	
	        </div>
	    </div>
	    <!-- <div class="col-12">
	    	<div class="card">
		      <div class="p-4 b-b d-flex">
		      	<strong>World sells</strong>
		      	<span class="flex"></span>
		      	<div><span class="badge badge-pill bg-success mx-2">48</span></div>
		      	<span class="text-muted">countries</span>
		      </div>
		      <div class="row no-gutters">
		        <div class="col-sm-6">
		          <div class="p-4">
		            <div id="jqvmap-world" data-plugin="vectorMap" style="height: 240px">
		            </div>
		          </div>
		        </div>
		        <div class="col-sm-3 p-4">
		          <div class="">
		            <div class="d-flex my-4">
		              <div class="peity" data-plugin="peity" data-tooltip="true" data-title="Profile" data-option="
		                'donut',
		                {
		                  height: 40,
		                  width: 40,
		                  padding: 0.2,
		                  fill: [theme.color.primary, 'rgba(120, 130, 140, 0.1)']
		                }">20,80
		              </div>
		              <div class="mx-3">
		                <small class="text-muted d-block mb-1">
		                  North America
		                </small>
		                <small class="text-primary">35%</small>
		              </div>
		            </div>
		            <div class="d-flex my-4">
		              <div class="peity" data-plugin="peity" data-tooltip="true" data-title="Profile" data-option="
		                'donut',
		                {
		                  height: 40,
		                  width: 40,
		                  padding: 0.2,
		                  fill: [theme.color.success, 'rgba(120, 130, 140, 0.1)']
		                }">10,90
		              </div>
		              <div class="mx-3">
		                <small class="text-muted d-block mb-1">
		                  Europe
		                </small>
		                <small class="text-success">10%</small>
		              </div>
		            </div>
		            <div class="d-flex my-4">
		              <div class="peity" data-plugin="peity" data-tooltip="true" data-title="Profile" data-option="
		                'donut',
		                {
		                  height: 40,
		                  width: 40,
		                  padding: 0.2,
		                  fill: [theme.color.warning, 'rgba(120, 130, 140, 0.1)']
		                }">30,70
		              </div>
		              <div class="mx-3">
		                <small class="text-muted d-block mb-1">
		                  Asia
		                </small>
		                <small class="text-waring">30%</small>
		              </div>
		            </div>
		          </div>
		        </div>
		        <div class="col-sm-3 b-l p-0">
		          <div class="p-4 text-center b-b">
		            <h3 class="m-0">Europe</h3>
		          </div>
		          <div class="p-4 row text-center">
		            <div class="col b-r">
		              530
		              <div class="text-muted text-sm">Cities</div>
		            </div>
		            <div class="col">
		              54,040
		              <div class="text-muted text-sm">Population</div>
		            </div>
		          </div>
		          <div class="p-4 text-center text-center">
		            <span class="text-md text-primary">45%</span>
		            <div class="text-muted text-sm">Profit</div>
		          </div>
		        </div>
		      </div>
		  </div>
	    </div> -->
	
	
	</div>
</div>

</div>

@stop
