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
                    <section class="col-md-6 col-xs-6">
                        <section id="infomationAccount" class="col-md-12 col-xs-12">
                            <h4>Thông tin tài khoản</h4>
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input type="text" class="form-control" name="" id="name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Tên đăng nhập</label>
                                <input type="text" class="form-control" name="" id="username" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="">Mật khẩu</label>
                                <input type="password" class="form-control" name="" id="password" placeholder="">
                            </div>

                        </section>

                    </section>

                    <section class="col-md-12 col-xl-12">
                        <section class="toolbox">
                            <button id="btnAddNew" class="btn btn-primary"><i class="fas fa-save fa-sm fa-fw"></i>
                                Thêm mới</button>

                            <button id="btnSave" class="btn btn-primary hidden"><i class="fas fa-save fa-sm fa-fw"></i>
                                Lưu</button>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>

<script type="module" src="{{asset('js/features/account/index.js')}}"></script>
@endsection