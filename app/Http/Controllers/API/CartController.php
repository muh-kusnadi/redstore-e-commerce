<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class CartController extends Controller
{
    public function __construct(Order $order)
    {
        $this->order = $order;
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
        $find = $this->order->where('uuid', $request['uuid'])->get();

        if(count($find) < 1) {
            return response()->json([
                'success'   => false,
                'data'      => [],
                'message'   => 'Order not found'
            ], 400);
        } 

        $update = $this->order->where('uuid', $request['uuid'])->update(['is_checkout' => 1]);

        return response()->json([
            'success'   => true,
            'message'   => 'Successfully checkout data'
        ], 200);
    }

    public function removefromCart($id)
    {
        $order = $this->order->find($id);
        if(!$order) {
            return response()->json([
                'success'   => false,
                'message'   => 'Order not found'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Order has been removed from cart.'
        ], 200);
    }
}
