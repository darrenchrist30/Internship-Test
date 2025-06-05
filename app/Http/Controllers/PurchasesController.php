<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{

    public function create()
    {
        $customers = Customer::orderBy('customer_name')->get(['customer_id', 'customer_name']);
        return view('purchases.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'customer_id' => 'required|exists:customers,customer_id',
        'purchase_date' => 'required|date',
        'total_price' => 'required|numeric|min:0',
    ]);

        Purchase::create($validatedData);

        return redirect()->route('purchases.create')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function showCustomerReportPage()
    {
        return view('customers.report');
    }

    public function getCustomerReportData(Request $request)
    {
        $query = Customer::select(
            'customers.customer_id',
            'customers.customer_name',
            DB::raw('COALESCE(SUM(purchases.total_price),0) as total_purchases')
        )
        ->leftJoin('purchases', 'customers.customer_id', '=', 'purchases.customer_id')
        ->groupBy('customers.customer_id', 'customers.customer_name');

        $recordsTotal = Customer::count();

        if ($request->has('search') && $request->input('search.value') != '') {
            $searchValue = $request->input('search.value');
            $query->where(function($q) use ($searchValue) {
                $q->where('customers.customer_name', 'like', "%{$searchValue}%")
                  ->orWhere('customers.customer_id', 'like', "%{$searchValue}%");
            });
        }

        $queryCloneForFilteredCount = clone $query;
        $recordsFiltered = $queryCloneForFilteredCount->get()->count();

        if ($request->has('order')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDir = $request->input('order.0.dir');
            $columns = $request->input('columns');

            $columnName = $columns[$orderColumnIndex]['name'];

            if ($columnName == 'total_purchases') {
                $query->orderByRaw('COALESCE(SUM(purchases.total_price),0) ' . $orderDir);
            } elseif (in_array($columnName, ['customers.customer_id', 'customers.customer_name'])) {
                $query->orderBy($columnName, $orderDir);
            } else {
                $query->orderBy('customers.customer_name', 'asc');
            }
        } else {
            $query->orderBy('customers.customer_name', 'asc');
        }

        if ($request->has('start') && $request->input('length') != -1) {
            $query->skip($request->input('start'))->take($request->input('length'));
        }

        $data = $query->get();

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data"            => $data,
        ]);
    }
}
