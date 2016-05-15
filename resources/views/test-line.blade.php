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
		 height:350px;
		 position:absolute; 
		 top:0; 
		 bottom:0; 
		 width:100%;
		}
	</style>

	<!-- <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.18.0/mapbox-gl.js'></script> -->
    <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
    <!-- <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.18.0/mapbox-gl.css' rel='stylesheet' /> -->
    <style>
        body { margin:0; padding:0; }
        #map { position:absolute; top:0; bottom:0; width:100%; }
    </style>
@endsection

@section('page-header')
	Test-Line
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		overview &amp; stats
	</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8" style="height: 400px;">
			<div class="map-responsive">
    	
    		<div id="map" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></div>
			
			</div>
			<!-- <div id="map" > </div> -->

		</div>
		<div class="col-sm-4">
			<form class="form-horizontal" role="form">
			<div class="form-group">
				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Keberangkatan </label>

				<div class="col-sm-8">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" />
						<i class="ace-icon fa fa-bus blue"></i>
					</span>
				</div>

				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Kedatangan </label>

				<div class="col-sm-8">
					<span class="input-icon">
						<input type="text" id="form-field-icon-1" />
						<i class="ace-icon fa fa-bus blue"></i>
					</span>
				</div>		
				<!-- <div class="col-sm-9">
					<input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" />
				</div> -->
			</div>
			</form>
		</div>
	</div>
@endsection

@section('js')
<script>
// mapboxgl.accessToken = 'pk.eyJ1Ijoib2tkZXYiLCJhIjoiY2ltdDFzZ3loMDF2OXZsbTQycDc5aXYyYyJ9.hqCnz0PJe-5uNssgTKgM1Q';
L.mapbox.accessToken = 'pk.eyJ1Ijoib2tkZXYiLCJhIjoiY2ltdDFzZ3loMDF2OXZsbTQycDc5aXYyYyJ9.hqCnz0PJe-5uNssgTKgM1Q';

// var map = new mapboxgl.Map({
//     container: 'map',
//     style: 'mapbox://styles/mapbox/streets-v8',
//     center: [-122.486052, 37.830348],
//     zoom: 15
// });
// // var map = L.mapbox.map('map')
// //     .setView([-0.908667,100.3872087], 13)
// //     .addLayer(L.mapbox.tileLayer('mapbox.dark'));

// map.on('load', function () {
//     $.get( "/TransPadang/public/halte_k1a", function( data ) {
//         console.log(JSON.parse(data))
//         // map.addSource()
//     });
//     map.addSource("route", {
//         "type": "geojson",
//         "data": {
//             "type": "Feature",
//             "properties": {},
//             "geometry": {
//                 "type": "LineString",
//                 "coordinates": [
//                     [100.35455,-0.94427400827408],
//                     [100.355621,-0.94581800699234]
//                 ]
//             }
//         }
//     });

//     map.addLayer({
//         "id": "route",
//         "type": "line",
//         "source": "route",
//         "layout": {
//             "line-join": "round",
//             "line-cap": "round"
//         },
//         "paint": {
//             "line-color": "#888",
//             "line-width": 8
//         }
//     });
// });

var map = L.mapbox.map('map')
.setView([-0.908667,100.3872087], 13)
.addLayer(L.mapbox.tileLayer('mapbox.streets'));

var line_points = loadURL('/TransPadang/public/halte');


// Define polyline options
// http://leafletjs.com/reference.html#polyline
var polyline_options = {
    color: '#000'
};

// Defining a polygon here instead of a polyline will connect the
// endpoints and fill the path.
// http://leafletjs.com/reference.html#polygon
var polyline = L.polyline(line_points, polyline_options).addTo(map);


</script>

	

@endsection
