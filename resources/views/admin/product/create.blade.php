@extends('layouts.master_admin')
@section('create_category')
<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="tab-content rounded-bottom">
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1004">
                            <div class="card-body">
                                <h1>Thêm sản phẩm</h1>
                                <br>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">

                                        <div>
                                            <label for="exampleFormControlInput1" class="form-label">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="ten" placeholder="Tên sản phẩm" name="ip_prd_name">
                                        </div>
                                        <br>

                                        <div>
                                            <label for="exampleFormControlInput2" class="form-label">Giá</label>
                                            <input type="number" class="form-control" id="gia" placeholder="Giá tiền" name="ip_prd_price">
                                        </div>
                                        <br>

                                        <div>
                                            <label for="exampleFormControlInput3" class="form-label">Thương hiệu</label>
                                            <input type="text" class="form-control" id="hang" placeholder="Thương hiệu sản phẩm" name="ip_prd_brand">
                                        </div>
                                        <br>

                                        <div>
                                            <label for="exampleFormControlInput3" class="form-label">Số lượng</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput8" placeholder="Số lượng sản phẩm" name="ip_prd_qty">
                                        </div>
                                        <br>

                                        <div>
                                            <label for="exampleFormControlInput4" class="form-label">Danh mục</label>
                                            <select name="ip_prd_cate" id="danhmuc">
                                                @foreach($cate as $item)
                                                <option value="{{ $item->id_cate}}"> {{ $item->name_cate }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div>
                                            <label for="exampleFormControlInput4" class="form-label">Kích thước</label>
                                            <select name="ip_prd_size" id="size">
                                                @foreach($size as $item)
                                                <option value="{{ $item->id_size}}"> {{ $item->size_value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div>
                                            <label for="prd_img">Hình ảnh</label>
                                            <br>
                                            <h3 style="display: none;text-align: center;margin: 20px;margin-bottom: 0px;">Sản phẩm có size này đã tồn tại.Nếu muốn chỉnh sửa hình ảnh vui lòng vào Quản lý sản phẩm.</h3>
                                            <input name="ip_prd_img" type="file" id="prd_img" required accept="image/*" onchange="loadImage()">
                                            <img src="/template_admin/assets/img/no-img.svg.png" id="img" width="260px" height="300px" style="margin-left: 60px;">
                                        </div>
                                        <br>

                                        <div>
                                            <label for="exampleFormControlInput5" class="form-label">Mô tả</label>
                                            <textarea type="text" class="form-control" id="exampleFormControlInput5" placeholder="Nhập mô tả" name="ip_prd_desc"></textarea>
                                        </div>
                                        <br>

                                        <button class="btn btn-success" type="submit">Thêm sản phẩm</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function loadImage() {
        img = document.getElementById('img');
        img.src = URL.createObjectURL(event.target.files[0]);
    }


    $(document).ready(function() {
        $('#ten, #hang, #size,#danhmuc').on('change', function() {
            var ten = $('#ten').val();
            var hang = $('#hang').val();
            var size = $('#size option:selected').text();
            var danhmuc = $('#danhmuc option:selected').text();

            console.log(ten, hang, size, danhmuc);

            $.ajax({
                url: `{{ route('giays.kiem-tra-trung') }}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ten: ten,
                    hang: hang,
                    size: size,
                    danhmuc: danhmuc
                },
                success: function(response) {
                    if (response.trung) {
                        $('#prd_img').attr('disabled', 'disabled');
                        $('#gia').val('').attr('placeholder', 'Sản phẩm có size này đã tồn tại.Nếu muốn chỉnh sửa giá tiền của sản phẩm này hãy vào trang Quản lý sản phẩm');
                        $('#gia').attr('disabled', 'disabled');
                        $('#prd_img').hide();
                        $('#img').hide();
                        $('h3').show();
                    } else {
                        $('h3').hide();
                        $('#prd_img').show();
                        $('#img').show();
                        $('#gia').removeAttr('disabled');
                        $('#gia').attr('placeholder', '');
                    }
                }
            });
        });
    });
</script>