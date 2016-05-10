@extends('maintemplate')

@section('breadcrumb')
	<li>Informasi Koridor</li>
@endsection

@section('page-header')
	Informasi Jadwal Kedatangan dan Keberangkatan
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		overview &amp; stats
	</small>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-8">
			<div class="tabbable">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active">
						<a data-toggle="tab" href="#koridor1">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							Koridor 1
						</a>

						
					</li>

					<li>
						<a data-toggle="tab" href="#koridor2">
						<i class="green ace-icon fa fa-home bigger-120"></i>
							koridor 2							
						</a>
					</li>

					<li class>
						<a data-toggle="tab" href="#koridor3">
							<i class="green ace-icon fa fa-home bigger-120"></i>
							Koridor 3
						</a>
					</li>

					

					</ul>

				<div class="tab-content">
					<div id="koridor1" class="tab-pane fade in active">
						<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>

						<div>
							<div id="map" width="400" height="200" frameborder="0" style="border:0" allowfullscreen></div>		
						</div>
					</div>

					<div id="koridor2" class="tab-pane fade">
						<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
					</div>
					<div id="koridor3" class="tab-pane fade">
						<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
					</div>

				</div>
			</div>
		</div>
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