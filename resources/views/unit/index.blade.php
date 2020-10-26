@extends('master')
@section('title')
Quản lý đơn vị tính
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Quản lý đơn vị tính</p>
            </section>
            <section class="panel-body">
                <section>
                    <button id="btnUnit" class="btn btn-info btn-sm">Thêm đơn vị tính</button>
                </section>
                <table id="tableUnit" class="table table-bordered  ">
                    <thead class="thead-default">
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableUnit">

                    </tbody>
                </table>
                <section class="paginations">
                    <ul id="paginationTable" class="pagination-md"></ul>
                </section>
            </section>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="modelInfomationUnit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông tin đơn vị</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-xl-12">

                                    <div class="form-group">
                                        <label class="col-sm-1-12 col-form-label">Tên</label>
                                        <div class="col-sm-1-12">
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Nhập tên đơn vị">
                                            <small name="name" class="alert-error"></small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" id="btnSave" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<script type="module" src="{{asset('js/features/unit/index.js')}}"></script>
@endsection