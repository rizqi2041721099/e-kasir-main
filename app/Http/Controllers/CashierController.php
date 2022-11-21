<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.index', [
            'title' => 'Kasir',
            'products' => Product::all(),
            'categories' => ProductCategory::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quantity.*' => ['required'],
            'product_id.*' => ['required']
        ], [
            'quantity.*.required' => 'Jumlah produk tidak boleh kosong.',
            'product_id.*.required' => 'Produk tidak boleh kosong.'
        ]);

        $transaction_id = Transaction::create([
            'user_id' => Auth::user()->id,
            'number' => 'INV-' . time(),
            'time' => now()
        ])->id;
        foreach ($request->product_id as $key => $value) {
            TransactionDetail::create([
                'transaction_id' => $transaction_id,
                'product_id' => $value,
                'quantity' => $request->input('quantity')[$key]
            ]);
        }
        $totalPrice = 0;
        $transactionDetails = TransactionDetail::where('transaction_id', $transaction_id)->get();
        foreach ($transactionDetails as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }
        Transaction::find($transaction_id)->update([
            'total' => $totalPrice
        ]);
        return response()->json(['total' => $totalPrice, 'totalFormat' => number_format($totalPrice), 'id' => $transaction_id], 200);
    }

    public function pay($id, Request $request)
    {
        Transaction::find($id)->update([
            'pay' => $request->pay
        ]);
        return response()->json([], 200);
    }
}
