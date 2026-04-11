<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payments;
class RazorpayController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ]);

            $payment = Payments::where('transaction_id', $request->razorpay_order_id)->first();

            if ($payment) {
                $payment->update([
                    'payment_id' => $request->razorpay_payment_id,
                    'status' => 'success'
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Payment successful'
            ]);

        } catch (\Exception $e) {

            $payment = Payments::where('transaction_id', $request->razorpay_order_id)->first();

            if ($payment) {
                $payment->update(['status' => 'failed']);
            }

            return response()->json([
                'status' => false,
                'message' => 'Payment failed'
            ]);
        }
    }
}
