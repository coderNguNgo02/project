@extends('layouts.master_admin')
@section('index_product')

<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="car"></div>
    <div class="card mb-4">
      <div class="card-header"><span class="small ms-1">Quản lý sản phẩm</span></div>
      <div class="card-body">
        <div class="tab-content rounded-bottom">
          <a href="{{ route('create_product') }}" type="button" class="btn btn-success">Thêm sản phẩm</a>
          <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">STT</th>
                  <th scope="col">Tên sản phẩm</th>
                  <th scope="col">Danh mục</th>
                  <th scope="col">Nhãn hiệu</th>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Size</th>
                  <th scope="col">Hành động</th>
                </tr>
              </thead>
              <tbody>
                @php
                $stt = 1;
                @endphp
                @foreach ($giay as $item)
                @php

                @endphp
                <tr>
                  <th scope="row">@php echo $stt++; @endphp</th>
                  <td>{{ $item->name_prd }}</td>
                  <td>{{ $item->name_cate }}</td>
                  <td>{{ $item->brand_prd}}</td>
                  <td><img width="150px" height="150px" src="/template_admin/assets/img/{{$item->img_prd}}"></td>
                  <td style="color: red">@php echo number_format($item->price_prd); @endphp <span style="color: black"> VND</span></td>


                  <td>
                    @foreach ($item->productSize->sortBy('size.size_value') as $productSize)
                    {{ $productSize->size->size_value }}
                    @endforeach
                  </td>
                  <td>
                    <a type="button" class="btn btn-info" href="{{ route('edit_product', $item->id_prd) }}">Sửa</a>
                    <a type="button" class="btn btn-danger" href="{{ route('delete_product', $item->id_prd) }}">Xóa</a>
                    <a type="button" class="btn btn-success" href="{{ route('get_detail_prd', $item->id_prd) }}">Chi tiết</a>
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