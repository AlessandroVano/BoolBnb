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
            } else {
                $apartment->image = url('storage/img-apartments/Not-found.png');
            }  
        }
        foreach ($apartment->services as $service ) {
            $service->icon = url('storage/' . $service->icon);
        }

        return response()->json($apartments); 
    }

    public function filter(Request $request) {
        //Se sono stati inseriti servizi
        if( count($request->filteredServices) > 0 ) {

            //Creazione di un array di array con NOME COLONNA e ID
            $filtersArray = [];
            foreach($request->filteredServices as $filterId) {
                $filtersArray[] = ['service_id', strval($filterId)];
            }
            
            if(count($filtersArray) > 1) {
                //Creazione di un array di ID dei filtri selezionati e dei relativi APPARTAMENTI
                $apartmentsFilteredByServices = DB::table('apartment_service')
                                                ->whereIn('service_id',$filtersArray)
                                                ->select('apartment_id')
                                                ->distinct()
                                                ->get();

                //Controllare se all'interno dell'array $apartmentsFilteredByServices l'ID di ogni appartamento compare un numero di volte uguale al count di $filtersArray
                /*$idApartmentArray = [];
                foreach ($apartmentsFilteredByServices as $apartment) {
                    $idApartmentArray[] = $apartment->apartment_id;
                }

                $countIdApartment = array_count_values($idApartmentArray);

                $apartmentSelected = [];
                foreach ($countIdApartment as $key => $value) {

                    if($value == 2) {
                        $apartmentSelected[] = $key;
                    }
                }
                return response()->json($apartmentSelected); */
            } else {
                $apartmentsFilteredByServices = DB::table('apartment_service')
                                                ->where($filtersArray)
                                                ->select('apartment_id')
                                                ->distinct()
                                                ->get();
            }

            //return response()->json($apartmentsFilteredByServices);
            $apartmentsIdFilteredByServices = [];
            foreach ($apartmentsFilteredByServices as $apartment) {
                $apartmentsIdFilteredByServices[] = $apartment->apartment_id;
                
            }

            //Interrogazione del DB con i criteri passati
            $apartments = Apartment::where('max_people', '>=', $request->maxPeople)
                                    ->where('rooms', '>=', $request->maxRoom)
                                    ->where('visibility', 1)
                                    ->whereIn('id', $apartmentsIdFilteredByServices)
                                    ->get();

                foreach($apartments as $apartment){
                    if ($apartment->image) {
                        $apartment->image = url('storage/' . $apartment->image);
                    }
                }
                
        } else {
            //Interrogazione del DB con i criteri passati
            $apartments = Apartment::where('max_people', '>=', $request->maxPeople)
                                    ->where('rooms', '>=', $request->maxRoom)
                                    ->where('visibility', 1)
                                    ->get();
                foreach($apartments as $apartment){
                    if ($apartment->image) {
                        $apartment->image = url('storage/' . $apartment->image);
                    }
                }
        }


            //Calcolo della distanza di ogni appartamento preso dal DB rispetto al punto selezionato
            $p = 0.017453292519943295;
            $filteredApartments = [];
            foreach ( $apartments as $apartment ) {
                $a =
                0.5 -
                cos(($apartment->latitude - $request->selectedLat) * $p) / 2 +
                (cos($request->selectedLat * $p) *
                cos($apartment->latitude * $p) *
                (1 - cos(($apartment->longitude - $request->selectedLon) * $p))) /
                2;
                $distance = 12742 * asin(sqrt($a));

                $apartment['distance'] = $distance;
                if ($distance < $request->selectedDistance) {
                    $filteredApartments[] = $apartment;
                }
            }

            $distance_column = array_column($filteredApartments, 'distance');
            
            array_multisort($distance_column, SORT_ASC, $filteredApartments);

        //return response()->json($filteredApartments);
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
