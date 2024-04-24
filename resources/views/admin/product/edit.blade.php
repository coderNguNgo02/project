@extends('layouts.master_admin')
@section('edit_category')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1004">
                                <div class="card-body">
                                    
                                    <h1>Sửa sản phẩm</h1>
                                    <br>
                                    @foreach ($data as $item)
                                    <form action="{{ route('update_product', $item->id_prd) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        
                                            <div class="mb-3">

                                                <div>
                                                    <label for="exampleFormControlInput1" class="form-label">Tên sản
                                                        phẩm</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                                        placeholder="Tên sản phẩm" name="ip_prd_name"
                                                        value="{{ $item->name_prd }}">
                                                </div>
                                                <br>

                                                <div>
                                                    <label for="exampleFormControlInput2" class="form-label">Giá</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput2"
                                                        placeholder="Giá tiền" name="ip_prd_price"
                                                        value="{{$item->price_prd}}">
                                                </div>
                                                <br>

                                                <div>
                                                    <label for="exampleFormControlInput3" class="form-label">Thương
                                                        hiệu</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                                        placeholder="Thương hiệu sản phẩm" name="ip_prd_brand" value="{{ $item->brand_prd }}">
                                                </div>
                                                <br>

                                                <div>
                                                    <label for="exampleFormControlInput3" class="form-label">Số
                                                        lượng</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput3"
                                                        placeholder="Số lượng sản phẩm" name="ip_prd_qty" value="{{ $item->qty }}">
                                                </div>
                                                <br>

                                                <div>
                                                    <label for="exampleFormControlInput4" class="form-label">Danh
                                                        mục</label>
                                                    <select name="ip_prd_cate" id="exampleFormControlInput4">
                                                       
                                                        @foreach ($cate as $Cate)
                                                        <option value="{{ $Cate->id_cate}}"> {{$Cate->name_cate}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <br>

                                                <div>
                                                    <label for="prd_img">Hình ảnh</label>
                                                    <br>
                                                    <input name="ip_prd_img" type="file" id="prd_img"
                                                        accept="image/*" onchange="loadImage()">
                                                    <img src="/template_admin/assets/img/{{ $item->img_prd }}" id="img"
                                                        width="260px" height="300px" style="margin-left: 60px;">
                                                </div>
                                                <br>

                                                <div>
                                                    <label for="exampleFormControlInput5" class="form-label">Mô tả</label>
                                                    <textarea type="text" class="form-control" id="exampleFormControlInput5" placeholder="Nhập mô tả" name="ip_prd_desc"></textarea>
                                                </div>
                                                <br>

                                                <button class="btn btn-success" type="submit">Sửa sản phẩm</button>
                                        @endforeach
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<script>
    function loadImage() {
        img = document.getElementById('img');
        img.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
