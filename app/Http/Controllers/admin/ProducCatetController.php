<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProducCatetController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();;
        return response()->json($products);
    }
}
