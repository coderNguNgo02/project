<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data = DB::select(
            "SELECT * FROM categoryhome_product 
            INNER JOIN products ON categoryhome_product.id_prd = products.id_prd
            INNER JOIN categoriehome ON categoryhome_product.category_id = categoriehome.category_id
            ORDER BY categoriehome.category_id,categoryhome_product.id"
        );

        return view('customer.index', [
            'data' => $data,
        ]);
    }
}
