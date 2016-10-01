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
		 position:absolute; 
		 top:0; 
		 bottom:0; 
		 width:100%;
		}
	.map-responsive {
		padding-bottom: 0%;
		height: 350px;
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

			<div class="form-horizontal" role="form">
			<div class="form-group">
			<div class="col-sm-5">
				<label class="control-label no-padding-right" for="form-field-1"> Keberangkatan </label>
				<div class="ui fluid search selection dropdown">
 							  <i class="ace-icon fa fa-bus blue"></i>

							  <input id="keberangkatan" type="hidden" name="country">
							  <i class="dropdown icon"></i>
							  <div class="default text">Keberangkatan</div>
							  <div class="menu">
							  <?php foreach ($halte as $key => $value) {?>
							  	<div class="item" data-value="<?php echo $value->id?>"></i> <?php echo $value->nama?> </div>
							  
							  <?php } ?>
							</div>
						</div>
			</div>	
				<div class="col-sm-5">
					<label class="control-label no-padding-right" for="form-field-1"> Kedatangan </label>
					
						<div class="ui fluid search selection dropdown">
 							  <i class="ace-icon fa fa-bus blue"></i>

							  <input id="kedatangan" type="hidden" name="country">
							  <i class="dropdown icon"></i>
							  <div class="default text">Kedatangan</div>
							  <div class="menu">
							  <?php foreach ($halte as $key => $value) {?>
							  	<div class="item" data-value="<?php echo $value->id?>"></i> <?php echo $value->nama?> </div>
							  
							  <?php } ?>			  
							  
							</div>
						</div>
				</div>
						
				<div class="col-sm-2">
					<label class="control-label no-padding-right" for="form-field-1"> <br> </label>
					<div>
						<button class="btn btn-sm btn-primary" onclick="telusuri()">
							<i class="ace-icon fa fa-flask"></i>
							Telusur
						</button>
						<button class="btn btn-sm btn-primary" onclick="berhenti_telusur()">
							<i class="ace-icon fa fa-flask"></i>
							Reset
						</button>
					<div>
						
				</div>		
				
			</div>
			</div>
			</div>
	<!-- <div class="row"> -->

		<div>
			<div class="map-responsive" >
    		<!-- <div id="halte" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></div>    	 -->
    		<div id="map"></div>
			
			</div>
			<!-- <div id="map" > </div> -->

		</div>
		
		<!-- </div> -->
		</div>
		<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">List Halte</h3>

		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			Halte yang Dilewati
			<!-- <a class="white pull-right" style="padding-right:5px" href="#" > Tambah Koridor
				<i class="fa fa-plus-circle fa-2x"></i>
			</a> -->
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div>
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">

				<thead>
					<tr>
						
						<th>Nama Halte</th>
						<th>Koridor</th>
						<th>Status</th>
						
					</tr>
				</thead>

				<tbody id="halte_yg_dilalui">
					<!-- <tr>  	
						<td>
							aaa
						</td>
						<td>
							bbb
						</td>
						<td>
							bb
						</td>
						
						
					</tr> -->


										
				</tbody>
			</table>
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
var fL = []
var groups= {};
var map = L.mapbox.map('map')
    .setView([-0.923498,100.408001], 12)
    .addLayer(L.mapbox.tileLayer('mapbox.streets'));


L.mapbox.featureLayer()
    .loadURL('{{ url('/') }}/halte')
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
    groups = {
      red: makeGroup('red'),
      green: makeGroup('green'),
      gray: makeGroup('gray'),
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
	var layer = []
	function berhenti_telusur(){
		groups.blue.addTo(map);
	}
	function telusuri()
	{
		var temp_berangkat= document.getElementById("keberangkatan");
		var halte_berangkat = temp_berangkat.value;
		var temp_datang= document.getElementById("kedatangan");
		var halte_datang = temp_datang.value;

		if(halte_datang=='' || halte_berangkat==''){
			return;
		}

		for (var i = 0; i < layer.length; i++) {
			map.removeLayer(layer[i])
		}
		map.removeLayer(groups.blue);
		map.removeLayer(groups.red);
		map.removeLayer(groups.yellow);
		map.removeLayer(groups.green);
		map.removeLayer(groups.gray);

		$.get( "{{ url('/') }}/pencarian_halte/"+halte_berangkat+"/"+halte_datang, function( data ) {
	        // var geojson = JSON.parse(data);
	        // var mark = L.mapbox.featureLayer(geojson);
	        // mark.addTo(map);
	        // layer.push(mark);
	    });

		$.get( "{{ url('/') }}/pencarian_optimal/"+halte_berangkat+"/"+halte_datang, function( data ) {
			data = JSON.parse(data)
			console.log(data);
			/* draw jalan */
			var line_points = data.poins;
	        var polyline_options = {
	            color: '#ff8730'
	        };       
	        var polyline = L.polyline(line_points, polyline_options).addTo(map);
	        layer.push(polyline);

	        /* draw marker */
	        var mark = L.mapbox.featureLayer(data.halte_markers);
	        mark.addTo(map);
	        layer.push(mark);

        	$("#halte_yg_dilalui").html("");

	        list_halte = data.list_halte;
	        halte_perpindahan = data.halte_perpindahan;
	        for (var i = 0; i < list_halte.length; i++) {
	        	
	        	halte = list_halte[i];
	        	
	        	if (i < list_halte.length-1) {
	        		halte_setelah = list_halte[i+1];
	        	}
	        	else
	        	{
	        		halte_setelah = null;
	        	}
	        	if ((halte.halte_id==halte_setelah.halte_id)&&(halte.koridor.nomor==halte_setelah.koridor.nomor)) {
	        		continue;
	        	}	        	
	        	var status = "Tetap";
	        	if (halte_perpindahan) {
	        		for (var j = 0; j < halte_perpindahan.length; j++) {
	        		halte_status = halte_perpindahan[j];
		        		if(halte_status.id==halte.halte_id)
		        		{
		        			status = "Tetap"
		        			if (halte.koridor.nomor != halte_setelah.koridor.nomor)
		        			{
		        					status = "Pindah Koridor"
		        			}
		        			
		        			
		        		}
		        	}
	        	}
	        	if (halte_setelah!=null) 
    			{
    				if ((halte.koridor.id!=halte_setelah.koridor.id)&&(halte.koridor.nomor==halte_setelah.koridor.nomor))
    				{
    					status = "Menyeberang"
    				}
    			}
				
	        	
	        	tr = $("<tr>").append(
	        		"<td>" + halte.keterangan +"<td>" + halte.koridor.nomor  +"<td>" + status
	        		)
	        	$("#halte_yg_dilalui").append(tr);
	        }
	        ;
    	}); 

	}
	</script>
@endsection
