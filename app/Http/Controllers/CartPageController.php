<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\Http;

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

        $post = Http::withToken(session()->get('user_token'))->withHeaders([
            'Accept' => 'application/json'
        ])->post('http://redstore-e-commerce.test/api/cart/add', $data);

        if(json_decode($post->body())->success) {
            return response()->json($post->body(), 200);
        }

        return response()->json($post->json(), 400);
    }

    //api
    public function addToCart(Request $request)
    {
        $data = $request->except('_token');

        $validators = Validator::make($data, [
            'product_id'    => 'required',
            'user_id'       => 'required',
            'quantity'      => 'required|integer|min:1',
            'total'         => 'required|integer',
            'size'          => 'required',
            'is_checkout'   => 'required'
        ]);

        if($validators->fails()){
            return response()->json([
                'success'   => false,
                'data'      => [],
                'message'   => $validators->errors()->all()
            ], 400);
        }

        $store = $this->order->create($data);

        if($store) {
            return response()->json([
                'success'   => true,
                'data'      => $store,
                'message'   => 'Successfully add to cart'
            ], 200);
        }

        return response()->json([
            'success'   => false,
            'data'      => [],
            'message'   => 'Failed add to cart'
        ], 400);
    }

    public function checkout(Request $request)
    {
        $find = $this->order->find($request['id']);

        if(!$find) {
            return response()->json([
                'success'   => false,
                'data'      => [],
                'message'   => 'Data order not found'
            ], 400);
        } 

        $find->is_checkout = 1;
        $find->save();

        return response()->json([
            'success'   => true,
            'data'      => $find,
            'message'   => 'Successfully checkout data'
        ], 200);
    }
}
