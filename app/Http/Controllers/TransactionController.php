<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index', [
            'title' => 'Trasaksi',
            'transactions' => Transaction::all()
        ]);
    }

    public function detail($id)
    {
        return view('transaction.detail', [
            'title' => 'Detail Transaksi',
            'transaction' => Transaction::findOrFail($id),
            'details' => TransactionDetail::where('transaction_id', $id)->get()
        ]);
    }
}
