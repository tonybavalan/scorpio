@extends('layouts.app')

@section('title', 'Maps')

@pushOnce('styles')
<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.18.0/maps/maps.css'>
<style>
    html {
        height: 100%;
    }

    .map {
        height: 98vh;
        border: 1px solid black
    }
</style>
@endPushOnce

@section('content')
<div id="map" class="map"></div>
@endsection

@pushOnce('scripts')
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.18.0/maps/maps-web.min.js'></script>
<script>
    // constants
    const API_KEY = '{{ env("MAP_KEY") }}';
    const APPLICATION_NAME = 'scorpio';
    const APPLICATION_VERSION = '1.0';

    // initial scripts for tom tom map integration
    var address = [80.2707, 13.0827];

    tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

    const map = tt.map({
        key: API_KEY,
        container: 'map',
        zoom: 3,
        center: address,
        stylesVisibility: {
            trafficIncidents: true,
            trafficFlow: true
        },
        attributionControlPosition: 'bottom-left',
    });
    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
</script>
@endPushOnce