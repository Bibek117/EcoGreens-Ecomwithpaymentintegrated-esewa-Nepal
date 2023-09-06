<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //payment_checkout
    public function process()
    {

        $user = Auth::user();
        $carts = \Cart::getContent();
        return view('frontend.order.checkout', compact('carts','user'));
    }
}
