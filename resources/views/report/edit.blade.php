@extends('master')
@section('title')
Lập báo cáo
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Lạp báo cáo</p>
            </section>
            <section class="panel-body">
                <div class="form-group">
                    <label for="">Tên báo cáo</label>
                    <input type="text" id="name" class="form-control" placeholder="Nhập tên báo cáo" />
                    <input class="hidden" id="idInput" value="{{$id}}" />
                </div>
                <div class="form-group">
                    <label for="">Thời gian</label>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="time" id="precious" value="1">
                            Quý
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
                <div class="form-group ">
                    <label class="control-label" for="">Đính kèm dự toán:</label>
                    <table class="table table-bordered  ">
                        <thead class="thead-default">
                            <tr>
                                <th></th>
                                <th>Tên dự toán</th>
                            </tr>
                        </thead>
                        <tbody id="tableEstimate">

                        </tbody>

                    </table>
                    <section class="paginations">
                        <ul id="paginationEstimateTable" class="pagination-md"></ul>
                    </section>
                </div>
                <div class="form-group">
                    <label for="">Nội dung báo cáo</label>
                    <textarea class="form-control" id="content"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Đơn vị nhận:</label>
                    <table class="table table-bordered">
                        <thead class="thead-default">
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th>Tên đơn vị</th>
                                <th>Địa chỉ</th>
                            </tr>
                        </thead>
                        <tbody id="bodyTableDepartment">

                        </tbody>
                    </table>
                </div>
                <section class="toolbox">
                    <button id="send" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Gửi báo
                        cáo</button>
                </section>
            </section>
        </section>
    </section>
</section>

<script type="module" src="{{asset('js/features/reports/edit.js')}}"></script>

@endsection