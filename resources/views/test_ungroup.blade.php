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
	<script src='https://api.tiles.mapbox.com/mapbox.js/v2.2.4/mapbox.js'></script>
  <link href='https://api.tiles.mapbox.com/mapbox.js/v2.2.4/mapbox.css' rel='stylesheet' />
  


	
@endsection

@section('page-header')
	Dashboard
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
<!-- <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script> -->
<!-- <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script> -->
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoib2tkZXYiLCJhIjoiY2ltdDFzZ3loMDF2OXZsbTQycDc5aXYyYyJ9.hqCnz0PJe-5uNssgTKgM1Q';
var mapTooltipsJS = L.mapbox.map('map', 'mapbox.streets')
  .setView([37.8, -96], 4);
var myLayer = L.mapbox.featureLayer().addTo(mapTooltipsJS);

var geojson = [
  {
  	"type":"FeatureCollection",
  		"features":[
  			{"type":"Feature",
  			"properties":
  				{
  				"title":"RTH Imam Bonjol",
  				"description":"Ini halte Utama <br>\n<img src='https://i.imgur.com/V1JfU8j.jpg' alt='Velo Cult'/><a href=\"http://velocult.com/\">",
  				"marker-size":"medium",
  				"marker-color":"#1087bf",
  				"marker-symbol":"bus"
  				},
  			"geometry":
  				{"coordinates":[100.363513,-0.952708],
  				"type":"Point"
  				}
  			}
  			],
  		}  
];

// Set a custom icon on each marker based on feature properties.
myLayer.on('layeradd', function(e) {
  var marker = e.layer,
    feature = marker.feature;
  marker.setIcon(L.icon(feature.properties.icon));
  var content = '<h2>'+ feature.properties.title+'<\/h2>' + '<img src="'+feature.properties.image+'" alt="">';
  marker.bindPopup(content);
});
myLayer.setGeoJSON(geojson);
mapTooltipsJS.scrollWheelZoom.disable();
</script>	
	

@endsection
