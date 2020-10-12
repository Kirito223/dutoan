@extends('master')
@section('title')
Quản lý chỉ tiêu đánh giá
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Quản lý chỉ tiêu đánh giá</p>
            </section>
            <section class="panel-body">
                <section>
                    <button id="btnParentEvaluation" class="btn btn-info btn-sm">Thêm chỉ tiêu cha</button>
                </section>
                <table id="tableEvaluation" class="table table-bordered  ">
                    <thead class="thead-default">
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableEvaluation">

                    </tbody>
                </table>
            </section>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="modelInfomationEvaluation" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông tin chỉ tiêu</h5>
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
                                                placeholder="Nhập tên chỉ tiêu">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1-12 col-form-label">Đơn vị tính</label>
                                        <div class="col-sm-1-12">
                                            <select class="form-control" id="unit"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1-12 col-form-label">Chỉ tiêu cha:</label>
                                        <div class="col-sm-1-12">
                                            <select class="form-control" id="parent"></select>
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
<script type="module" src="{{asset('js/features/evaluationCriterion/index.js')}}"></script>
@endsection