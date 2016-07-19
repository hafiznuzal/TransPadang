@extends('maintemplate')

@section('breadcrumb')
	<li>Manajemen Basis Data</li>
@endsection

@section('page-header')
	@yield('judul')
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
		function changekor_halte() 
		{
		    var selectBox = document.getElementById("selectBox");
		    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

		    console.log(selectedValue);
		    window.location="/TransPadang/public/manajemen_halte/"+selectedValue;
		}
		function changekor_point() 
		{
		    var selectBox = document.getElementById("selectBox");
		    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

		    console.log(selectedValue);
		    window.location="/TransPadang/public/manajemen_point/"+selectedValue;
		}

		function delete_point($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/delete_point/"+selectedValue;
		}
		function delete_halte($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/delete_halte/"+selectedValue;
		}
		function delete_koridor($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/delete_koridor/"+selectedValue;
		}
		function delete_rute($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/delete_rute/"+selectedValue;
		}
		function add_point()
		{	
			// var selectedValue = $id;
			window.location="/TransPadang/public/tambah_point";
		}
		function add_halte()
		{	
			// var selectedValue = $id;
			window.location="/TransPadang/public/tambah_halte";
		}
		function add_koridor()
		{	
			// var selectedValue = $id;
			window.location="/TransPadang/public/tambah_koridor";
		}
		function add_rute()
		{	
			// var selectedValue = $id;
			window.location="/TransPadang/public/tambah_rute";
		}
		function edit_point($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/edit_point/"+selectedValue;
		}
		function edit_halte($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/edit_halte/"+selectedValue;
		}
		function edit_koridor($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/edit_koridor/"+selectedValue;
		}
		function edit_rute($id)
		{	
			var selectedValue = $id;
			window.location="/TransPadang/public/edit_rute/"+selectedValue;
		}
		var oTable1 = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			    } );
	</script>	

@endsection