@extends('master')
@section('title')
Đơn vị hành chính
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
                        <div class="form-group">
                            <label for="">Tên đơn vị:</label>
                            <input type="text" class="form-control" name="" id="name" placeholder="">

                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ: </label>
                            <input type="text" class="form-control" name="" id="address" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Tỉnh: </label>
                            <select type="text" class="form-control" name="" id="province" placeholder=""></select>
                        </div>
                        <div class="form-group">
                            <label for="">Huyện: </label>
                            <select type="text" class="form-control" name="" id="district" placeholder=""></select>
                        </div>
                        <div class="form-group">
                            <label for="">Xã: </label>
                            <select type="text" class="form-control" name="" id="commune" placeholder=""></select>
                        </div>
                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Điện thoại: </label>
                            <input type="text" class="form-control" name="" id="phone" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Email: </label>
                            <input type="email" class="form-control" name="" id="email" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Đơn vị cấp trên: </label>
                            <select id="parentDepartment" class="form-control">
                                <option value="">Không có</option>
                            </select>
                        </div>
                    </section>
                    <section class="col-md-12 col-xs-12">
                        <h4>Thông tin tài khoản</h4>
                        <div class="form-group">
                            <label for="">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="" id="username" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" class="form-control" name="" id="password" placeholder="">
                        </div>

                    </section>
                    <section class="col-md-12 col-xl-12">
                        <section class="toolbox">
                            <button id="btnSave" class="btn btn-primary"><i class="fas fa-save fa-sm fa-fw"></i>
                                Lưu</button>
                        </section>
                    </section>
                </section>
                <section class="row">
                    <section class="col-md-12 col-xl-12">
                        <table class="table table-bordered table-inverse ">
                            <thead class="thead-default">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên đơn vị</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody id="tableDepartment">

                            </tbody>
                        </table>
                        <section class="paginations">
                            <button id="nextPage" class="btn btn-primary btn-sm">Trang trước</button>
                            <input id="page" />
                            <button id="perviousPage" class="btn btn-primary btn-sm">Trang sau</button>
                        </section>
                    </section>
                </section>

            </section>
        </section>
    </section>
</section>
<script type="module" src="{{asset('js/features/department/index.js')}}"></script>
@endsection