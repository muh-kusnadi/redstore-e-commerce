<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class CartPageController extends Controller
{
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $cart = $this->order->cart(Auth::id());
        return view('pages.front.cart', [
            'cart'      => $cart
        ]);
    }

    public function cart(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::user()->id;

        //check cart
        $cart = $this->order->cart(Auth::id());
        //set uuid value
        if(count($cart) > 0) {
            $data['uuid'] = $cart[0]->uuid;
        } else {
            $data['uuid'] = Uuid::uuid4();
        }

        $post = Http::withToken(session()->get('user_token'))->withHeaders([
            'Accept' => 'application/json'
        ])->post(env('APP_URL').'api/cart/add', $data);

        if(json_decode($post->body())->success) {
            return response()->json($post->body(), 200);
        }

        return response()->json($post->json(), 400);
    }

    public function removefromCart($id)
    {
        $post = Http::withToken(session()->get('user_token'))->withHeaders([
            'Accept' => 'application/json'
        ])->delete(env('APP_URL').'api/cart/remove/'.$id);

        if(json_decode($post->body())->success) {
            return response()->json($post->body(), 200);
        }

        return response()->json($post->json(), 400);
    }

    public function checkout(Request $request)
    {
        $post = Http::withToken(session()->get('user_token'))->withHeaders([
            'Accept' => 'application/json'
        ])->post(env('APP_URL').'api/cart/checkout', $request->except('_token'));

        if(json_decode($post->body())->success) {
            return response()->json($post->body(), 200);
        }

        return response()->json($post->json(), 400);
    }
}
