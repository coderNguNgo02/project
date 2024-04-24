<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductUserController extends Controller
{
    public function index()
    {
        $data = DB::select(
            "SELECT * FROM products"
        );
        return view("customer.product.all_product", [
            "data" => $data,
        ]);
    }

    public function detailAction($id_prd)
    {
        $max_qty = Session::get('qty');

        $prd = DB::select(
            "SELECT * FROM products ORDER BY RAND() LIMIT 4"
        );

        $data = DB::select(
            "SELECT * FROM products WHERE id_prd = $id_prd"
        );

        $size = DB::select(
            "SELECT * FROM products INNER JOIN product_size_detail ON products.id_prd = product_size_detail.id_prd 
            INNER JOIN size_product ON product_size_detail.id_size = size_product.id_size 
            WHERE products.id_prd = $id_prd ORDER BY size_value"
        );

        return view('customer.product.product_detail', [
            'data' => $data,
            'prd' => $prd,
            'size' => $size,
            'max_qty' => $max_qty,
            '$id_prd' => $id_prd,
        ]);
    }
}
