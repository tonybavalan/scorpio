<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create a new unique identifier.
     * 
     */
    public function createUid()
    {
        $uid = Str::random(8);

        return $uid;
    }

    /**
     * Make request to tomtom geocoding API.
     * 
     */
    public function geocoding($query)
    {
        $response = Http::timeout(5)->get('https://api.tomtom.com/search/2/geocode/'.$query.'.json?storeResult=false&typeahead=true&countrySet=IN&view=IN&key=NLv6kmsraNtNKpaoqqBHK6e3GZYFozJz');

        dd($response->body());
    }
}
