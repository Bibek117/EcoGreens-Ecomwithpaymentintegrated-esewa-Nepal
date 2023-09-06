<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class EsewaController extends Controller
{
    public function esewaCheckoutApi(Request $request)
    {
        // try{

        $userId = Auth::user()->id;
        $ref_id = 'ecomcsit-' . Str::random(5);
        $all_total = \Cart::getTotal() + 100; //with rs 100 delivery charge
        $address = $request->input('country') . ',' . $request->input('district') . ',' . $request->input('city') . ',' . $request->input('street_address');
        $user = Auth::user();
        if ($user) {
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->country = $request->country;
            $user->district = $request->district;
            $user->city = $request->city;
            $user->address = $request->street_address;
            $user->phone = $request->phone;
            $user->second_mail = $request->email;
            $user->save();
        }
        $order = new Order();
        $order->user_id = $userId;
        $order->total_amount = $all_total;
        $order->shipping_add = $address;
        $order->save();
        $orderId = $order->id;

        $cartCollection = \Cart::getContent();
        foreach ($cartCollection as $product) {
            OrderItem::create([
                "order_id" => $orderId,
                "product_id" => $product->id,
                "quantity" => $product->quantity,
                "price" => $product->price,
            ]);
        }

        $payment = new Payment();
        $payment->order_id = $orderId;
        $payment->ref_id = $ref_id;
        $payment->total_price = $all_total;
        $payment->save();

        Cart::clear();
        return response()->json([
            'id' => $payment->id,
            'total_price' => $payment->total_price,
            'ref_id' => $payment->ref_id
        ]);
    }


    public function paymentSuccess(Request $request)
    {
        //from success url (query strings)
        $oid = $_GET['oid'];
        $refId = $_GET['refId'];
       // $amount = $_GET['amt'];

        $fraudCheckUrl = "https://uat.esewa.com.np/epay/transrec";
        $payment = Payment::where("ref_id", $oid)->firstOrFail();
       // $order = $payment->order;
        $data = [
            'amt' => $payment->total_price,
            'rid' => $refId,
            'pid' => $oid,
            'scd' => 'EPAYTEST',
        ];

        $curl = curl_init($fraudCheckUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

      //  dd($response);
        if(strpos($response,"Success") !== false){
            if(isset($payment)){
                $payment->payment_status = 1;
                $payment->save();
            }
            return redirect('success-page');
        }else{
            return redirect('fail-page');
        }
    }

    public function successPage(){
        return view('paysuccess');
    }

    public function failPage(){
        return view('payfail');
    }


    public function paymentFailure()
    {
        return redirect('/');
    }
}
