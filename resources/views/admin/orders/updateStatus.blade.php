@extends('layouts.master_admin')
@section('edit_order')
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1004">
                            <div class="card-body">
                                <h1>Sửa thông tin đơn hàng</h1>
                                <br>
                                @foreach ($data as $item)
                                <form action="{{route('update_order',$item->id_order)}}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tên người
                                            đặt</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Họ và tên" name="ip_receiver_name" value="{{$item->receiver_name}}">
                                        <br>
                                        <label for="exampleFormControlInput2" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="name@example.com" name="ip_receiver_email" value="{{$item->receiver_email}}">
                                        <br>
                                        <label for="exampleFormControlInput3" class="form-label">Địa chỉ</label>
                                        <input type="" class="form-control" id="exampleFormControlInput3" placeholder="Tối thiếu 6 ký tự" name="ip_receiver_add" value="{{$item->receiver_add}}">
                                        <br>
                                        <label for="exampleFormControlInput4" class="form-label">Số điện
                                            thoại</label>
                                        <input type="" class="form-control" id="exampleFormControlInput3" placeholder="Tối thiếu 6 ký tự" name="ip_receiver_phone" value="{{$item->receiver_phone}}">
                                        <br>
                                        <label for="exampleFormControlInput4" class="form-label">Trạng thái</label>
                                        <br>
                                        <select name="ip_status" id="">
                                            <option value="1">Chờ xác nhận</option>
                                            <option value="2">Đã nhận đơn</option>
                                            <option value="3">Đã giao hàng</option>
                                            <option value="4">Đã thanh toán</option>
                                            <option value="5">Đã hủy đơn</option>
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
@endsection