@extends('maintemplate')



@section('css')
	<li>Dashboard</li>
	<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
	<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
	<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
	<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />

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
		<div class="col-md-8">
			<div class="map-responsive">
    	
    		<div id="map" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></div>
		
			</div>
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
		L.mapbox.accessToken = 'pk.eyJ1Ijoib2tkZXYiLCJhIjoiY2ltdDFzZ3loMDF2OXZsbTQycDc5aXYyYyJ9.hqCnz0PJe-5uNssgTKgM1Q';
// Here we don't use the second argument to map, since that would automatically
// load in non-clustered markers from the layer. Instead we add just the
// backing tileLayer, and then use the featureLayer only for its data.
var map = L.mapbox.map('map')
    .setView([-0.908667,100.3872087], 13)
    .addLayer(L.mapbox.tileLayer('mapbox.dark'));

L.mapbox.featureLayer()
    .loadURL('/TransPadang/public/halte')
    .on('ready', function(e) {
    // create a new MarkerClusterGroup that will show special-colored
    // numbers to indicate the type of rail stations it contains
    function makeGroup(color) {
      return new L.MarkerClusterGroup({
        iconCreateFunction: function(cluster) {
          return new L.DivIcon({
            iconSize: [20, 20],
            html: '<div style="text-align:center;color:#fff;background:' +
            color + '">' + cluster.getChildCount() + '</div>'
          });
        }
      }).addTo(map);
    }
    // create a marker cluster group for each type of rail station
    var groups = {
      red: makeGroup('red'),
      green: makeGroup('green'),
      orange: makeGroup('orange'),
      blue: makeGroup('blue'),
      yellow: makeGroup('yellow')
    };
    e.target.eachLayer(function(layer) {
      // add each rail station to its specific group.
      groups[layer.feature.properties.line].addLayer(layer);
    });
});
	</script>

	<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
	<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>

@endsection
