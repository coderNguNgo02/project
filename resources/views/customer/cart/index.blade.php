@extends('layouts.master_user')
@section('cart_customer')
    <style>
        .delete {
            border: 0px;
            background-color: transparent;
        }
    </style>
    <div class="main">
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h1 class="module-title font-alt">Giỏ hàng</h1>
                    </div>
                </div>
                <hr class="divider-w pt-20">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-border checkout-table">
                            <tbody>
                                <tr>
                                    <th class="hidden-xs">Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="hidden-xs">Giá tiền</th>
                                    <th>Kích cỡ</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Xóa</th>
                                </tr>


                                @php
                                    $total_sum = 0;
                                @endphp
                                @foreach ($cartItems as $index => $item)
                                    <tr>
                                        <td class="hidden-xs"><a href="#"><img
                                                    src="/template_admin/assets/img/{{ $item['img_prd'] }}"
                                                    alt="Accessories Pack" /></a></td>
                                        <td>
                                            <h5 class="product-title font-alt">{{ $item['name_prd'] }}</h5>
                                        </td>

                                        <td class=" hidden-xs">
                                            <h5 class="product-title font-alt">@php echo number_format($item['price_prd'])." VND" @endphp</h5>
                                        </td>
                                        <td>
                                            <h5 class="product-title font-alt">{{ $item['size_prd'] }}</h5>
                                        </td>
                                        <td>
                                            <h5 class="product-title font-alt">{{ $item['qty_buy'] }}</h5>
                                        </td>
                                        <td>
                                            <h5 class="product-title font-alt">@php echo number_format($item['price_prd']*$item['qty_buy'])." VND"; @endphp</h5>
                                        </td>
                                        <td class="pr-remove">
                                            <form action="/user/cart/remove/{{ $index }}" method="GET">
                                                @csrf
                                                @method('DELETE')
                                                <button class="delete" type="submit"><i class="fa fa-times"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php
                                        $total_sum += $item['price_prd'] * $item['qty_buy'];
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <h2 style="margin-left: 550px">Tổng Tiền Đơn Hàng : @php echo number_format($total_sum)." VND"; @endphp</h2>
                <hr class="divider-w">
                <h1 style="margin-left: 480px; margin-top: 50px">Xác Nhận Đặt Hàng</h1>
                <form action="{{ route('order_cart') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $total_sum }}" name="total_sum">
                    <input type="hidden" value="{{ date('Y-m-d') }}" name="order_date">
                    <div class="form-group">
                        <label for="inputAddress">Tên Người Nhận</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="Nguyễn Văn A"
                            name="receiver_name" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email"
                            name="receiver_email" required>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword4">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="03456789" name="phone"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                            name="address" required>
                    </div>

                    <button class="btn btn-block btn-round btn-d pull-right" type="submit">Đặt Hàng</button>
                </form>
            </div>
        </section>
        </main>
    @stop
