<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'users' => User::all(),
            'categories' => ProductCategory::all(),
            'products' => Product::all(),
            'transactions' => Transaction::all()
        ]);
    }
}
