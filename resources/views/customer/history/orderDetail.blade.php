@extends('layouts.master_user')
@section('order_detail_customer')
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
                                <th>Tên giày</th>
                                <th>Hãng</th>
                                <th>Size</th>
                                <th>Giá/đôi</th>
                                <th>Số lượng mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $stt = 1;
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>@php echo $stt++; @endphp</td>
                                <td>{{ $item->name_prd }}</td>
                                <td>{{ $item->brand_prd }}</td>
                                <td>{{ $item->size_value }}</td>
                                <td>@php echo number_format($item->price_prd)." VND"; @endphp</td>
                                <td>{{ $item->qty }}</td>

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