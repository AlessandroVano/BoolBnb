<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sponsorship;
use App\Apartment;
use App\ApartmentSponsorship;

use Carbon\Carbon;

class SponsorshipController extends Controller
{
    public function show($id) {
        $apartment = Apartment::find($id);
        $sponsorships = Sponsorship::all();
        
        return view('admin.sponsorships.index', compact('sponsorships', 'apartment'));
    }

    public function sponsorizza($sponsorship) {

        //Salvo in una variabile tutti i dati ritornati
        //$data = $request->all();

        // dd($sponsorship);

        //Salvo la data odierna
        $now = Carbon::now();

        $checkApartment = ApartmentSponsorship::where('apartment_id', $request->apartment_id);

        if ( !$checkApartment ) {
            //Controllo sul DB se esiste un record già esistente e mi salvo la data di fine più "lontana"
            $lastEndDate = Carbon::parse(ApartmentSponsorship::where('apartment_id', $request->apartment_id)->pluck('end_date')->sortDesc()->first());
    
            //Controllo se la data di fine più "lontana" è già passata o non
            if ($lastEndDate->greaterThan($now)) {
                $request['start_date'] = $lastEndDate;
            } else {
                $request['start_date'] = $now;
            };
        } else {
            $request['start_date'] = $now;
        }

        //Aggiungo durata alla data inizio e calcolo data fine
        $duration = Sponsorship::where('id', $request->sponsorship_id)->pluck('duration')->first();

        $request['end_date'] = Carbon::parse($request['start_date'])->addHours($duration);

        //Salvo i dati in DB
        $ApartmentSponsorship = ApartmentSponsorship::create($data);
        /* $ApartmentSponsorship = new ApartmentSponsorship;
        $ApartmentSponsorship->fill($data);
        $ApartmentSponsorship->save(); */

        //Trovo l'appartamento per prendere lo slug
        $apartment = Apartment::where('id', $request->apartment_id)->first();

        return redirect()->route('admin.apartments.show', $apartment['apartment_id']);
    }
}
