<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Session;

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

        $slug = getShopCode($request->name);

        $shop = new Shop();
        $shop->name = $request->name;
        $shop->slug = $slug;
        $shop->user_id = auth()->user()->id;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->email = $request->email;
        $shop->save();
        if ($request->website) {
            $shortlink = new ShortLink();
            $shortlink->slug = $slug;
            $shortlink->shop_id = $shop->id;
            $shortlink->link = $request->website;
            $shortlink->shortlink = route('shortlink', $slug);
            $shortlink->save();
            $shop->website = $shortlink->shortlink;
        } else {
            $shop->website = $request->website;
        }

        $shop->save();
        return redirect()->back()->with('success', 'Shop created successfully');
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

        $shop = Shop::where('slug', $slug)->first();
        $shop->slug = $request->name;
        $shop->name = getShopCode($request->name);
        $shop->user_id = auth()->user()->id;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->email = $request->email;
        if ($request->website) {
            $findShortLink = ShortLink::where('shop_id', $shop->id)->first();
            if ($findShortLink) {
                $shortlink = $findShortLink;
            } else {
                $shortlink = new ShortLink();
            }
            $shortlink->slug = $slug;
            $shortlink->link = $request->website;
            $shortlink->shortlink = route('shortlink', $slug);
            $shortlink->save();
            $shop->website = $shortlink->shortlink;
        } else {
            $shop->website = $request->website;
        }
        $shop->save();
        return redirect()->back()->with('success', 'Shop created successfully');
    }
    public function storeProduct(Request $request)
    {
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

    public function editProduct(Request $request)
    {
        $product = Product::where('slug', $request->id)->first();
        return view('user.shop.product.edit')
            ->with('product', $product);
    }

    public function updateProduct(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'original_price' => 'required',
            'sale_price' => 'nullable',
            'description' => 'required',
            'image' => 'nullable',
        ]);

        $product = Product::where('slug', $slug)->first();

        if ($product->shop_id != auth()->user()->shop->id) {
            Session::flash('error', 'You are not authorized to update this product');
            return redirect()->back();
        }

        $product->name = $request->name;
        $product->shop_id = auth()->user()->shop->id;
        $product->original_price = $request->original_price;
        $product->sale_price = $request->sale_price;
        $product->description = $request->description;
        // $product->image = $request->image;
        $product->save();
        Session::flash('success', 'Product updated successfully');
        return redirect()->back();
    }
}
