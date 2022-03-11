<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree;

class PaymentController extends Controller
{
    public function payment(Request $request) {
        
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey'),
        ]);
        
        $nonce = $request->paymentMethodNonce;

        $result = $gateway->transaction()->sale([
            'amount' => '10',
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => True
            ]
          ]);
            
        if ($result->success){
            $transaction = $result->transaction;
            return response()->json('trimone' . $transaction->id);
        } else {
            return response()->json('trimone ti manda a cagare');
        }
    }

}
