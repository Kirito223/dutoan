@extends('master')
@section('title')
Phê duyệt báo cáo
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Phê duyệt báo cáo</p>
            </section>
            <section class="panel-body">
                <div class="form-group">
                    <label for="">Tên báo cáo: <span>{{$report->name}}</span></label>
                    <input id="reportId" class="hidden" value="{{$id}}" />
                </div>
                <div class="form-group">
                    <label for="">Đơn vị gửi: <span>{{$report->department->name}}</span></label>

                </div>
                <div class="form-group">
                    <label for="">Thời gian:
                        <span>{{$kind}}</span>

                    </label>
                </div>
                <div class="form-group ">
                    <label class="control-label" for="">Đính kèm dự toán:</label>
                    <table class="table table-bordered  ">
                        <thead class="thead-default">
                            <tr>
                                <th>Tên dự toán</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tableEstimate">
                            @foreach ($estimate as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td><button class="btn btn-sm btn-default"><i class="fas fa-eye "></i> Xem</button></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="form-group">
                    <label for="">Nội dung báo cáo</label>
                    <textarea disabled class="form-control" id="content">
                        {{$report->content}}
                    </textarea>
                </div>

                <section class="toolbox">
                    <button data-id="{{$report->id}}" id="btnApproval" class="btn btn-success btn-sm"><i
                            class="fas fa-check-circle"></i> Phê duyệt
                        báo cáo</button>
                    <button data-id="{{$report->id}}" id="btnAdditional" class="btn btn-warning btn-sm"><i
                            class="fas fa-edit"></i> Yêu cầu bổ sung/chỉnh sửa</button>
                    <button data-id="{{$report->id}}" id="btnReject" class="btn btn-danger btn-sm"><i
                            class="fas fa-ban"></i> Từ
                        chối</button>
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
                        <textarea id="contentSend" cols="30" rows="20" class="form-control">

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
<script type="module" src="{{asset('js/features/reports/approval.js')}}"></script>

@endsection