<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //trả về view index prd
    public function index()
    {
        $data = DB::select('SELECT * FROM products INNER JOIN categories ON products.id_cate = categories.id_cate');
        $giay = DB::select("
SELECT products.*, product_sizes.*, sizes.*
    FROM products
    JOIN product_sizes ON products.id = product_sizes.product_id
    JOIN sizes ON product_sizes.size_id = sizes.id
");
        return view('admin.product.index', ['giay' => $giay]);
    }

    //đổ dữ liệu ra view thêm
    public function create()
    {
        $cate = DB::select('SELECT * FROM  categories');
        $size = DB::select('SELECT * FROM  size_product');
        return view('admin.product.create', [
            'cate' => $cate,
            'size' => $size,
        ]);
    }

    //hàm nhận thông tin từ form thêm
    public function store(Request $request)
    {
        $id_danhmuc = $request->ip_prd_cate;
        $ten = $request->ip_prd_name;
        $hang = $request->ip_prd_brand;
        $id_size = $request->ip_prd_size;
        $giay = DB::select(
            'SELECT * FROM product_size_detail 
        INNER JOIN size_product ON product_size_detail.id_size = size_product.id_size
        INNER JOIN products ON product_size_detail.id_prd = products.id_prd 
        INNER JOIN categories ON products.id_cate =categories.id_cate
        WHERE products.name_prd = ? AND size_product.id_size = ? AND categories.id_cate = ? AND products.brand_prd = ?',
            [$ten, $id_size, $id_danhmuc, $hang]
        );
        if ($giay) {
            $tong = intval($giay[0]->qty) + intval($request->ip_prd_qty);
            DB::update(
                "UPDATE product_size_detail SET  qty = ? WHERE prd_size_detail = ?",
                [
                    $tong,
                    $giay[0]->prd_size_detail
                ]
            );
            return redirect()
                ->to(route('product_admin'));
        }


        $giay2 = DB::select(
            'SELECT * FROM product_size_detail 
        INNER JOIN size_product ON product_size_detail.id_size = size_product.id_size
        INNER JOIN products ON product_size_detail.id_prd = products.id_prd 
        INNER JOIN categories ON products.id_cate =categories.id_cate
        WHERE products.name_prd = ? AND categories.id_cate = ? AND products.brand_prd = ?',
            [$ten, $id_danhmuc, $hang]
        );

        if ($giay2) {
            $id_prd = $giay2[0]->id_prd;
            DB::insert(
                "INSERT INTO product_size_detail (id_prd,id_size,qty)
                        VALUES(?,?,?) ",
                [
                    $id_prd,
                    $request->ip_prd_size,
                    $request->ip_prd_qty,
                ]
            );
            return redirect()
                ->to(route('product_admin'));
        }




        DB::insert(
            "INSERT INTO products (id_cate,name_prd,brand_prd,price_prd,desc_prd,img_prd)
                    VALUES(?,?,?,?,?,?) ",
            [
                $request->ip_prd_cate,
                $request->ip_prd_name,
                $request->ip_prd_brand,
                $request->ip_prd_price,
                $request->ip_prd_desc,
                $request->ip_prd_img->getClientOriginalName(),
            ]
        );

        $maxID = DB::select('SELECT MAX(id_prd) FROM products');
        $id_prd = json_encode($maxID);

        DB::insert(
            "INSERT INTO product_size_detail (id_prd,id_size,qty)
                    VALUES(?,?,?) ",
            [
                rtrim(substr($id_prd, 16, 17), "}]"),
                $request->ip_prd_size,
                $request->ip_prd_qty,
            ]
        );

        if (!empty($_FILES['ip_prd_img']['name'])) {
            $data['img_prd'] = $_FILES['ip_prd_img']['name'];
            $tmp_name = $_FILES['ip_prd_img']['tmp_name'];
            move_uploaded_file($tmp_name, 'template_admin/assets/img/' . $data['img_prd']);
        }

        return redirect()
            ->to(route('product_admin'));
    }

    public function edit($id_prd)
    {
        $cate = DB::select('SELECT * FROM  categories');
        $data = DB::select('SELECT * FROM products INNER JOIN product_size_detail ON products.id_prd = product_size_detail.id_prd WHERE products.id_prd =' . $id_prd . ' LIMIT 1');
        $size = DB::select('SELECT * FROM  size_product');

        return view('admin.product.edit', [
            'data' => $data,
            'cate' => $cate,
            'size' => $size,
        ]);
    }

    public function update(Request $request, $id_prd)
    {
        if (!empty($_FILES['ip_prd_img']['name'])) {
            DB::update(
                "UPDATE products 
                    SET id_cate = ?, name_prd = ?, brand_prd = ?, price_prd = ?, desc_prd = ?, img_prd = ?
                    WHERE id_prd = ?",
                [
                    $request->ip_prd_cate,
                    $request->ip_prd_name,
                    $request->ip_prd_brand,
                    $request->ip_prd_price,
                    $request->ip_prd_desc,
                    $request->ip_prd_img->getClientOriginalName(),
                    $id_prd,
                ]
            );
        } else if (empty($_FILES['ip_prd_img']['name'])) {
            DB::update(
                "UPDATE products 
                        SET id_cate = ?, name_prd = ?, brand_prd = ?, price_prd = ?, desc_prd = ?
                        WHERE id_prd = ?",
                [
                    $request->ip_prd_cate,
                    $request->ip_prd_name,
                    $request->ip_prd_brand,
                    $request->ip_prd_price,
                    $request->ip_prd_desc,
                    $id_prd,
                ]
            );
        }

        DB::update(
            "UPDATE product_size_detail 
             SET  qty = ?",
            [
                $request->ip_prd_qty,
            ]
        );


        return redirect()
            ->to(route('product_admin'));
    }

    public function destroy($id_prd)
    {
        DB::delete(
            "DELETE FROM products WHERE id_prd = ?",
            [
                $id_prd,
            ]
        );

        DB::delete(
            "DELETE FROM product_size_detail WHERE id_prd = ?",
            [
                $id_prd,
            ]
        );

        return redirect()
            ->to(route('product_admin'));
    }

    public function kiemTraTrung(Request $request)
    {
        $ten = $request->input('ten');
        $hang = $request->input('hang');
        $size = $request->input('size');
        $danhmuc = $request->input('danhmuc');
        $giay = DB::select(
            'SELECT * FROM product_size_detail 
        INNER JOIN size_product ON product_size_detail.id_size = size_product.id_size
        INNER JOIN products ON product_size_detail.id_prd = products.id_prd 
        INNER JOIN categories ON products.id_cate =categories.id_cate
        WHERE products.name_prd = ? AND size_product.size_value = ? AND categories.name_cate = ? AND products.brand_prd = ?',
            [$ten, $size, $danhmuc, $hang]
        );

        if ($giay) {
            return response()->json(['trung' => true]);
        }

        return response()->json(['trung' => false]);
    }

    public function getDetailProduct($id)
    {
        $prd_detail = DB::select('SELECT * FROM products INNER JOIN product_size_detail 
        ON products.id_prd = product_size_detail.id_prd INNER JOIN size_product 
        ON product_size_detail.id_size = size_product.id_size 
        WHERE products.id_prd = ' . $id);

        return view('admin.product.detail_prd', [
            'prd' => $prd_detail,
        ]);
    }

    public function editProductDetail($id_prd, $id_size)
    {
        $prd = DB::select(
            'SELECT * FROM product_size_detail WHERE product_size_detail.id_prd = ? AND product_size_detail.id_size = ?',
            [$id_prd, $id_size]
        );
        return view(
            'admin.product.editdetail',
            ['prd' => $prd]
        );
    }
    public function updateProductDetail(Request $request, $id_prd, $id_size)
    {
        DB::update(
            'UPDATE product_size_detail SET product_size_detail.qty = ?
        WHERE product_size_detail.id_prd = ? AND product_size_detail.id_size = ?',
            [
                $request->ip_prd_qty,
                $id_prd,
                $id_size
            ]
        );
        return redirect("/admin/product/detail/{$id_prd}");
    }
    public function destroyDetail($id_prd, $id_size)
    {
        DB::delete(
            'DELETE FROM product_size_detail 
        WHERE product_size_detail.id_prd = ? AND product_size_detail.id_size = ?',
            [
                $id_prd,
                $id_size
            ]
        );
        return redirect("/admin/product/detail/{$id_prd}");
    }
};
