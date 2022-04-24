<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Waypoints;
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
     * @param mixed $query
     * @return \Illuminate\Http\Response
     */
    public function geocoding($query)
    {        
        $results = Http::acceptJson()->get('https://api.tomtom.com/search/2/geocode/'.$query.'.json?storeResult=false&typeahead=true&countrySet=IN&view=IN&key='.$this->map_key)
                    ['results'];

        $results = !empty($results) ? $results[0] : NULL;

        if($results != NULL)
        {
            $response['address'] = $results['address']['freeformAddress'];

            $response['position'] = json_encode($results['position']);

            return response()->json($response)->getData();
        }

        return $results;
    }

     /**
     * Make request to tomtom's structuredGeocoding API.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\Response
     */
    // public function structGeocoding($query)
    // {
    //     $results = Http::acceptJson()->get('https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IN&municipality=uthangudi&municipalitySubdivision=Madurai&countrySecondarySubdivision=India&countrySubdivision=Tamilnadu&view=IN&key='.$this->map_key);

    //     $response['address'] = $results['address']['freeformAddress'];

    //     $response['position'] = $results['position'];

    //     return response()->json($response);
    // }

     /**
     * Make request to tomtom's routing API.
     * 
     * @param mixed $pickup
     * @param mixed $drop
     * @return \Illuminate\Http\Response
     */
    public function routing($pickup, $drop)
    {
        $results = Http::acceptJson()->get('https://api.tomtom.com/routing/1/calculateRoute/'.$pickup->lat.','.$pickup->lon.':'.$drop->lat.','.$drop->lon.'/json?key='.$this->map_key)
                    ['routes'];

        $results = !empty($results) ? $results[0] : NULL;

        if($results != NULL)
        {
            $response['lengthInMeters'] = $results['summary']['lengthInMeters'];

            $response['travelTimeInSeconds'] = $results['summary']['travelTimeInSeconds'];

            $response['route'] = $results['legs'][0]['points'];
        }

        return response()->json($response)->getData();
    }

}
