@extends('layouts.master_user')
@section('user_home')
<section class="home-section home-fade home-full-height" id="home">
    <div class="hero-slider">
        <ul class="slides">
            <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;assets/images/shop/slider1.png&quot;);">
                <div class="titan-caption">
                    <div class="caption-content">
                        <div class="font-alt mb-30 titan-title-size-1">This is HH</div>
                        <div class="font-alt mb-30 titan-title-size-4"> Winter 2023</div>
                        <div class="font-alt mb-40 titan-title-size-1">Your online fashion destination</div><a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                    </div>
                </div>
            </li>
            <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;assets/images/shop/slider3.png&quot;);">
                <div class="titan-caption">
                    <div class="caption-content">
                        <div class="font-alt mb-30 titan-title-size-1"> This is Titan</div>
                        <div class="font-alt mb-40 titan-title-size-4">Exclusive products</div><a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
<div class="main">
    @php
    $current_category = "";
    $check = 0;
    @endphp

    @foreach($data as $item)
    @if($item->name != $current_category)
</div> <!-- Kết thúc hàng cũ -->
@if($check > 4)
</div> <!-- Kết thúc hàng cũ -->
<div class="row"> <!-- Bắt đầu hàng mới 1 -->
    @endif
    <section class="module-small">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">{{ $item->name }}</h2>
                </div>
            </div>
            <div class="row multi-columns-row"> <!-- Bắt đầu hàng mới -->
                @endif

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

                @php
                $check++;
                $current_category = $item->name;
                @endphp

                @endforeach
            </div> <!-- Kết thúc hàng cuối cùng -->
        </div>
</div>






</div>
@stop