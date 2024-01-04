<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'permission:Product-list|Product-create|Product-edit|Product-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:Product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Product-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::with('kategori');

            if ($request->has('sSearch') && $request->input('sSearch')) {
                $searchValue = '%' . $request->input('sSearch') . '%';
                $query->where(function ($query) use ($searchValue) {
                    $query->where('nama_products', 'like', $searchValue)
                        ->orWhereHas('kategori', function ($query) use ($searchValue) {
                            $query->where('nama', 'like', $searchValue);
                        });
                });
            }

            $data = $query->orderBy('id', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_kategoris', function (Product $product) {
                    return $product->kategori->nama;
                })
                ->addColumn('price_formatted', function (Product $product) {
                    return 'Rp' . number_format($product->price, 0, ',', '.');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<form action="' . route('products.destroy', $row->id) . '" method="POST">';
                    if (Auth::user()->can('Product-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('products.edit', $row->id) . '"><i class="bi bi-pencil"></i>Edit</a>';
                    }
                    if (Auth::user()->can('Product-delete')) {
                        $btn .= "<a href=\"#\" onclick=\"deleteConfirm('" . route('products.destroy', $row->id) . "')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                    }
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.index');
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('products.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_products' => 'required',
            'price' => 'required',
            'keterangan' => 'required',
            'id_kategoris' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('file')) {
            $destinationPath = 'image/';
            $namaBaru = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $namaBaru);
            $input['file'] = $namaBaru;
        }

        Product::create($input);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $kategori = Kategori::all();
        return view('products.edit', compact('product', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_products' => 'required',
            'price' => 'required',
            'keterangan' => 'required',
            'id_kategoris' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'nama_products' => $request->input('nama_products'),
            'price' => $request->input('price'),
            'keterangan' => $request->input('keterangan'),
            'id_kategoris' => $request->input('id_kategoris'),
        ]);

        if ($request->hasFile('file')) {
            $destinationPath = 'image/';
            $namaBaru = date('YmdHis') . "." . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move($destinationPath, $namaBaru);
            $product->update(['file' => $namaBaru]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
