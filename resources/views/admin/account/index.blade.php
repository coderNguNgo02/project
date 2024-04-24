@extends('layouts.master_admin')
@section('index_account')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="car"></div>
            <div class="card mb-4">
                <div class="card-header"><span class="small ms-1">Quản lý tài khoản</span></div>
                <div class="card-body">
                    <div class="tab-content rounded-bottom">
                        <a href="{{ route('account_add') }}" class="btn btn-success">Thêm tài khoản</a>
                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1000">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Quyền</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $stt = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>  
                                            <th scope="row">@php echo $stt++; @endphp</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            @php
                                                if ($item['level'] == 1) {
                                                    echo '<td> Admin </td>';
                                                } else {
                                                    echo '<td> Member </td>';
                                                }
                                            @endphp
                                            <td>
                                                <a type="button" class="btn btn-info" href="{{ route('edit_account', $item->id_user) }}">Sửa</a> <a
                                                    type="button" class="btn btn-danger" href="{{ route('delete_account', $item->id_user) }}">Xóa</a>
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
