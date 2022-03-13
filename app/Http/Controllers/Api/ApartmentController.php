<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApartmentController extends Controller
{
    /* APARTMENT ARCHIVE */
    public function index() {

        $apartmentsId = DB::table('apartment_sponsorship')->select('apartment_id')->distinct()->get();

        $apartmentsIdArray = [];
        foreach ($apartmentsId as $apartment) {
            $apartmentsIdArray[] = $apartment->apartment_id;
        }

        $apartments = Apartment::with(['services'])
                                ->whereIn('id', $apartmentsIdArray)
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
        $apartmentsSponsorshipActive = [];
        //Controllo sponsorship
        foreach ($apartments as $apartment) {
            //Interrogo il DB per trovare un record nella pivot con l'ID dell'appartamento
            $lastEndDate = Carbon::parse(DB::table('apartment_sponsorship')
                    ->where('apartment_id', $apartment->id)
                    ->pluck('end_date')
                    ->sortDesc()
                    ->first()
            );

            //Confronto se il dato ritornato è più avandio di ora
            if ($lastEndDate->greaterThan(Carbon::now())) {
                $apartment['sponsorship'] = 1;
                $apartmentsSponsorshipActive[] = $apartment;
            };
        }

        return response()->json($apartmentsSponsorshipActive);
    }

    public function filter(Request $request) {
        //Se sono stati inseriti servizi

        $filtersArray = $request->filteredServices;
        if(count($filtersArray) > 0){

            $apartmentsFilteredByServices = DB::table('apartment_service')
                                        ->whereIn('service_id', $filtersArray)
                                        ->select('apartment_id', DB::raw('count(id)') )
                                        ->groupBy('apartment_id')
                                        ->having('count(id)' , count($filtersArray))
                                        ->get();
    
            $idApartmentArray = [];
            foreach ($apartmentsFilteredByServices as $apartment) {
                $idApartmentArray[] = $apartment->apartment_id;
            }
                    
            $apartments = Apartment::with('services')
                                ->whereIn('id', $idApartmentArray)
                                ->where([
                                        ['visibility' , 1],
                                        ['rooms', '>=', $request->maxRoom],
                                        ['max_people', '>=', $request->maxPeople],
                                    ])
                                    ->get();
        } else {
            $apartments = Apartment::with('services')
                                    ->where([
                                            ['visibility' , 1],
                                            ['rooms', '>=', $request->maxRoom],
                                            ['max_people', '>=', $request->maxPeople],
                                        ])
                                    ->get();
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
        //Controllo sponsorship
        foreach ($filteredApartments as $apartment) {
            //Interrogo il DB per trovare un record nella pivot con l'ID dell'appartamento
            $lastEndDate = Carbon::parse(DB::table('apartment_sponsorship')
                ->where('apartment_id', $apartment->id)
                ->pluck('end_date')
                ->sortDesc()
                ->first()
            );

            //Confronto se il dato ritornato è più avandio di ora
            if($lastEndDate->greaterThan(Carbon::now())) {
                $apartment['sponsorship'] = 1;
            } else {
                $apartment['sponsorship'] = 0;
            };

        }

        //Order by DISTANCE
        $distance_column = array_column($filteredApartments, 'distance');
        array_multisort($distance_column, SORT_ASC, $filteredApartments);
        
        //Order by SPONSORSHIP
        $sponsorship_column = array_column($filteredApartments, 'sponsorship');
        array_multisort($sponsorship_column, SORT_DESC, $filteredApartments);

        foreach ($filteredApartments as $apartment ) {
            if ($apartment->image) {
                $apartment->image = url('storage/' . $apartment->image);
            } else {
                $apartment->image = url('storage/img-apartments/Not-found.png');
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
