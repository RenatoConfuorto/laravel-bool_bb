<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\Orders\OrderRequest;
use App\SponsorType;


class PaymentController extends Controller 
{
    // public function payment ($id) {
    //     return view('user.apartment.payment');
    // }
    public function tokenGenerate (Request $request,Gateway $gateway) {

       

        //  $token = $gateway->ClientToken()->generate();
        
        //  return view('payment', compact('clientToken','id','sponsors_type'));;
        
            $token = $gateway->clientToken()->generate();
    
            $data = [
                'success' => true,
                'token' => $token
            ];
    
            return view('user.apartment.payment', [
                'token' => $token
              ]);;
        }
    public function makePayment (OrderRequest $request,Gateway $gateway) {

    $sponsor_type = SponsorType::find($request->sponsor_type);

    $result = $gateway->transaction()->sale([
        'amount' =>  $sponsor_type->price,
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

    // private function gateway(){
    //     $gateway = new Braintree\Gateway([
    //       'environment' => env('BT_ENVIRONMENT'),
    //       'merchantId' => env('BT_MERCHANT_ID'),
    //       'publicKey' => env('BT_PUBLIC_KEY'),
    //       'privateKey' => env('BT_PRIVATE_KEY')
    //       ]);
    //     return $gateway;
    //   }