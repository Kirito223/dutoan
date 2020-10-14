@extends('master')
@section('title')
Danh sách dự toán chờ phê duyệt
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Danh sách dự toán chờ phê duyệt</p>
            </section>
            <section class="panel-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên dự toán</th>
                            <th>Loại dự toán</th>
                            <th>Ngày gửi</th>
                            <th>Người gửi</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableEstimate">

                    </tbody>
                </table>
                <section class="paginations">
                    <ul id="paginationTable" class="pagination-md"></ul>
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
                <button type="button" id="btnSendDepartment" class="btn btn-primary">Gửi</button>
            </div>
        </div>
    </div>
</div>
<script type="module" src="{{asset('js/features/estimates/approval.js')}}"></script>

@endsection