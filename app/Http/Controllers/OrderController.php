<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('pages.orders.index', [
            'title' => 'History Pesanan',
        ]);
    }

    public function newOrder(Request $request)
    {
        return view('pages.orders.new-order', [
            'title' => 'Pesanan Baru',
        ]);
    }
}
