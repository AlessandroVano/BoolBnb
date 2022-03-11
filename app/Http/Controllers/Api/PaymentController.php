<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;
use App\Sponsorship;
use App\Apartment;
use Carbon\Carbon;

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

            $start_date = Carbon::now()->format('d-m-Y');
            $end_date = Carbon::parse($start_date)->addHours($sponsorship->duration)->format('d-m-Y');
            $apartment->sponsorships()->attach($sponsorship->id , [
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);

            return response()->json('Done' . $transaction->id);
        } else {
            return response()->json('Error');
        }
    }

}
