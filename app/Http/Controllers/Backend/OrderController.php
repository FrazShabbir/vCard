<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;
use App\Models\OrderStatus;
use App\Models\Card;
use App\Models\CardRenew;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')
        ->when(!empty(request()->input('status')), function ($q) {
            return $q->where('status', request()->status);
        })->get();
        return view('backend.orders.index')
            ->with('orders', $orders);
    }

    public function show($id)
    {
        $order = Order::with('user')->find($id);
        return view('backend.orders.show')
            ->with('order', $order);
    }

    public function edit($id)
    {
        $order = Order::with('user')->find($id);
        return view('backend.orders.edit')
            ->with('order', $order);
    }

    public function update(Request $request)
    {

        try {
            DB::beginTransaction();

            $order = Order::find($request->id);
            $orderStatus = OrderStatus::create([
                'order_id' => $order->id,
                'status' => $request->status,
                'comment' => $request->comment,
                'updated_by' => Auth::user()->id,
            ]);

            $order->status = $request->status;
            $order->save();

            if ($request->status == 'Approved') {
                $card = Card::create([
                    'user_id' => $order->user_id,
                    'card_number' => rand(000, 999) . '-' . rand(00, 99) . '-' . rand(0000, 9999),
                    'card_type' => $order->card_type,
                    'card_name' => $order->first_name . ' ' . $order->last_name,
                    'email' => $order->email,
                    'phone' => $order->phone,
                    'address' => $order->delivery_address,
                    'expiry' => Carbon::now()->addYear(1),
                    'card_type' => $order->type,
                    'status' => 'Approved',
                ]);
                $cardRenew = CardRenew::create([
                    'user_id' => $order->user_id,
                    'card_id' => $card->id,
                    'comment' => 'Customer First Time Card Generated for 1 Year.',
                    'expiry' => Carbon::now()->addYear(1),
                    'status' => 'Approved',
                ]);
                $order->user->card = 1;
                $order->user->expiry = $cardRenew->expiry;
                $order->user->save();
            }
          
            DB::commit();
            return redirect()->route('order.index');

        } catch (\Throwable$th) {
            DB::rollback();
            throw $th;
        }

    }
}
