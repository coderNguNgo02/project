@extends('layouts.master_user')
@section('history_customer')
    <div class="main">
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h1 class="module-title font-alt">Lịch sử giỏ hàng</h1>
                    </div>
                </div>
                <hr class="divider-w pt-20">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-border checkout-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên người đặt</th>
                                    <th>Ngày đặt</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $stt = 1;
                                @endphp
                                @foreach ($order as $item)
                                    <tr>
                                        <td>@php echo $stt++; @endphp</td>
                                        <td>{{ $item->receiver_name }}</td>
                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->receiver_add }}</td>
                                        <td>
                                            @switch($item->status)
                                                @case(1)
                                                <span class="btn btn-warning" style="pointer-events: none; font-size:10px; height:28px; border-radius:10px">Chờ xác nhận</span>
                                                @break

                                                @case(2)
                                                <span class="btn btn-primary" style="pointer-events: none; font-size:10px; height:28px; border-radius:10px" >Đã nhận đơn</span>
                                                @break

                                                @case(3)
                                                <span class="btn btn-info" style="pointer-events: none; font-size:10px; height:28px; border-radius:10px">Đang giao hàng</span>
                                                @break

                                                @case(4)
                                                <span class="btn btn-success" style="pointer-events: none; font-size:10px; height:28px; border-radius:10px">Đã thanh toán</span>
                                                @break

                                                @case(5)
                                                <span class="btn btn-danger" style="pointer-events: none; font-size:10px; height:28px; border-radius:10px">Đã hủy</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>@php echo number_format($item->total_price)." VND"; @endphp</td>
                                        <td>
                                            @if ($item->status == 1 || $item->status == 2 )
                                                <a href="{{route('destroy_order',$item->id_order)}}" style="font-size:10px" class="btn btn-danger">Hủy</a>
                                            @endif
                                            
                                            <a href="{{route('detail_order',$item->id_order)}}" style="font-size:10px" class="btn btn-primary">Chi tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        </main>
    @stop
