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
                                        <h1>Thêm danh mục</h1>
                                        <br>
                                        <form action="{{ route('store_category') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                                    placeholder="Họ và tên" name="ip_cate">
                                                <br>
                                                <button class="btn btn-success" type="submit">Thêm danh mục</button>
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
