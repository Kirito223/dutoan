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
                            <small class="alert-error" name="name"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ: </label>
                            <input type="text" class="form-control" name="" id="address" placeholder="">
                            <small class="alert-error" name="address"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Tỉnh: </label>
                            <select type="text" class="form-control" name="" id="province" placeholder=""></select>
                            <small class="alert-error" name="province"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Huyện: </label>
                            <select type="text" class="form-control" name="" id="district" placeholder=""></select>
                            <small class="alert-error" class="alert-error" name="district"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Xã: </label>
                            <select type="text" class="form-control" name="" id="commune" placeholder=""></select>
                            <small class="alert-error" name="commune"></small>
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

                    <section class="col-md-12 col-xl-12">
                        <section class="toolbox">
                            <button id="btnAddNew" class="btn btn-primary"><i class="fas fa-save fa-sm fa-fw"></i>
                                Thêm mới</button>
                            <button id="btnUpdate" class="btn btn-primary hidden"><i
                                    class="fas fa-save fa-sm fa-fw"></i>
                                Cập nhật</button>
                            <button id="btnSave" class="btn btn-primary hidden"><i class="fas fa-save fa-sm fa-fw"></i>
                                Lưu</button>
                            <button id="btnExit" class="btn btn-danger hidden"><i class="fas fa-save fa-sm fa-fw"></i>
                                Hủy</button>
                        </section>
                    </section>
                </section>
                <section class="row">
                    <section class="col-md-12 col-xl-12">
                        <table id="tableDepartments" class="table table-bordered table-inverse ">
                            <thead class="thead-default">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên đơn vị</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody id="tableDepartment">

                            </tbody>
                        </table>

                    </section>
                </section>

            </section>
        </section>
    </section>
</section>
<style>
    .tdBox {
        text-align: center;
    }

    .tdBox button {
        margin: 0px 5px;
    }
</style>
<script type="module" src="{{asset('js/features/department/index.js')}}"></script>
@endsection