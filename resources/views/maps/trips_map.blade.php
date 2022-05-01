@extends('layouts.app')

@section('title', 'Maps')

@pushOnce('styles')
<link rel='stylesheet' type='text/css' href='css/map.css'>
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
<script src='js/map.js'></script>
<script>
    // constants
    const API_KEY = '{{ env("MAP_KEY") }}';
    const APPLICATION_NAME = 'scorpio';
    const APPLICATION_VERSION = '1.0';

    console.log(APPLICATION_NAME, APPLICATION_VERSION); 

    tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

    // const locationButton = document.createElement("button");

    // locationButton.textContent = "Pan to Current Location";
    // locationButton.classList.add("custom-map-control-button");
    // locationButton.addEventListener("click", () => {
    //     // Try HTML5 geolocation.
    //     if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(
    //         (position) => {
    //             const pos = {
    //                 lat: position.coords.latitude,
    //                 lng: position.coords.longitude,
    //             };
    //             console.log(pos);
    //         }
    //     );
    //     } else {
    //     // Browser doesn't support Geolocation
    //     }
    // });

    const passengerInitCoordinates = [80.2707, 13.0827];
    let passengerMarker;

    const map = tt.map({
        key: API_KEY,
        container: 'map',
        zoom: 13,
        center: passengerInitCoordinates,
        stylesVisibility: {
            trafficIncidents: true,
            trafficFlow: true
        },
        attributionControlPosition: 'bottom-left',
    });

    passengerMarker = createPassengerMarker(passengerInitCoordinates, new tt.Popup({ offset: 35 }).setHTML("Click anywhere on the map to change passenger location."));

    passengerMarker.togglePopup();

    function createPassengerMarker(markerCoordinates, popup) {
        const passengerMarkerElement = document.createElement('div');
        passengerMarkerElement.innerHTML = "<img src='img/taxi_passanger.png' style='width: 30px; height: 30px';>";
        return new tt.Marker({ element: passengerMarkerElement }).setLngLat(markerCoordinates).setPopup(popup).addTo(map);
    }

    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
</script>
@endPushOnce