<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index()
    {
        $shop = Shop::where('user_id', auth()->user()->id)->first();

        return view('user.shop.index')
            ->with('shop', $shop);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);
        $shop = new Shop();
        $shop->slug = $request->name;
        $shop->name = getShopCode($request->name);
        $shop->user_id = auth()->user()->id;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->email = $request->email;
        $shop->website = $request->website;
        $shop->save();
        return redirect()->back()->with('success', 'Shop created successfully');
    }

    public function update(Request $request,$slug)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);
        $shop = Shop::where('slug',$slug)->first();
        $shop->slug = $request->name;
        $shop->name = getShopCode($request->name);
        $shop->user_id = auth()->user()->id;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->email = $request->email;
        $shop->website = $request->website;
        $shop->save();
        return redirect()->back()->with('success', 'Shop created successfully');
    }
    public function storeProduct(Request $request){
        $request->validate([
            'name' => 'required',
            'original_price' => 'required',
            'sale_price' => 'nullable',
            'description' => 'required',
            'image' => 'nullable',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->slug = getProductCode($request->name);
        $product->shop_id = auth()->user()->shop->id;
        $product->original_price = $request->original_price;
        $product->sale_price = $request->sale_price;
        $product->description = $request->description;
        // $product->image = $request->image;
        $product->save();
        return redirect()->back()->with('success', 'Product created successfully');
    }
}
