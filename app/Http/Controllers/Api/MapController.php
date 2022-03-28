<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Make request to tomtom geocoding API.
     * 
     */
    public function geocoding($query)
    {
        $response = Http::get('https://api.tomtom.com/search/2/geocode/'.$query.'.json?storeResult=false&typeahead=true&countrySet=IN&view=IN&key=NLv6kmsraNtNKpaoqqBHK6e3GZYFozJz');

        return $response->body();
    }

     /**
     * Make request to tomtom geocoding API.
     * 
     */
    public function structGeocoding($query)
    {
        $response = Http::get('https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IN&municipality=uthangudi&municipalitySubdivision=Madurai&countrySecondarySubdivision=India&countrySubdivision=Tamilnadu&view=IN&key=NLv6kmsraNtNKpaoqqBHK6e3GZYFozJz');

        return $response->body();
    }

}
