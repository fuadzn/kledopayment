<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getAllPayment(){
        $payment = Payment::get()->toJson(JSON_PRETTY_PRINT);
        return response($payment, 200);
    }

    public function createPayment(Request $request){
        $payment = new Payment;
        $payment->payment_name = $request->payment_name;
        $payment->save();

        return response()->json([
            "message" => "Payment record created"
        ], 201);
    }

    public function getPayment($id){
        if(Payment::where('id', $id)->exists()) {
            $payment = Payment::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($payment, 200);
        } else{
            return response()->json([
                "message" => "Paymente Not Found"
            ], 404);
        }
    }

    public function deletePayment($id){
        if(Payment::where('id', $id)->exists()) {
            $payment = Payment::find($id);
            $payment->delete();

            return response()->json([
                "message" => "records deleted successfully"
            ], 202);
        } else {
            return response()->json([
                "message" => "Payment Not Found"
            ], 404);
        }
    }
}
