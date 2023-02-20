<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use DB;
class CardController extends Controller
{
    public function index()
    {
        return view('user.card.index');
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->card = $request->card;
        $user->save();
        alert()->success('Card Updated Successfully', 'Success');
        return redirect()->back();
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'delivery_address'=>'required',
        ]);

        try {
            db::beginTransaction();
            $user = auth()->user();
            $order = Order::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'delivery_address' => $request->delivery_address,
                'status' => 'Pending',
                'price' => '1100',
                'sale_price' => '1000',
                'shipping' => '100',
                'total' => '1100',
                'discount' => '0',
                'coupon' => null,
                'type' => $request->type,
            ]);

            $orderStatus = OrderStatus::create([
                'order_id' => $order->id,
                'status' => 'Pending',
                // 'updated_by' => $user->id,
                'comment' => 'Order Placed',
            ]);
            DB::commit();
            alert()->success('Card Ordered Successfully', 'Success');
            return redirect()->back();
          
        } catch (\Throwable$th) {

            DB::rollback();
            throw $th;
        }

    }
}
