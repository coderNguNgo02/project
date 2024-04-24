<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data = DB::select(
            "SELECT * FROM orders INNER JOIN users ON orders.id_user = users.id_user;"
        );
        return view('admin.orders.orders', [
            "data" => $data,
        ]);
    }
}
