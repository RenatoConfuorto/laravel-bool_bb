<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\Orders\OrderRequest;


class PaymentController extends Controller 
{

    public function generate (Request $request,Gateway $gateway) {

        //  $gateway = new Gateway([
        //      'environment' => config('services.braintree.environment'),
        //      'merchantId' => config('services.braintree.merchantId'),
        //      'publicKey' => config('services.braintree.publicKey'),
        //      'privateKey' => config('services.braintree.privateKey')
        // ]);

        //  $token = $gateway->ClientToken()->generate();

        //  return view('user.payment', [
        //      'token' => $token
        //  ]);
        
            $token = $gateway->clientToken()->generate();
    
            $data = [
                'success' => true,
                'token' => $token
            ];
    
            return response()->json($data,200);
        }
    public function makePayment (OrderRequest $request,Gateway $gateway) {

    //     $gateway = new Gateway([
    //         'environment' => config('services.braintree.environment'),
    //         'merchantId' => config('services.braintree.merchantId'),
    //         'publicKey' => config('services.braintree.publicKey'),
    //         'privateKey' => config('services.braintree.privateKey')
    //     ]);

    //   $amount = $request->amount;
    //   $nonce = $request->payment_method_nonce;

    //   $result = $gateway->transaction()->sale([
    //       'amount' => $amount,
    //       'paymentMethodNonce' => $nonce,
    //       'options' => [
    //       'submitForSettlement' => true
    //       ]
    //   ]);
    //   if ($result->success ) {
    //     $transaction = $result->transaction;
    //     return back()->with('success_message', 'Transaction successful. The buyer is'. $transaction->id);
    // } else {
    //     $errors = "";
    //     foreach($result->errors->deepAll() as $error) {
    //         $errors[$error->code] = $error->message;
    //     }

    //     return back()->withErrors('An error occured with message '. $result->message);
    // }

    $result = $gateway->transaction()->sale([
        'amount' => $request->amount,
        'paymentMethodNonce' => $request->token,
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if($result->success){
        $data = [
            'success' => true,
            'message' => "Transazione eseguita con Successo!"
        ];
        return response()->json($data,200);
    }else{
        $data = [
            'success' => false,
            'message' => "Transazione Fallita!!"
        ];
        return response()->json($data,401);
    }

    
    }
}

