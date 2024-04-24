@extends('layouts.master_user')
@section('detail_product')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<section class="home-section home-fade home-full-height" id="home">
    <div class="hero-slider">
        <ul class="slides">
            <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;assets/images/shop/slider1.png&quot;);">
                <div class="titan-caption">
                    <div class="caption-content">
                        <div class="font-alt mb-30 titan-title-size-1">This is Titan</div>
                        <div class="font-alt mb-30 titan-title-size-4"> Summer 2017</div>
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
    <section class="module">
        <div class="container">
            <div class="row">
                @foreach ($data as $item)
                <form id="myForm" action="{{ route('cart_customer') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $item->id_prd }}" name="ip_id_prd">
                    <div class="col-sm-6 mb-sm-40"><a class="gallery"><img src="/template_admin/assets/img/{{ $item->img_prd }}" alt="Single Product Image" /></a>
                        <input type="hidden" value="{{ $item->img_prd }}" name="ip_name_img">
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1 class="product-title font-alt">{{ $item->name_prd }}</h1>
                                <input type="hidden" value="{{ $item->name_prd }}" name="ip_name_prd">
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-sm-12">
                                <div class="price font-alt"><span class="amount">@php echo number_format($item->price_prd)@endphp VND</span></div>
                                <input type="hidden" value="{{ $item->price_prd }}" name="ip_price_prd">
                            </div>
                        </div>
                        <b>Mô tả</b>
                        <div class="row mb-20">
                            <div class="col-sm-12">
                                <div class="description">
                                    <p>{{ $item->desc_prd }}</p>
                                </div>
                            </div>
                        </div>

                        @php
                        $max_Max = 999;
                        @endphp
                        <div class="size-btn">
                            <label for="size">Kích thước:</label>
                            <div class="size-buttons">
                                @foreach ($size as $Size)
                                <button onclick="getSizeValue({{ $Size->id_size }},{{$Size->qty}},{{ $item->id_prd }})" type="button" class="size-button" value="@php echo $Size->id_size; @endphp" @if ($Size->qty == 0) @disabled(true) @endif required>{{ $Size->size_value }}</button>
                                @endforeach
                                <input id="size_prd" type="hidden" name="ip_size_prd">
                                <input id="size_id" type="hidden" name="ip_size_id">
                            </div>
                        </div>
                        <br>
                        <div style="margin-top: -15px;margin-bottom: 20px;">
                            <b>Số lượng hàng còn: <b id="myBoldText"></b></b>
                            <input id="max_qty" type="hidden" name="ip_max_qty">
                        </div>
                        <b>Số lượng: </b>
                        <br>
                        <div style="width: 200px">
                            <input id="size_sl" class="form-control input-lg" min="1" max="{{ $max_Max }}" onkeydown="return false" type="number" name="ip_buy_qty" value="0" required>
                        </div>
                        <br>
                        <div class="row mb-20">
                            <div class="col-sm-8"><button class="btn btn-lg btn-block btn-round btn-b">Thêm
                                    vào giỏ hàng</button>
                            </div>
                        </div>
                        <div class="row mb-20">
                            <div class="col-sm-12">
                            </div>
                        </div>
                    </div>

                </form>
                @endforeach
            </div>
        </div>
    </section>

    <hr class="divider-w">
    <section class="module-small">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Bạn có thể quan tâm</h2>
                </div>
            </div>
            <div class="row multi-columns-row">
                @foreach ($prd as $Prd)
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="shop-item">
                        <div class="shop-item-image"><img src="/template_admin/assets/img/{{ $Prd->img_prd }}" />
                            <div class="shop-item-detail"><a href="" class="btn btn-round btn-b"><span class="icon-basket">Xem chi tiết sản
                                        phẩm</span></a></div>
                        </div>
                        <h4 class="shop-item-title font-alt"><a href="#">{{ $Prd->name_prd }}</a></h4>
                        @php echo number_format($Prd->price_prd); @endphp <span>VND</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        var inputElement = document.getElementById("size_sl");
        inputElement.value = 0;
    });
    // Lấy tất cả các nút button kích thước
    var sizeButtons = document.querySelectorAll('.size-button');
    var form = document.getElementById('myForm');

    // Xử lý sự kiện khi nút button được bấm
    sizeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Bỏ chọn tất cả các nút button
            sizeButtons.forEach(function(btn) {
                btn.classList.remove('selected');
            });

            // Tích vào nút button được chọn
            button.classList.add('selected');
        });
    });

    function getSizeValue(id, qty, id_prd) {
        var lai = document.getElementById('size_sl');
        lai.value = 0;
        var size = document.getElementById('size_prd');
        size.value = id;
        lai.max = qty;
        var myBoldText = document.getElementById("myBoldText");
        myBoldText.textContent = qty + " đôi";
        var maxQty = document.getElementById("max_qty");
        maxQty.value = qty;


    }

    form.addEventListener('submit', function(event) {
        var selectedSize = false;

        sizeButtons.forEach(function(button) {
            if (button.classList.contains('selected')) {
                selectedSize = true;
            }
        });

        if (!selectedSize) {
            event.preventDefault();
            alert('Vui lòng chọn một size trước khi gửi form.');
        }
    });
</script>

@stop