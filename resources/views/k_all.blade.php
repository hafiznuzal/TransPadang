@extends('koridor_all')

@section('js_koridor_1')
 $.get( "{{ base_url() }}rute1a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'red'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "{{ base_url() }}rute1b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#red'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "{{ base_url() }}halte_ka1a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "{{ base_url() }}halte_k1b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
@endsection

@section('js_koridor_2')

 $.get( "{{ base_url() }}rute2a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'blue'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "{{ base_url() }}rute2b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'blue'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "{{ base_url() }}halte_k2a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "{{ base_url() }}halte_k2b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection

@section('js_koridor_3')

 $.get( "{{ base_url() }}rute3a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'green'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "{{ base_url() }}rute3b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'green'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "{{ base_url() }}halte_k3a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "{{ base_url() }}halte_k3b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection
@section('js_koridor_5')

 $.get( "{{ base_url() }}rute5a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'yellow'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "{{ base_url() }}rute5b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: 'yellow'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);

    });

 $.get( "{{ base_url() }}halte_k5a", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });
 $.get( "{{ base_url() }}halte_k5b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection

@section('js_koridor_6')

 $.get( "{{ base_url() }}rute6a", function( data ) {
       
        var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#000'
        };       
        var polyline = L.polyline(line_points, polyline_options).addTo(map);
        layer.push(polyline);
    });
 $.get( "{{ base_url() }}rute6b", function( data ) {
       
       var line_points = JSON.parse(data);       
        var polyline_options = {
            color: '#000'
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
 $.get( "{{ base_url() }}halte_k6b", function( data ) {
       
       
        var geojson = JSON.parse(data);
        var mark = L.mapbox.featureLayer(geojson);
        mark.addTo(map);
        layer.push(mark);
      
        
    });                
@endsection