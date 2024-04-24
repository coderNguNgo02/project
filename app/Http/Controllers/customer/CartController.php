<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Session::get('cartItems', []);
        return view("customer.cart.index", compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $id_prd = $request->ip_id_prd;
        $name_prd = $request->ip_name_prd;
        $price_prd = $request->ip_price_prd;
        $img_prd = $request->ip_name_img;
        $size_prd = $request->ip_size_prd;
        $qty_buy = $request->ip_buy_qty;
        $max_qty = $request->ip_max_qty;
        $cartItems = Session::get('cartItems', []);
        $existingCartItemKey = null;

        foreach ($cartItems as $key => $cartItem) {
            if ($cartItem['id_prd'] == $id_prd && $cartItem['size_prd'] == $size_prd) {
                $existingCartItemKey = $key;
                break;
            }
        }

        if ($existingCartItemKey !== null) {
            $cartItems[$existingCartItemKey]['qty_buy'] += $qty_buy;
            if (intval($cartItems[$existingCartItemKey]['qty_buy']) > intval($max_qty)) {
                $cartItems[$existingCartItemKey]['qty_buy'] = $max_qty;
            }
        } else {
            $cartItems[] = [
                'id_prd' => $id_prd,
                'size_prd' => $size_prd,
                'qty_buy' => $qty_buy,
                'name_prd' => $name_prd,
                'price_prd' => $price_prd,
                'img_prd' => $img_prd,
            ];
        }
        Session::put('cartItems', $cartItems);
        return redirect('/user/cart')->with('success', 'Đã thêm vào giỏ hàng');
    }
    public function removeFromCart($index)
    {
        $cartItems = Session::get('cartItems', []);

        // Xóa giày khỏi giỏ hàng dựa trên index
        if (isset($cartItems[$index])) {
            unset($cartItems[$index]);
        }

        // Cập nhật lại thông tin giỏ hàng trong session
        Session::put('cartItems', $cartItems);

        return redirect('/user/cart')->with('success', 'Đã xóa khỏi giỏ hàng');
    }

    public function order(Request $request)
    {
        if (Session::has('cartItems')) {
            $id_user = Auth::id();
            $total_Sum = $request->total_sum;
            $orderDate =  $request->order_date;
            $receiverName = $request->receiver_name;
            $receiverEmail = $request->receiver_email;
            $phone = $request->phone;
            $address = $request->address;
            $order_id = DB::table('orders')->insertGetId([
                'id_user' => $id_user,
                'total_price' => $total_Sum,
                'order_date' => $orderDate,
                'receiver_name' => $receiverName,
                'receiver_email' => $receiverEmail,
                'receiver_phone' => $phone,
                'receiver_add' => $address,
                'status' => 1,
            ]);
            $cartItems = Session::get('cartItems', []);

            foreach ($cartItems as $item) {
                $id_prd = $item['id_prd'];
                $size_prd = $item['size_prd'];
                $qty_buy = $item['qty_buy'];
                $price_prd = $item['price_prd'];
                DB::table('order_detail')->insert([
                    'price' => $price_prd,
                    'id_prd' => $id_prd,
                    'id_order' => $order_id,
                    'id_size' => $size_prd,
                    'qty' => $qty_buy
                ]);
            }



            Session::forget('cartItems');
        }


        return redirect('/user/index');
    }

    public function getHistory()
    {
        $order = DB::select("SELECT * FROM orders");
        return view('customer.history.history', [
            'order' => $order,
        ]);
    }

    public function destroyOrder($id)
    {
        DB::update('UPDATE orders SET status = ? WHERE id_order = ?', [
            5,
            $id,
        ]);

        return redirect()->route('history_page');
    }

    public function getDetailOrder($id)
    {
        $data = DB::select(
            "SELECT * FROM order_detail
        INNER JOIN products ON order_detail.id_prd = products.id_prd
        INNER JOIN size_product ON size_product.id_size = order_detail.id_size
        WHERE order_detail.id_order = '$id'"
        );
        return view('customer.history.orderDetail', [
            'data' => $data,
        ]);
    }
}
