<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;
use App\Sponsorship;
use App\Apartment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment(Request $request) {
        $sponsorship_id = $request->sponsor_id;

        $apartment = Apartment::find($request->apartment_id);


        $sponsorship = Sponsorship::where('id' , '=', $sponsorship_id)->first();

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);
        
        $nonce = $request->paymentMethodNonce;

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => True
            ]
          ]);
            
        if ($result->success){

            $transaction = $result->transaction;

            $lastEndDate = Carbon::parse(DB::table('apartment_sponsorship')
                            ->where('apartment_id', $request->apartment_id)
                            ->pluck('end_date')
                            ->sortDesc()
                            ->first());

            if($lastEndDate) {
                //Controllo se la data di fine più "lontana" è già passata o non
                if ($lastEndDate->greaterThan(Carbon::now()->format('d-m-Y'))) {
                    //Se lo è setta la data di inizio come l'ultima data di fine
                    $start_date = $lastEndDate->format('d-m-Y');
                } else {
                    $start_date = Carbon::now()->format('d-m-Y');
                };

                $end_date = Carbon::parse($start_date)->addHours($sponsorship->duration)->format('d-m-Y');

                $apartment->sponsorships()->attach($sponsorship->id, [
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);
            } else {
                //Non trova un record e ne registra uno come nuovo
                $start_date = Carbon::now()->format('d-m-Y');
                $end_date = Carbon::parse($start_date)->addHours($sponsorship->duration)->format('d-m-Y');
                $apartment->sponsorships()->attach($sponsorship->id, [
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);
            }

            return response()->json('Done' . $transaction->id);
        } else {
            return response()->json('Error');
        }
    }

}
