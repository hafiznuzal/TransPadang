@extends('test_ungroup')

@section('rute_js_pulang')

 $.get( "{{ base_url() }}rute6a", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'red'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });

 $.get( "{{ base_url() }}halte_k6a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });       
@endsection

@section('rute_js_pergi')

 $.get( "{{ base_url() }}rute6b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'blue'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "{{ base_url() }}halte_k6b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });       
@endsection