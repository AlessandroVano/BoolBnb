<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function filteredApartments($services) {
        $apartmentId = DB::table('apartment_service')->whereIn('service_id', explode(',', $services))->select('apartment_id')->distinct()->get();
        $apartmentsIdArray = [];
        foreach ($apartmentId as $apartment) {
            $apartmentsIdArray[] = $apartment->apartment_id;
        }
        $apartments = Apartment::with(['services:name'])
                    ->whereIn('id', $apartmentsIdArray)
                    ->select(['id', 'user_id', 'name', 'slug', 'price', 'description', 'rooms', 'max_people', 'bathrooms', 'square_meters', 'address', 'latitude', 'longitude', 'image', 'visibility'])->get();
        foreach($apartments as $apartment) {
            if(!preg_match('/http/', $apartment->image)) {
                $apartment->image = url('storage/{$apartment->image}');
            }
        }
        return response()->json($apartments);
    }

    public function filter(Request $request) {
        $apartments = Apartment::all();
        $p = 0.017453292519943295;
        $filteredApartments = [];
        foreach ($apartments as $apartment) {
            $a =
                0.5 -
                cos(($apartment->latitude - $request->selectedLat) * $p) / 2 +
                (cos($request->selectedLat * $p) *
                    cos($apartment->latitude * $p) *
                    (1 - cos(($apartment->longitude - $request->selectedLon) * $p))) /
                    2;
                    $distance = 12742 * asin(sqrt($a));
                   $d = number_format($distance, 3);
                   if ($d < 20) {
                       $filteredApartments[] = $apartment;
                   }
        }
        return response()->json($filteredApartments);
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
