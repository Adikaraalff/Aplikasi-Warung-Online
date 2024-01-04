<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'permission:Kategori-list|Kategori-create|Kategori-edit|Kategori-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:Kategori-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Kategori-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Kategori-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = Kategori::query();

            if ($request->has('sSearch') && $request->input('sSearch')) {
                $search_value = '%' . $request->input('sSearch') . '%';
                $query_data->where(function ($query) use ($search_value) {
                    $query->where('created_by', 'like', $search_value)
                        ->orWhere('keterangan', 'like', $search_value);
                });
            }

            $data = $query_data->orderBy('id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<form action="' . route('kategoris.destroy', $row->id) . '" method="POST">';
                    if (Auth::user()->can('Kategori-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('kategoris.edit', $row->id) . '"><i class="bi bi-pencil"></i>Edit</a>';
                    }
                    if (Auth::user()->can('Kategori-delete')) {
                        $btn .= "<a href=\"#\" onclick=\"deleteConfirm('" . route('kategoris.destroy', $row->id) . "')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                    }
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kategoris.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            // 'keterangan' => 'required',
        ]);

        $input = $request->all();
        Kategori::create($input);

        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $Kategori)
    {
        return view('kategoris.show', compact('Kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $Kategori)
    {
        return view('kategoris.edit', compact('Kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $Kategori)
    {
        $request->validate([
            'nama' => 'required',
            // 'keterangan' => 'required',
        ]);

        $Kategori->update($request->all());
        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $Kategori)
    {
        $Kategori->delete();

        return redirect()->route('kategoris.index')
            ->with('success', 'Kategori deleted successfully');
    }
}
