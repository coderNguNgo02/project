@extends('layouts.master_admin')
@section('detail_product')

<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="car"></div>
    <div class="card mb-4">
      <div class="card-header"><b class="small ms-1">Chi tiết sản phẩm: @php echo $prd[0]->name_prd; @endphp</b>
        <div style="display: flex; justify-content: flex-end; margin-top:-25px;"><a class="btn btn-success" href="{{route('product_admin')}}">Quay lại</a></div>
      </div>
      <div class="card-body">
        <div class="tab-content rounded-bottom">
          <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col">Size</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Tồn kho</th>
                  <th scope="col">Hành động</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($prd as $item)
                <tr>
                  <td><img width="150px" height="150px" src="/template_admin/assets/img/{{$item->img_prd}}"></td>
                  <td>{{$item->size_value}}</td>
                  <td>@php echo number_format($item->price_prd)." VND"; @endphp</td>
                  <td>{{$item->qty}} đôi</td>
                  @php
                  @endphp
                  <td>
                    <a type="button" class="btn btn-info" href="{{ route('edit_product_detail', ['id_prd' => $item->id_prd, 'id_size' => $item->id_size]) }}">Sửa</a>
                    <a type="button" class="btn btn-danger" href="{{ route('delete_product_detail', ['id_prd' => $item->id_prd, 'id_size' => $item->id_size]) }}">Xóa</a>
                  </td>
                </tr>

                @endforeach

              </tbody>
            </table>
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
  </div>
  @endsection