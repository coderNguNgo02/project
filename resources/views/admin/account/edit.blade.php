@extends('layouts.master_admin')
@section('edit_account')
    <form action="" method="POST">
        @csrf
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1004">
                                    <div class="card-body">
                                        <h1>Sửa thông tin tài khoản</h1>
                                        <br>
                                        @foreach ($data as $item)
                                            <form action="{{ route('update_account', $item->id_user) }}" method="POST">

                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Họ và
                                                        tên</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                                        placeholder="Họ và tên" name="ip_name" value="{{ $item->name }}">
                                                    <br>
                                                    <label for="exampleFormControlInput2" class="form-label">Địa chỉ
                                                        email</label>
                                                    <input type="email" class="form-control" id="exampleFormControlInput2"
                                                        placeholder="name@example.com" name="ip_email"
                                                        value="{{ $item->email }}">
                                                    <br>
                                                    <label for="exampleFormControlInput3" class="form-label">Mật
                                                        khẩu</label>
                                                    <input type="password" class="form-control"
                                                        id="exampleFormControlInput3" placeholder="Tối thiếu 6 ký tự"
                                                        name="ip_pass" value="{{ $item->password }}">
                                                    <br>
                                                    <label for="exampleFormControlInput4" class="form-label">Quyền</label>
                                                    <br>
                                                    <select name="ip_level" id="exampleFormControlInput4"
                                                        value="{{ $item->level }}">
                                                        <option value="1">Admin</option>
                                                        <option value="2">Member</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                    <button class="btn btn-success" type="submit">Sửa tài khoản</button>
                                                </div>

                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
