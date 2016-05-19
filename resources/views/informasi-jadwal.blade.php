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

						<div class="map-responsive">
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
		var mapTooltips = L.mapbox.map('map', 'mapbox.streets')
		  .setView([-0.908667,100.3872087], 13);
		var myLayer = L.mapbox.featureLayer().addTo(mapTooltips);
		 $.get( "/TransPadang/public/halte_ungroup", function( data ) {
		       // data = data + ";";
		var geojson = JSON.parse(data);

	   // Define polyline options
	    // http://leafletjs.com/reference.html#polyline
	   	myLayer.setGeoJSON(geojson);
		mapTooltips.scrollWheelZoom.disable();

    });
 

</script>

	

@endsection