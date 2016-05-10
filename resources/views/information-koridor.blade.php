@extends('maintemplate')

@section('breadcrumb')
	<li>Informasi Koridor</li>
@endsection

@section('page-header')
	Informasi Koridor
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		overview &amp; stats
	</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="col-sm-12">
				<!-- <h3 class="header smaller lighter red">Bootstrap Wells</h3> -->

				<div class="well">
					<h4 class="green smaller lighter">Koridor 1</h4>
					Use the well as a simple effect on an element to give it an inset effect.
					<br>
					<a href="#my-modal" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
									&nbsp; Content Slider inside Modal Box &nbsp;
					</a>
				</div>

				<div class="well well-lg">
					<h4 class="blue">Koridor 2</h4>
					Control padding and rounded corners with two optional modifier classes.
					<br>
					<a href="#my-modal" role="button" class="bigger-125 bg-primary white" data-toggle="modal">
									&nbsp; Content Slider inside Modal Box &nbsp;
								</a>
				</div>
				<div class="well well-sm"> This is a small well </div>
			</div>
		</div>
	</div>
	<div id="my-modal" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="smaller lighter blue no-margin">A modal with a slider in it!</h3>
				</div>

				<div class="modal-body">
					<div id="map" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></div>
				</div>

				<div class="modal-footer">
					<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
						<i class="ace-icon fa fa-times"></i>
						Close
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
@endsection

@section('js')
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
	<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
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

	

@endsection