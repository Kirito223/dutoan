@extends('master')
@section('title')
Chi tiết biểu mẫu
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Chi tiết biểu mẫu</p>
            </section>
            <section class="panel-body">
                <section class="">
                    <div class="form-group">
                        <label for="">Tên biểu mẫu</label>
                        <input type="text" name="" id="name" class="form-control" placeholder="Nhập tên biểu mẫu">
                    </div>
                    <div class="form-group">
                        <label for="">Số hiệu</label>
                        <input type="text" name="" id="number" class="form-control" placeholder="Nhập số hiệu biểu mẫu">
                    </div>
                    <div class="form-group">
                        <label for="">Thời gian</label>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="time" id="precious" value="1"> Quý
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="time" id="month" value="2">
                                Tháng
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="time" id="year" value="3">
                                Năm
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="width: 100%;">Đơn vị sử dụng</label>
                        <div style="padding: 0" class="col-md-11">
                            <input type="text" name="" id="department" disabled class="form-control" placeholder="">
                        </div>
                        <div style="padding: 0px 0px 0px 5px;" class="col-md-1">
                            <input type="button" id="selectDepartment" class="btn btn-info" value="Chọn...." />
                        </div>

                    </div>
                </section>
                <section class="col-md-12 col-xl-12">
                    <table class="table table-bordered" id="evaluationTable">
                        <thead class="thead-default">
                            <tr>
                                <th><input id="selectAllEvaluation" type="checkbox" /></th>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Đơn vị tính</th>
                            </tr>
                        </thead>
                        <tbody id="bodyTableEvaluation">

                        </tbody>
                    </table>
                    <section class="toolbox">
                        <button class="btn btn-primary btn-sm"><i class="glyphicon-save"></i>Lưu</button>
                    </section>
                </section>


            </section>
        </section>
    </section>
</section>

<!-- Modal -->
<div class="modal fade" id="modelSelectDepartment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chọn đơn vị </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <table id="tableDepartment" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllDepartment" /></th>
                                        <th>Tên đơn vị</th>
                                        <th>Địa chỉ</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyTableDepartment">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" id="SelectedDepartment" class="btn btn-primary">Chọn đơn vị</button>
            </div>
        </div>
    </div>
</div>
<script type="module" src="{{asset('js/features/template/detail.js')}}"></script>

@endsection