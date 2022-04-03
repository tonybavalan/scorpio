<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    /**
     * Constructor for MapController.
     * 
     */   
    public function __construct()
    {
        $this->map_key = env('MAP_KEY');
    }

    /**
     * Make request to tomtom's geocoding API.
     * 
     */
    public function geocoding($query)
    {        
        $results = Http::acceptJson()->get('https://api.tomtom.com/search/2/geocode/'.$query.'.json?storeResult=false&typeahead=true&countrySet=IN&view=IN&key='.$this->map_key)
                    ['results']
                    [0];

        $response['address'] = $results['address']['freeformAddress'];

        $response['position'] = $results['position'];

        return $response;
    }

     /**
     * Make request to tomtom's structuredGeocoding API.
     * 
     */
    public function structGeocoding($query)
    {
        $results = Http::acceptJson()->get('https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IN&municipality=uthangudi&municipalitySubdivision=Madurai&countrySecondarySubdivision=India&countrySubdivision=Tamilnadu&view=IN&key='.$this->map_key);

        $response['address'] = $results['address']['freeformAddress'];

        $response['position'] = $results['position'];

        return $response;
    }

}
