<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categoriehome')->get();
        return response()->json($categories);
    }
    public function addProducts(Request $request, $id)
    {
        $selectedProducts = $request->input('selected_products');
        DB::table('categoryhome_product')
            ->where('category_id', $id)
            ->whereNotIn('id_prd', $selectedProducts)
            ->delete();
        foreach ($selectedProducts as $productId) {
            $existingRecord = DB::table('categoryhome_product')
                ->where('category_id', $id)
                ->where('id_prd', $productId)
                ->first();

            if (!$existingRecord) {
                DB::table('categoryhome_product')->insert([
                    'category_id' => $id,
                    'id_prd' => $productId,
                ]);
            }
        }
        return response()->json(['message' => 'Products added successfully']);
    }

    public function checkBox(Request $request)
    {
        $categoryId = $request->input('category');
        $productIds = DB::table('categoryhome_product')
            ->where('category_id', $categoryId)
            ->pluck('id_prd');
        return response()->json(['product_ids' => $productIds]);;
    }
    public function insert(Request $request)
    {
        $categoryName = $request->input('categoryName');
        DB::table('categoriehome')->insert([
            'name' => $categoryName,
        ]);
        return response()->json(['message' => 'Category added successfully']);
    }
    public function delete(Request $request)
    {
        $categoryId = $request->input('category');
        DB::table('categoriehome')->where('category_id', $categoryId)->delete();
        DB::table('categoryhome_product')->where('category_id', $categoryId)->delete();
        return response()->json(['message' => 'Category delete successfully']);
    }
}
