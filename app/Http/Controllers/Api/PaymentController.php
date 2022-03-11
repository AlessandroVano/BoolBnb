<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;
use App\Sponsorship;

class PaymentController extends Controller
{
    public function payment(Request $request) {
        $sponsorship_id = $request->data->sponsor_id;
        return response()->json($sponsorship_id);

        $sponsorship = Sponsorship::where('id', 'sponsorship_id')->first();
        

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
            return response()->json('Done' . $transaction->id);
        } else {
            return response()->json('Error');
        }
    }

}
