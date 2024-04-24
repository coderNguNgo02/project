<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CateController extends Controller
{
    public function index(){
        $data = Category::query()->get();
        return view('admin.category.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        DB::insert(
            "INSERT INTO categories (name_cate)
                    VALUES(?) ",[
                $request->ip_cate,
            ]
        );
        return redirect()
        -> to( route('category_admin'));
    }

    public function edit($id)
    {
        $data = DB::select('SELECT * FROM categories WHERE id_cate = ' . $id . '');
        return view('admin.category.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::update(
            "UPDATE categories SET 
            name_cate = ? WHERE id_cate = ?", [
                $request->ip_cate_name,
                $id,
            ]);
        return redirect() 
        -> to(route('category_admin'));
    }

    public function destroy($id){
        DB::delete(
            "DELETE FROM categories WHERE id_cate = ?", [
            $id,
        ]);
        return redirect() 
        -> to(route('category_admin'));
    }
}
