<?php

namespace App\Http\Controllers;

use App\Models\AdminMedicineModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function paymentFrom()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        return view('frontend.payment');
    }
    public function createPaymentIntent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = auth()->user();
        if (!$user) {
            return Response::json(['error' => 'Unauthorized'], 401);
        }
        if ($request->input('cart')) {
            // Amount is in rupees
            $amount = $request->input('amount', 1000); // ₹100
            $convertedAmount = $amount * 100; // Convert to paise if required by gateway
        } else {
            // Amount is in dollars
            $amount = $request->input('amount', 10); // $10
            $convertedAmount = $amount * 100; // Convert to cents
        }
        $token = $request->input('stripeToken');   // You must send stripeToken from frontend

        try {
            // Step 1: Create a Stripe Customer
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name,
                'source' => $token, // Add the token as a payment source
            ]);

            // Step 2: Charge the Customer
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $convertedAmount,
                'currency' => 'usd',
                'description' => 'testing',
            ]);
            $user = auth()->user();
            $user->update(['is_premium' => 1]);
            if ($request->input('cart')) {
                $medicine = AdminMedicineModel::find($request->input('cart')[0]['id']);
                $medicine->quantity = $medicine->quantity - $request->input('cart')[0]['qty'];
                $medicine->save();
                //clear storage 
            }
            // dd('sucess');
            return Response::json(['message' => 'Payment successful!', 'customer_id' => $customer->id]);
        } catch (\Exception $e) {
            dd($e);
            return Response::json(['error' => $e->getMessage()], 400);
        }
    }

}
