<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = \Illuminate\Foundation\Auth\User::query()->get();
        return view('admin.account.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.account.create');
    }

    public function store(Request $request)
    {
        DB::insert(
            "INSERT INTO users (name,email,password,level)
                    VALUES(?,?,?,?) ",
            [
                $request->ip_name,
                $request->ip_email,
                Hash::make($request->ip_pass),
                $request->ip_level,
            ]
        );
        return redirect()
            ->to(route('account_admin'));
    }

    public function edit($id)
    {
        $data = DB::select('SELECT * FROM users WHERE id_user = ' . $id . '');
        return view('admin.account.edit', [
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::update(
            "UPDATE users SET 
            name = ?, email = ?, password = ?, level = ? WHERE id_user = ?", [
                $request->ip_name,
                $request->ip_email,
                Hash::make($request->ip_pass),
                $request->ip_level,
                $id,
            ]);
        return redirect() 
        -> to(route('account_admin'));
    }

    public function destroy($id){
        DB::delete(
            "DELETE FROM users WHERE id_user = ?", [
            $id,
        ]);
        return redirect() 
        -> to(route('account_admin'));
    }
}
