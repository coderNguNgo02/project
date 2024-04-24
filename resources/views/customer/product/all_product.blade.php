@extends('layouts.master_user')
@section('all_product')

<div class="main">
    <section class="module bg-dark-60 shop-page-header" data-background="assets/images/shop/product-page-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">HH Shop</h2>
                    <div class="module-subtitle font-serif">Sản phẩm của Shop</div>
                </div>
            </div>
        </div>
    </section>
    <section class="module-small">

    </section>
    <hr class="divider-w">
    <section class="module-small">
        <div class="container">
            <div class="row multi-columns-row">
                @foreach ($data as $item)
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="shop-item">
                        <div class="shop-item-image">
                            <img src="/template_admin/assets/img/{{ $item->img_prd }}" alt="Cold Garb" />
                            <div class="shop-item-detail">
                                <a href="{{ route('product_detail', $item->id_prd) }}" class="btn btn-round btn-b">
                                    <span class="icon-basket">Xem chi tiết</span>
                                </a>
                            </div>
                        </div>
                        <h4 class="shop-item-title font-alt"><a href="#">{{ $item->name_prd }}</a></h4>
                        @php echo number_format($item->price_prd)." VND"@endphp
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="pagination font-alt"><a href="#"><i class="fa fa-angle-left"></i></a><a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><i class="fa fa-angle-right"></i></a></div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop