<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /* APARTMENT ARCHIVE */
    public function index() {
     /*    return 'TRIMONEEE'; */

        $apartments = Apartment::all();

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
        // RITORNO I DATI
        return response()->json($apartment);
    }
}
