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
                                @foreach ($prd as $item)
                                <form action="{{ route('update_product_detail', ['id_prd' => $item->id_prd, 'id_size' => $item->id_size]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">

                                        <div>
                                            <label for="exampleFormControlInput3" class="form-label">Số lượng</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput3" placeholder="Số lượng sản phẩm" name="ip_prd_qty" value="{{ $item->qty }}">
                                        </div>
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