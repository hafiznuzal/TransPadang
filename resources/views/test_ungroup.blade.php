@extends('maintemplate')



@section('css')
	
	<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
	<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
	<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
	<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />
	<style>
	  /*body { margin:0; padding:0; }*/
	  /*#map {  }*/
	    #map{
		 width:600px; 
		 position:absolute; 
		 top:0; 
		 bottom:0; 
		 width:100%;
		}
		.map-responsive {
		padding-bottom: 0%;
		height: 450px;
	}
	</style>
	<style>
	.ui-select {
	  background:#fff;
	  position:absolute;
	  top:10px;
	  right:10px;
	  z-index:100;
	  padding:10px;
	  border-radius:3px;
	  }
	</style>
	<style>
.leaflet-popup-content img {
  max-width:100%;
  }
</style>
	<script src='https://api.tiles.mapbox.com/mapbox.js/v2.2.4/mapbox.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox.js/v2.2.4/mapbox.css' rel='stylesheet' />
  


	
@endsection

@section('page-header')
	Informasi Koridor
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Semua Koridor
	</small>
@endsection

@section('content')
	<div class="row">
		<!-- <div class="col-md-8" style="height: 400px;"> -->
			<div class="map-responsive">
    		<div id='filters' class='ui-select'>
				  <div><input type='checkbox' class='filter'
				             name='filter' id='Pergi' value='Pergi' onclick="change()"/><label for='Pergi'>Pergi (Pusat Kota)</label></div>
				  <div><input type='checkbox' class='filter'
				             name='filter' id='Pulang' value='Pulang' onclick="change()"/><label for='Pulang'>Pulang</label></div>				  
			</div>			
    		<div id="map"></div>
			
			</div>
			

		<<!-- /div>
		<div class="col-sm-4">
			
		</div> -->
	</div>
@endsection

@section('js')
<!-- <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script> -->
<!-- <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script> -->
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoib2tkZXYiLCJhIjoiY2ltdDFzZ3loMDF2OXZsbTQycDc5aXYyYyJ9.hqCnz0PJe-5uNssgTKgM1Q';
var map = L.mapbox.map('map')
.setView([-0.951647,100.427828], 12)
.addLayer(L.mapbox.tileLayer('mapbox.streets'));

var filters = document.getElementById('filters');
var checkboxes = document.getElementsByClassName('filter');
var layer = []


function change() {
    // Find all checkboxes that are checked and build a list of their values
    for (var i = 0; i < layer.length; i++) {
    	map.removeLayer(layer[i])
    }
    var on = [];
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) on.push(checkboxes[i].value);
    }
    
    if (on.length == 2) 
    {
    	@yield('rute_js_pergi');
    	@yield('rute_js_pulang');
    }
    else if (on[0] == "Pergi") 
    {

    	@yield('rute_js_pergi');
    }
    else if (on[0] == "Pulang")
    {
    	@yield('rute_js_pulang');
    }
    return false;
}
// When the form is touched, re-filter markers
// filters.onchange = change;
// Initially filter the markers
// change();
 	
</script>
</script>	
	

@endsection
