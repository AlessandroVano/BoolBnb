<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /* APARTMENT ARCHIVE */
    public function index() {
        $apartments = Apartment::with(['services'])
                                ->select(['id', 'user_id', 'name', 'slug', 'price', 'description', 'rooms', 'max_people', 'bathrooms', 'square_meters', 'address', 'latitude', 'longitude', 'image', 'visibility'])
                                ->get();
                             
        foreach ($apartments as $apartment ) {
            if ($apartment->image) {
                $apartment->image = url('storage/' . $apartment->image);
            }       
        }
        foreach ($apartment->services as $service ) {
            $service->icon = url('storage/' . $service->icon);
        }
        return response()->json($apartments); 
    }  

    /* PAGINA DI DETTAGLIO DEGLI APARTMENT */

    public function show($slug) {
        $apartment = Apartment::where('slug', $slug)->with(['services'])->first();

        if(! $apartment) {
            $apartment['not_found'] = true;
        } elseif ($apartment->image) {
            $apartment->image = url('storage/' . $apartment->image);
        }
         if(! $apartment) {
            $apartment['not_found'] = true;
        } else {
           foreach ($apartment->services as $service ) {
               $service->icon = url('storage/' . $service->icon);
           }
        }  
        // RITORNO I DATI
        return response()->json($apartment);
    }
}
