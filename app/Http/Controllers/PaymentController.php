<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use Mpesa;

class PaymentController extends Controller
{
    /**
     * account ref
     */
    private $account_ref = '';

    /**
     * constructor
     */
    public function __construct(){

        $this->account_ref = rand(100, 9999);
    }

    /**
     * create payment page
     */
    public function create(){

        return view('payment');
    }

    /**
     * lipa na mpesa
     */
    public function lipaNaMpesa(PaymentRequest $request){

        $phoneNumber = $request->payment_number;
        $amount = $request->payment_amount;
        $accountRef = $this->account_ref;
        $transactionDescription = $request->payment_description;
        try {
            $expressResponse = Mpesa::express($amount,$phoneNumber, $accountRef, $transactionDescription);

            $response = json_decode($expressResponse, true);

            info(print_r($response, true));
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        

        if($response['ResponseCode'] == 0){
            //successful reqyuest
            return back()->with('success', 'Transaction processed!');
        } else {
            //unsuccesful request
            return back()->with('error', 'Transaction failed!');
        }
    }


    /**
     * mpesa callback
     */
    public function LipaNaMpesaCallback(Request $request){

        //lipa na mpesa callback 
    }
}
