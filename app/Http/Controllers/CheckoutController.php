<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Cart; // Make sure to import the Cart model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        // Tampilkan formulir checkout atau informasi checkout
        $userId = Auth::user()->id;

        // Assuming 'Product' is the related model and 'price' is a column in the 'Product' table
        $data = Cart::where('id_users', $userId)->with('Product')->get();

        $totalAmount = 0;

        foreach ($data as $cartItem) {
            // Assuming each cart item has a 'quantity' column indicating the quantity of the product in the cart
            $totalAmount += $cartItem->Product->price * $cartItem->amount;
        }
        $dataCart = Cart::where('id_users','=',Auth::user()->id)->sum('amount');

        return view('pages.checkout.index', compact('totalAmount'));
    }

    public function process(Request $request)
    {
        try {
            // Assuming you have a Cart model and 'cart_items' is an array of cart item IDs
            $cartItems = Cart::where('id_users','=',Auth::user()->id)->sum('amount');
            $carts = Cart::where('id_users','=',Auth::user()->id)->get();
            // $totalAmount = $this->calculateTotalAmount($cartItems);

            // Other checkout data...
            $checkoutData = [
                'user_id' => auth()->id(),
                'shipping_address' => $request->input('shipping_address'),
                // tambahkan data lain sesuai kebutuhan
                'total_amount' => $cartItems,
            ];



            // Create a checkout record
            $check = Checkout::create($checkoutData);
            $uuid = Str::uuid()->toString();


            // Redirect to the success page with totalAmount
            return view('pages.checkout.succes',compact('cartItems','uuid','carts'));

        } catch (\Exception $e) {
            // Handle any exception that might occur
            return back()->withError('Error processing checkout: ' . $e->getMessage())->withInput();
        }
    }

    private function calculateTotalAmount($cartItems)
    {
        // Assuming you have a Cart model with a 'product' relationship
        $cart = Cart::whereIn('id', $cartItems)->with('product')->get();

        // Check if $cart is null or empty, and return 0 if it is
        if ($cart === null || $cart->isEmpty()) {
            return 0;
        }

        // Filter out items with missing or invalid properties
        $validItems = $cart->filter(function ($cartItem) {
            return isset($cartItem->product->price, $cartItem->amount);
        });

        // Check if there are valid items before using sum
        if ($validItems->isEmpty()) {
            return 0;
        }

        $totalAmount = $validItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->amount;
        });

        return $totalAmount;
    }
}
