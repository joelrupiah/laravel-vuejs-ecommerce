<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderItem;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(Request $request, $number = 10)
    {
        if (!$request->ajax()) {
            return abort(404);
        }
        $orders = Order::latest()->paginate($number);

        return response()->json([
            'orders' => $orders
        ]);
    }

    public function checkout(Request $request)
    {
        // dd($request->all());

        $payment_type = $request->payment_type;
        if ($payment_type === 'cash_on_delivery') {
            // dd('cash');
            $this->orderProcess($request);
        }else if($payment_type === 'card_payment'){
            // dd('card');
            $this->cardPayment($request);
        }elseif ($payment_type === 'mpesa') {
            // dd('mpesa');
            $this->stkPush($request);
        }
        
    }

    // Function for cash on delivery

    public function orderProcess($request)
    {
        // For Orders table
        $user = Auth::user();
        $shipping_address = '';
        if($request->shipping_address){
            $shipping_address = $request->shipping;
        }else{
            // check later
            $shipping_address = $user;
        }
        $payment_type = $request->payment_type;
        $items = \Cart::getContent();
        $total = \Cart::getTotal();

        $order = new Order();
        $order->user_id = $user->id;
        $order->shipping_address = json_encode($shipping_address);
        $order->payment_type = $payment_type;
        $order->total = $total;
        $order->sub_total = $total;
        $order->save();

        // For Order Items table
        $items = \Cart::getContent();
        
        foreach ($items as $row) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->item_name = $row->name;
            $order_item->item_price = $row->price;
            $order_item->item_quantity = $row->quantity;
            $order_item->save();
        }
        \Cart::clear();
    }

    // Function on MPESA checkout
    public function mpesaOrder($request)
    {
        dd($request);
    }

    public function cardPayment($request)
    {
        dd($request);
    }

    public function orderDetail(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }
        $order = Order::find($id);

        return response()->json([
            'order' => $order
        ]);
    }

    // Function generating mpesa transaction password

    public function password()
    {
        // generate timestamp
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        // use passkey
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        // use businessShortCode
        $businessShortCode = 174379;
        // generate password
        $password = base64_encode($businessShortCode.$passkey.$timestamp);

        return $password;
    }

    // Generate Access Token
    public function accessToken()
    {
        $consumer_key = "yKwcAgf5mEraLrMG2dMB1zGVzukfCoL1";
        $consumer_secret = "0nBeCiofcMhFolKv";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        $access_token = json_decode($curl_response);
        curl_close($curl);
        return $access_token->access_token;
    }

    // STK Push
    public function stkPush(Request $request)
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->accessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => 174379,
            'Password' => $this->password(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => 2,
            'PartyA' => 254715733257, // replace this with your phone number 254715733257
            'PartyB' => 174379,
            'PhoneNumber' => 254715733257, // replace this with your phone number
            'CallBackURL' => 'https://19c9d325fe0f.ngrok.io/api/stk/push/callback/url',
            'AccountReference' => "RoyalPorters Trial",
            'TransactionDesc' => "Lipa Na Mpesa"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return $curl_response;
    }

    public function mpesaRes(Request $request)
    {

    }
}
