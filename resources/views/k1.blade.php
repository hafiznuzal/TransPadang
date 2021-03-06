@extends('test_ungroup')

@section('rute_js_pulang')

 $.get( "{{ url('/') }}/rute1a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'red'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });

 $.get( "{{ url('/') }}/halte_ka1a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });       
@endsection

@section('rute_js_pergi')

 $.get( "{{ url('/') }}/rute1b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'blue'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "{{ url('/') }}/halte_k1b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });       
@endsection