@extends('layouts.master_admin')
@section('index_product')


<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
        <div class="card mb-4">
            <div class="card-header"><span class="small ms-1">Quản lý đơn hàng</span></div>
            <div class="card-body">
                <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên Người Nhận</th>
                                    <th scope="col">Gmail người dùng</th>
                                    <th scope="col">SĐT</th>
                                    <th scope="col">Địa Chỉ</th>
                                    <th scope="col">Tổng Giá</th>
                                    <th scope="col">Ngày Đặt</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $stt = 1;
                                @endphp
                                @foreach ($data as $item)
                                <tr>
                                    <th scope="row">@php echo $stt++; @endphp</th>
                                    <td>{{ $item->receiver_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->receiver_phone }}</td>
                                    <td>{{ $item->receiver_add }}</td>
                                    <td style="color: red">@php echo number_format($item->total_price); @endphp <span style="color: black"> VND</span></td>
                                    <td>{{ $item->order_date}}</td>
                                    <td>
                                        @switch($item->status)
                                        @case(1)
                                        <span class="btn btn-warning" style="pointer-events: none; font-size:12px; height:28px">Chờ xác nhận</span>
                                        @break
                                        @case(2)
                                        <span class="btn btn-primary" style="pointer-events: none; font-size:12px; height:28px">Đã nhận đơn</span>
                                        @break
                                        @case(3)
                                        <span class="btn btn-info" style="pointer-events: none; font-size:12px; height:28px">Đã giao hàng</span>
                                        @break
                                        @case(4)
                                        <span class="btn btn-success" style="pointer-events: none; font-size:12px; height:28px">Đã thanh toán</span>
                                        @break
                                        @case(5)
                                        <span class="btn btn-danger" style="pointer-events: none; font-size:12px; height:28px">Đã hủy đơn</span>
                                        @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a type="button" class="btn btn-success" href="{{ route('orderd_detail_admin',$item->id_order) }}">Chi tiết</a>
                                    <td>
                                        <a href="{{route('show_update_order',$item->id_order)}}" class="btn btn-primary">Cật nhật</a>
                                    </td>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    @endsection