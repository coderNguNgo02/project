<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class OrderDetailController extends Controller
{
    public function index($id)
    {
        $data = DB::select(
            "SELECT * FROM order_detail
        INNER JOIN products ON order_detail.id_prd = products.id_prd
        INNER JOIN size_product ON size_product.id_size = order_detail.id_size
        WHERE order_detail.id_order = '$id'"
        );
        return view('admin.oderdetail.oderdetail', [
            "data" => $data,
        ]);
    }
    public function delete($id)
    {
        DB::delete(
            "DELETE FROM orders WHERE id_order = ?",
            [
                $id,
            ]
        );

        DB::delete(
            "DELETE FROM order_detail WHERE id_order = ?",
            [
                $id,
            ]
        );
        return redirect('/admin/order');
    }
    public function showUpdateFormOrder($id)
    {
        $data = DB::select('SELECT * FROM orders WHERE id_order = ' . $id);
        return view('admin.orders.updateStatus', [
            'data' => $data,
        ]);
    }

    public function updateOrder(Request $request, $id)
    {
        DB::update('UPDATE orders SET receiver_name = ?, receiver_email = ? ,receiver_add = ?, receiver_phone = ?, status = ? WHERE id_order = ?', [
            $request->ip_receiver_name,
            $request->ip_receiver_email,
            $request->ip_receiver_add,
            $request->ip_receiver_phone,
            $request->ip_status,
            $id,
        ]);
        $danhsach = DB::select('SELECT * FROM order_detail WHERE id_order = ' . $id);

        if ($request->ip_status == 4) {
            foreach ($danhsach as $item) {

                $data = DB::select(
                    "SELECT * FROM product_size_detail WHERE
                     product_size_detail.id_prd = '$item->id_prd'
                      AND product_size_detail.id_size = '$item->id_size'"
                );
                $qtyConLai = intval($data[0]->qty) - intval($item->qty);

                DB::update(
                    "UPDATE product_size_detail SET 
                    qty = ? WHERE id_prd = ? AND id_size= ?",
                    [
                        $qtyConLai,
                        $item->id_prd,
                        $item->id_size
                    ]
                );
            }
        }
        return redirect()->route('order_admin');
    }
}
