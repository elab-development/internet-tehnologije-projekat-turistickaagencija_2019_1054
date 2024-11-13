<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class StripeController extends Controller
{
    
    public function stripe(Request $request)
    {
         /*
        // Uzmi podatke iz forme
        $productName = $request->input('product_name');
        $quantity = $request->input('quantity');
        $price = $request->input('price'); // Cena u dolarima koju šaljete sa forme

        // Inicijalizujte Stripe
        $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

        // Kreirajte Stripe checkout sesiju
        $session = $stripe->checkout->sessions->create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => $productName],
                        'unit_amount' => $price * 100, // Cena u centima
                        'tax_behavior' => 'exclusive',
                    ],
                    'adjustable_quantity' => [
                        'enabled' => true,
                        'minimum' => 1,
                        'maximum' => 10,
                    ],
                    'quantity' => $quantity,
                ],
            ],
            'automatic_tax' => ['enabled' => true],
            'mode' => 'payment',
            'success_url' => route('payment.success'), // Route za uspešno plaćanje
            'cancel_url' => route('payment.cancel'),   // Route za otkazivanje
        ]);

        // Preusmerite korisnika na Stripe Checkout
        return redirect()->away($session->url);
    }

    // Metoda za uspešno plaćanje
    public function success(Request $request)
    {
        // Ovdje možete obraditi logiku uspešnog plaćanja
        return view('payment.success'); // Prikazuje stranicu sa uspešnim plaćanjem
    }

    // Metoda za otkazivanje plaćanja
    public function cancel(Request $request)
    {
        // Ovdje možete obraditi logiku otkazivanja
        return view('payment.cancel'); // Prikazuje stranicu sa otkazivanjem
         */
        // $stripe = new \Stripe\StripeClient(config('stripe.'));

        // $stripe->checkout->sessions->create([
        //     'line_items' => [
        //     [
        //     'price_data' => [
        //        'currency' => 'usd',
        //         'product_data' => ['name' => 'T-shirt'],
        //        'unit_amount' => 2000,
        //        'tax_behavior' => 'exclusive',
        //     ],
        //     'adjustable_quantity' => [
        //         'enabled' => true,
        //       'minimum' => 1,
        //         'maximum' => 10,
        //    ],
        //      'quantity' => 1,
        //      ],
        // ],
        //  'automatic_tax' => ['enabled' => true],
        //  'mode' => 'payment',
        // 'success_url' => 'https://example.com/success',
        // 'cancel_url' => 'https://example.com/cancel',
        // ]);

        // \Stripe\Stripe::setApiKey('sk_test_51QKfk4P0nFXW3WcjYVTfg4vMagGOaqQEEr8lBZDdSMdGLx0Fv6et03m1IfW2Dl4qgehVBS6jwVpP43RmXWaSCxUk0086LQI0KM');

        // $session = \Stripe\Checkout\Session::create([
        //     'payment_method_types' => ['card'],
        //     'line_items' => [
        //         [[
        //             'price' => 'price_1QKgi8P0nFXW3Wcjf2Bzvngt',
        //             'quantity' => 1,
        //             ]],
        //     ],
        //     'mode' => 'payment',
        //     'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
        //     'cancel_url' => 'https://example.com/cancel',
          
        // ]);
/////////////////////////////////////////////////////
/*
        $stripe = new \Stripe\StripeClient(
            'sk_test_51QKfk4P0nFXW3WcjYVTfg4vMagGOaqQEEr8lBZDdSMdGLx0Fv6et03m1IfW2Dl4qgehVBS6jwVpP43RmXWaSCxUk0086LQI0KM'
            );
            
            $a = $stripe->checkout->sessions->
            create
            ([
              'line_items' => [
                ['price' => 'price_1QKgi8P0nFXW3Wcjf2Bzvngt',
                 'quantity' => 1,
                ],
              ],
              'mode' => 'payment',
              'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
            ]);
            
            return redirect()->away($a->url);
            */
       //////////////////////////////////////////
       $stripe = new \Stripe\StripeClient('sk_test_51QKfk4P0nFXW3WcjYVTfg4vMagGOaqQEEr8lBZDdSMdGLx0Fv6et03m1IfW2Dl4qgehVBS6jwVpP43RmXWaSCxUk0086LQI0KM');
       
       $productName = $request->input('product_name');
       $quantity = $request->input('quantity');
       $price = $request->input('price') * 100; //
       $a = $stripe->checkout->sessions->create([
         'line_items' => [
           [
             'price_data' => [
               'currency' => 'usd',
               'product_data' => ['name' => $productName],
               'unit_amount' =>$price,
               'tax_behavior' => 'exclusive',
             ],
             'adjustable_quantity' => [
               'enabled' => true,
               'minimum' => 1,
               'maximum' => 10,
             ],
             'quantity' => $quantity,
           ],
         ],
         //'automatic_tax' => ['enabled' => true],
         'mode' => 'payment',
         'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
        // 'cancel_url' => 'https://example.com/cancel',
       ]);
       return redirect()->away($a->url);
    }
    
}
