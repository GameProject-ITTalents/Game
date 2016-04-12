<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartItem;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addItem ($objectId){

        $cart = Cart::where('user_id', Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }

        $cartItem  = new CartItem();
        $cartItem->object_id = $objectId;
        $cartItem->cart_id = $cart->id;
        $cartItem->save();

        return redirect('/cart')->with('additionStatus', 'Power-up added to the cart');
    }

    public function showCart(){
        $cart = Cart::where('user_id', Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }
        $items = $cart->cartItems;
        $total=0;
        foreach($items as $item){
            $total += $item->object->price;
        }
        return view('cart.view', compact('items', 'total'));
    }

    public function removeItem($id){

        CartItem::destroy($id);
        return redirect('/cart');
    }

    /*public function buyWithCoins($total, $itemsString)
    {
        $items = json_decode($itemsString);
        if ($total <= Auth::user()->coins) {
            $coins = Auth::user()->coins;
            dd($itemsString);
            return redirect('/cart');
        }
        else {
            return redirect('/buyCoins');
        }
    }*/
}

