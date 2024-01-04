<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'permission:Payment-list|Payment-create|Payment-edit|Payment-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:Payment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Payment-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Payment-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query_data = Payment::query();

            if ($request->has('sSearch') && $request->input('sSearch')) {
                $search_value = '%' . $request->input('sSearch') . '%';
                $query_data->where(function ($query) use ($search_value) {
                    $query->where('payment_method', 'like', $search_value)
                        ->orWhere('status', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<form action="' . route('payments.destroy', $row->id) . '" method="POST">';
                    if (Auth::user()->can('Payment-edit')) {
                        $btn .= '<a class="btn btn-primary" href="' . route('payments.edit', $row->id) . '"><i class="bi bi-pencil"></i>Edit</a>';
                    }
                    if (Auth::user()->can('Payment-delete')) {
                        $btn .= "<a href=\"#\" onclick=\"deleteConfirm('" . route('payments.destroy', $row->id) . "')\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i>Delete</a>";
                    }
                    $btn .= '</form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('payments.index');
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_users' => 'required',
            'total' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        Payment::create($input);

        return redirect()->route('payments.index')
            ->with('success', 'Payments created successfully.');
    }

    public function show(Payment $Payment)
    {
        return view('payments.show', compact('Payment'));
    }

    public function edit(Payment $Payment)
    {
        return view('payments.edit', compact('Payment'));
    }

    public function update(Request $request, Payment $Payment)
    {
        $request->validate([
            'id_users' => 'required',
            'total' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $Payment->update($input);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully');
    }

    public function destroy(Payment $Payment)
    {
        $Payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully');
    }
}
