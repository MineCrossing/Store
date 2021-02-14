<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Cart::content());
        return view('cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;

        $duplicates = Cart::search( function($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('info', 'Item is already in your cart');
        }

        Cart::add($id, $name, 1, $price, [], 10)->associate(Product::class);

        return redirect()->route('cart.index')->with('success', 'Item added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,10'
        ]);

        if($validator->fails()) {
            session()->flash('error', collect('Quantity must be between 1 and 10.'));

            return response()->json(['success' => false], 400);
        }
        Cart::update($id, $request->quantity);

        session()->flash('success', 'Quantity Updated!');

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success', 'Item has been removed');
    }

    public function switchToSaveForLater($id) {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search( function($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('info', 'Item is already in your Saved For Later');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price, [], 10)->associate(Product::class);

        return redirect()->route('cart.index')->with('success', 'Item added to Saved For Later');
    }
}
