@extends('master')
@section('title')
Chi tiết dự toán
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Chi tiết dự toán </p>
            </section>
            <section class="panel-body">
                <section class="row">
                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for=""><b>Tên dự toán</b> <span id="name"> </span></label>
                            <input id="idEstimate" class="hidden" value="{{$id}}" />
                        </div>
                        <div class="form-group">
                            <label for=""><b>Thời gian:</b> <span id="time"></span></label>

                        </div>
                        <div class="form-group">
                            <label for=""><b>Biểu mẫu báo cáo:</b> <span id="template"></span></label>
                        </div>
                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label><b>Đơn vị báo cáo:</b> <span id="department"></span></label>
                        </div>

                        <div class="form-group hidden" id="signbox">
                            <label><b>Người ký :</b> <span id="sign"></span></label>
                        </div>
                    </section>
                    {{-- <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Đính kèm:</label>
                            <input type="text" class="form-control" name="" id="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung:</label>
                            <textarea class="form-control" cols="30" rows="15"></textarea>
                        </div>
                    </section> --}}

                </section>
                <section class=" row">
                    <section class="col-md-12 col-xl-12">
                        <table id="tableEvaluation" class="table table-bordered table-inverse ">
                            <thead class="thead-default">
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Đơn vị</th>
                                    <th>Giá trị</th>
                                </tr>
                            </thead>
                            <tbody id="BodyEvaluation">

                            </tbody>
                        </table>
                    </section>
                    <section class="col-md-12 col-xl-12">
                        <input value="{{$showApprovalBar}}" class="hidden" id="showApprovalBar" />
                        @if ($showApprovalBar == true)
                        <section class="toolbox">
                            <button id="btnApproval" class="btn btn-primary btn-sm">Phê duyệt dự toán</button>
                            <button id="btnReject" class="btn btn-danger btn-sm">Từ chối dự toán</button>
                            <button id="btnAdditional" class="btn btn-warning btn-sm">Yêu cầu sửa đổi/bổ sung</button>
                        </section>
                        @endif

                    </section>
                </section>

            </section>
        </section>
    </section>
</section>

<!-- Modal -->
<div class="modal fade" id="modelAdditional" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yêu cầu sửa đổi bổ sung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label for="">Yêu cầu</label>
                        <textarea id="content" cols="30" rows="20" class="form-control">

                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" id="btnSendAdditional" class="btn btn-primary">Gửi yêu cầu</button>
            </div>
        </div>
    </div>
</div>

<script type="module" src="{{asset('js/features/estimates/viewDetail.js')}}"></script>
@endsection