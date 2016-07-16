@extends('maintemplate')

@section('breadcrumb')
	<li>Informasi Koridor</li>
@endsection

@section('page-header')
	Manajemen Basis Data
	<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		overview &amp; stats
	</small>
@endsection

@section('content')

@yield('content-tabel');


@endsection
@section('js')
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
	<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
	<script src="{{ url('js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ url('js/jquery.dataTables.bootstrap.min.js')}}"></script>
	<script src="{{ url('js/dataTables.tableTools.min.js')}}"></script>
	<script src="{{ url('js/dataTables.colVis.min.js')}}"></script>
	<script>
		function changekor() 
		{
		    var selectBox = document.getElementById("selectBox");
		    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

		    console.log(selectedValue);
		    window.location="/TransPadang/public/jadwal/"+selectedValue;
		}
	</script>
	


	

@endsection