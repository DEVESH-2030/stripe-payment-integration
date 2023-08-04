<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->key =  Stripe::setApiKey(config('services.stripe.key'));
        $this->secret =  new \Stripe\StripeClient(config('services.stripe.secret'));
    }


    public function index()
    {
        $productWithPrice = [];

        $stripe = $this->secret;
        $getProducts = $stripe->products->all(['limit' => 3]);
        foreach ($getProducts as $product) {
            $productWithPrice[] = [
                'product' => $product,
                'price' => $stripe->prices->retrieve($product->default_price, []),
            ];
        }
        return view('subscription.plans')->with(compact('productWithPrice'));
    }

    public function create($productId)
    {
        $stripe = $this->secret;

        $product = $stripe->products->retrieve($productId, []);

        $product['price'] = $stripe->prices->retrieve($product->default_price, []);

        return view('subscription.create')->with(compact('product'));
    }

    public function orderPost(Request $request)
    {
        $user = auth()->user();
        $input = $request->all();
        // dd($input);
        $token =  config('services.stripe.secret');
        $stripe = $this->secret;

        $intent = $stripe->setupIntents->create(['usage' => 'on_session']);
        // dd($intent);
        // $stripe->paymentIntents->create([
        //     'amount' => 1099,
        //     'currency' => 'usd',
        //     'payment_method_types' => ['card'],
        // ]);

        // $payment = $stripe->paymentMethods->create([
        //     'type' => 'card',
        //     'card' => [
        //         'number' => (Hash::make($input['card_number'])),
        //         'exp_month' => $input['expiration_month'],
        //         'exp_year' => $input['expiration_year'],
        //         'cvc' => $input['cvc_number'],
        //     ],
        // ]);
        $paymentMethod = $request->paymentMethod;
        try {

            // $stripe = $this->key;
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // dd($stripe);
            if (is_null($user->stripe_id)) {
                $stripeCustomer = $user->createAsStripeCustomer();
            }
            // dd($user);
            $customer = \Stripe\Customer::createSource(
                $user->stripe_id,
                ['source' => $token]
            );
            // dd($customer);
            $user->newSubscription('test', $input['plane'])
                ->create($paymentMethod, [
                    'email' => $user->email,
                ]);

            return back()->with('success', 'Subscription is completed.');
        } catch (\Exception $e) {
            return back()->with('success', $e->getMessage());
        }
    }
}
