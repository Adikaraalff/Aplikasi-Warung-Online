<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'permission:Cart-list|Cart-create|Cart-edit|Cart-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:Cart-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Cart-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Cart-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Cart::with(['user', 'product']);

            if ($request->has('sSearch') && $request->input('sSearch')) {
                $searchValue = '%' . $request->input('sSearch') . '%';
                $query->where(function ($query) use ($searchValue) {
                    $query->where('created_by', 'like', $searchValue)
                        ->orWhere('keterangan', 'like', $searchValue);
                });
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<form action="' . route('carts.destroy', $row->id) . '" method="POST">';
                    if (Auth::user()->can('Cart-delete')) {
                        $btn .= "<a href=\"#\" onclick=\"deleteConfirm('" . route('carts.destroy', $row->id) . "')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                    }
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.carts.index');
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('carts.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        Cart::create($request->all());

        return redirect()->route('carts.index')->with('success', 'Cart created successfully.');
    }

    public function show(Cart $cart)
    {
        return view('carts.show', compact('cart'));
    }

    public function edit(Cart $cart)
    {
        return view('carts.edit', compact('cart'));
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate($this->getValidationRules());

        $cart->update($request->all());
        return redirect()->route('carts.index')->with('success', 'Cart updated successfully');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Item removed from cart successfully');
    }

    public function addToCart(Request $request)
    {
        $request->validate($this->getValidationRules());

        $cartData = [
            'id_users' => $request->input('id_users'),
            'id_products' => $request->input('id_products'),
            'amount' => $request->input('amount'),
        ];

        $existingCart = Cart::where('id_users', $cartData['id_users'])
            ->where('id_products', $cartData['id_products'])
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'amount' => $existingCart->amount + $cartData['amount'],
            ]);
        } else {
            Cart::create($cartData);
        }

        $cartCount = Cart::where('id_users', $cartData['id_users'])->count();

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    public function showCart()
    {
        $carts = Cart::with('product')->where('id_users', Auth::id())->get();

        return view('pages.carts.index', compact('carts'));
    }

    // Validation rules for storing and updating carts
    private function getValidationRules()
    {
        return [
            'id_users' => 'required',
            'id_products' => 'required',
            'amount' => 'required|integer|min:1',
        ];
    }
}
