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
    public function __construct() {}

    /**
     * Make request to tomtom's geocoding API.
     * 
     * @param mixed $query
     * @return \Illuminate\Http\Response
     */
    public static function geocoding(string $query): ?object
    {
        try {
            $mapKey = env('MAP_KEY');

            $response = Http::acceptJson()->get('https://api.tomtom.com/search/2/geocode/' . $query . '.json?storeResult=false&typeahead=true&countrySet=IN&view=IN&key=' . $mapKey);

            if ($response->successful()) {
                $results = $response->json()['results'] ?? null;
                $result = !empty($results) ? $results[0] : null;

                if ($result !== null && isset($result['address']['freeformAddress'], $result['position'])) {
                    $response = [
                        'address' => $result['address']['freeformAddress'],
                        'position' => json_encode($result['position']),
                    ];

                    return (object) $response;
                }
            }

            return null;
        } catch (\Exception $e) {
            error_log('Geocoding error: ' . $e->getMessage());
            return null;
        }
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
    public static function routing($pickup, $drop)
    {
        try {
            $mapKey = env('MAP_KEY');

            $results = Http::acceptJson()->get('https://api.tomtom.com/routing/1/calculateRoute/' . $pickup->lat . ',' . $pickup->lon . ':' . $drop->lat . ',' . $drop->lon . '/json?key=' . $mapKey)['routes'];

            $results = !empty($results) ? $results[0] : null;

            if ($results != null) {
                $response['lengthInMeters'] = $results['summary']['lengthInMeters'];

                $response['travelTimeInSeconds'] = $results['summary']['travelTimeInSeconds'];

                $response['route'] = $results['legs'][0]['points'];
            }

            return response()->json($response)->getData();
        } catch (\Exception $e) {
            error_log('Geocoding error: ' . $e->getMessage());
            return null;
        }
    }
}
