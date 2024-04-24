@extends('layouts.master_admin')
@section('index_category')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <div class="car"></div>
      <div class="card mb-4">
        <div class="card-header"><span class="small ms-1">Quản lý danh mục</span></div>
        <div class="card-body">
            <div class="tab-content rounded-bottom">
                <a type="button" class="btn btn-success" href="{{ route('create_category') }}">Thêm danh mục</a>
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $stt = 1 @endphp
                            @foreach ($data as $item)      
                            <tr>
                            <th scope="row">@php echo $stt++ @endphp</th>
                            <td>{{ $item->name_cate }}</td>
                            <td>
                                <a type="button" class="btn btn-info" href="{{ route('edit_category', $item->id_cate) }}">Sửa</a> <a type="button" class="btn btn-danger"
                                 href="{{ route('delete_category', $item->id_cate)}}">Xóa</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
        </div>
    </div>
</div>
@endsection