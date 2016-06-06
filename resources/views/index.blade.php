@extends('maintemplate')



@section('css')
	
	<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
	<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
	<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
	<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />
	<link rel="stylesheet" href="{{ url('css/transition.min.css') }}"/>
	<link rel="stylesheet" href="{{ url('css/dropdown.min.css') }}"/>
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
			<div class="form-horizontal" role="form">
			<div class="form-group">
			<div class="col-sm-4">
				<label class="control-label no-padding-right" for="form-field-1"> Keberangkatan </label>
				<br>
				<label class="control-label no-padding-right" for="form-field-1"> Kedatangan </label>
			</div>	
				<div class="col-sm-8">
					
						<div class="ui fluid search selection dropdown">
 							  <i class="ace-icon fa fa-bus blue"></i>

							  <input id="keberangkatan" type="hidden" name="country">
							  <i class="dropdown icon"></i>
							  <div class="default text">Select Country</div>
							  <div class="menu">
							  <?php foreach ($halte as $key => $value) {?>
							  	<div class="item" data-value="<?php echo $value->id?>"></i> <?php echo $value->nama?> </div>
							  
							  <?php } ?>
							</div>
						</div>

						<div class="ui fluid search selection dropdown">
 							  <i class="ace-icon fa fa-bus blue"></i>

							  <input id="kedatangan" type="hidden" name="country">
							  <i class="dropdown icon"></i>
							  <div class="default text">Select Country</div>
							  <div class="menu">
							  <?php foreach ($halte as $key => $value) {?>
							  	<div class="item" data-value="<?php echo $value->id?>"></i> <?php echo $value->nama?> </div>
							  
							  <?php } ?>			  
							  
							</div>
						</div>

						<button class="btn btn-sm btn-primary" onclick="telusuri()">
							<i class="ace-icon fa fa-flask"></i>
							Telusur
						</button>
				</div>		
				
			</div>
			</div>
		</div>
		</div>

	
@endsection

@section('js')
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
	<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
	<script src="{{ url('js/dropdown.min.js')}}"></script>
	<script src="{{ url('js/transition.min.js')}}"></script>
	<script>
		L.mapbox.accessToken = 'pk.eyJ1Ijoib2tkZXYiLCJhIjoiY2ltdDFzZ3loMDF2OXZsbTQycDc5aXYyYyJ9.hqCnz0PJe-5uNssgTKgM1Q';
// Here we don't use the second argument to map, since that would automatically
// load in non-clustered markers from the layer. Instead we add just the
// backing tileLayer, and then use the featureLayer only for its data.
var map = L.mapbox.map('map')
    .setView([-0.908667,100.3872087], 13)
    .addLayer(L.mapbox.tileLayer('mapbox.streets'));

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

  $('.ui.dropdown')
  .dropdown({
  });
	
	function telusuri()
	{
		var temp_berangkat= document.getElementById("keberangkatan");
		var halte_berangkat = temp_berangkat.value;
		var temp_datang= document.getElementById("kedatangan");
		var halte_datang = temp_datang.value;
		
		window.alert(halte_datang);

	}
	</script>



	

@endsection
