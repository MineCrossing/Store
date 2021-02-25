<?php

namespace App\Http\Controllers;

use Exception;
use App\Mail\PurchaseMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }

        if(Auth::user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        return view('checkout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {

        // dd($request->all());
        $contents = Cart::content()->map(function($item) {
            return $item->model->slug.', '.$item->qty;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                ],
            ]);

            $order = $this->addToOrdersTables($request, null);

            //Successful Payment
            Cart::instance('default')->destroy();

            //Successful at this point
            Mail::to($request->email)->send(new PurchaseMail($order));
            return redirect()->route('confirmation.index')->with('success', 'Your payment was successful!');
        } catch(CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! '.$e->getMessage());
        }
    }

    /**
     * Add orders to associated tables upon checkout.
     */
    protected function addToOrdersTables($request, $error) {
        //Insert into orders table
        $order = Order::create([
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_county' => $request->county,
            'billing_postcode' => $request->postcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_total' => Cart::total(),
            'error' => $error,
        ]);

        //Insert into order_product table
        foreach(Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }
}
