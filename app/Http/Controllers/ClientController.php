<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'permission:Client-list|Client-create|Client-edit|Client-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:Client-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Client-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Client-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Client::query();

            if ($request->has('sSearch') && $request->input('sSearch')) {
                $searchValue = '%' . $request->input('sSearch') . '%';
                $query->where(function ($query) use ($searchValue) {
                    $query->where('created_by', 'like', $searchValue)
                        ->orWhere('keterangan', 'like', $searchValue);
                });
            }

            $data = $query->orderBy('id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<form action="' . route('clients.destroy', $row->id) . '" method="POST">';
                    if (Auth::user()->can('Client-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('clients.edit', $row->id) . '"><i class="bi bi-pencil"></i>Edit</a>';
                    }
                    if (Auth::user()->can('Client-delete')) {
                        $btn .= "<a href=\"#\" onclick=\"deleteConfirm('" . route('clients.destroy', $row->id) . "')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                    }
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('clients.index');
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:clients',
            'password' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $input = $request->all();
        Client::create($input);

        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('profile.client.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'password' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $client->update($request->all());
        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully');
    }

    public function clientDashboard()
    {
        return view('pages.auth.client-dashboard');
    }

    public function clientProfile()
    {
        $client = Auth::user();
        return view('profile.client.profile', compact('client'));
    }
}
