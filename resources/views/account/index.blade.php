@extends('master')
@section('title')
Quản lý tài khoản
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Quản lý đơn vị hành chính</p>
            </section>
            <section class="panel-body">
                <section class="row">
                    <section class="col-md-12 col-xl-12">
                        <section class="header-toolbox">
                            <button id="btnAddNew" class="btn btn-primary"><i class="fas fa-save fa-sm fa-fw"></i>
                                Thêm mới</button>
                            <input id="department" value="{{$id}}" class="hidden" />
                        </section>
                    </section>
                    <section class="col-md-12 col-xs-12">
                        <table class="table table-bordered table-inverse ">
                            <thead class="thead-default">
                                <tr>
                                    <th>STT</th>
                                    <th>Họ và tên</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody id="tableAccount">

                            </tbody>
                        </table>
                        <section class="paginations">
                            <ul id="paginationTable" class="pagination-md"></ul>
                        </section>
                    </section>


                </section>
            </section>
        </section>
    </section>
</section>

<!-- Modal -->
<div class="modal fade" id="modelAddNew" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin tài khoàn mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" id="name" class="form-control" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input type="text" id="username" class="form-control" placeholder="Nhập tên đăng nhập">
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Nhập mật khẩu">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button id="btnSaveAccount" type="button" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div>
<script type="module" src="{{asset('js/features/account/index.js')}}"></script>
@endsection