<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $quantity = 1;
        $cart = \Cart::add([
            [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'image' => $request->image,
                'quantity' => $quantity,
                'attributes' => [
                    'image' => $request->image,
                    'flavor' => '',
                    'occassion' => ''
                ]
            ]
        ]);
        return response()->json($cart);
    }

    public function publicList()
    {
        return response()->json([
            'products' => \Cart::getContent(),
            'total' => \Cart::getTotal(),
            'total_qty' => \Cart::getTotalQuantity(),
            'total_products' => \Cart::getContent()->count()
        ], 200);
    }

    public function removeProduct($id)
    {
        \Cart::remove($id);
    }

    public function updateCart(Request $request)
    {
        // dd($request->all());
        \Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
          ));
    }
}
