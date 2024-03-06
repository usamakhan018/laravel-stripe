<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('create');
        } elseif( $request->method() == 'POST') {

            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'image' => 'required',
                'price' => 'required',
            ]);

            $image_name = now()->timestamp."_".$request->image->getClientOriginalName();
            $request->image->move(public_path('products'), $image_name);

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_name,
                'price' => $request->price,
            ]);

            return back()->with('success', 'product has been created');

        } else {
            return response('bad things are going on.');
        }
    }

    public function add_to_cart($id) {
        $product = Product::find($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'product has been added to the cart');
    }

    public function remove_product(Request $request) {
        $id = $request->id;
        $cart = session()->get('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'product removed successfully');
    }

    public function update_cart(Request $request) {
        $cart = session()->get('cart');

        $cart[$request->id]['quantity'] = $request->quantity;

        session()->put('cart', $cart);
        return back()->with('success', 'Product quantity has been updated');
    }

    public function cart() {
        return view('cart');
    }

    public function checkout() {

\Stripe\Stripe::setApiKey(env('STRIPE_API_SECRET'));

        \Stripe\Stripe::setApiKey(env('STRIPE_API_SECRET'));
        foreach (session('cart') as $product) {         
            $name = $product['name'];
            $quantity = $product['quantity'];
            $unit_amount = $product['price']."00";

            $product_data[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $name,
                    ],
                    'currency' => 'USD',
                    'unit_amount' => $unit_amount,
                ],
                'quantity' => $quantity,
            ];

            $checkoutSession = \Stripe\Checkout\Session::create([
                'line_items' => [$product_data],
                'mode' => 'payment',
                'metadata' => [
                    'user_id' => 1
                ],
                'customer_email' => 'ukpreshan@gmail.com',
                'success_url' => route('success'),
                'cancel_url' => route('cancel'),

            ]);



        }
        return redirect()->away($checkoutSession->url);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
