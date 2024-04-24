@extends('layouts.master_admin')
@section('edit_category')
    <form action="" method="POST">
        @csrf
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1004">
                                    <div class="card-body">
                                        <h1>Sửa thông tin danh mục</h1>
                                        <br>
                                        @foreach ($data as $item)
                                            <form action="{{ route('update_category', $item->id_cate) }}" method="POST">

                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                                        placeholder="Họ và tên" name="ip_cate_name" value="{{ $item->name_cate }}">
                                                    <br>
                                                    <button class="btn btn-success" type="submit">Sửa danh mục</button>
                                                </div>

                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
