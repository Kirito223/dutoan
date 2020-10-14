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

                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label><b>Đơn vị báo cáo:</b> <span id="department"></span></label>
                        </div>
                    </section>

                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><b>Thời gian:</b> <span id="time"></span></label>

                        </div>
                    </section>
                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><b>Biểu mẫu báo cáo:</b> <span id="template"></span></label>
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
                        <section class="toolbox">
                            <button id="btnApproval" class="btn btn-primary btn-sm">Phê duyệt dự toán</button>
                            <button id="btnReject" class="btn btn-danger btn-sm">Từ chối dự toán</button>
                            <button id="btnAdditional" class="btn btn-warning btn-sm">Yêu cầu sửa đổi/bổ sung</button>
                        </section>
                    </section>
                </section>

            </section>
        </section>
    </section>
</section>

<script type="module" src="{{asset('js/features/estimates/viewDetail.js')}}"></script>
@endsection