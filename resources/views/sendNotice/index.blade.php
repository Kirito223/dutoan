@extends('master')
@section('title')
Gửi thông báo
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Gửi yêu cầu/thông báo</p>
            </section>
            <section class="panel-body">
                <section class="row">
                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Tiêu đề:</label>
                            <input type="text" class="form-control" name="" id="title" placeholder="">

                        </div>

                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Đơn vị:</label>
                            <div style="display: flex">
                                <input style="width: 90%;margin-right: 10px;" type="text" class="form-control" name=""
                                    id="department" placeholder="">
                                <button id="selectDepartment" class="btn btn-primary btn-sm">Chọn....</button>
                            </div>
                        </div>


                    </section>
                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Đính kèm:</label>
                            <input type="file" multiple class="form-control" id="file">
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung:</label>
                            <textarea id="content" class="form-control" cols="30" rows="15"></textarea>
                        </div>
                    </section>
                    <section class="col-md-12 col-xl-12">
                        <section class="toolbox">
                            <button id="send" class="btn btn-primary">Gửi thông báo</button>
                        </section>
                    </section>
                </section>
                <section class="row">
                    <section class="col-md-12 col-xl-12">
                        <table class="table table-bordered table-inverse ">
                            <thead class="thead-default">
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Đơn vị</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="bodyTableNotice">
                            </tbody>
                        </table>
                    </section>
                </section>

                <!-- Modal -->
                <div class="modal fade" id="modelSelectDepartment" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Chọn đơn vị gửi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <table class="table table-bordered  ">
                                        <thead class="thead-default">
                                            <tr>
                                                <th><input type="checkbox" id="selectAll"></th>
                                                <th>Tên đơn vị</th>
                                                <th>Địa chỉ</th>
                                                <th>Số điện thoại</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyTableDepartment">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" id="btnOKSelectedDepartment" class="btn btn-primary">Chọn</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM
        
    });
                </script>
            </section>
        </section>
    </section>
</section>
<script type="module" src="{{asset('js/features/notice/index.js')}}"></script>
@endsection