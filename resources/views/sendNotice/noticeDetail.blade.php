@extends('master')
@section('title')
Chi tiết thông báo
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
                            <input type="text" class="form-control" name="" id="" placeholder="">

                        </div>

                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Đơn vị:</label>
                            <input type="text" class="form-control" name="" id="" placeholder="">
                            <button class="btn btn-primary btn-sm">Chọn</button>
                        </div>


                    </section>
                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Đính kèm:</label>
                            <input type="file" class="form-control" name="" id="file" placeholder="">
                            <ul>
                                <li>file</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung:</label>
                            <textarea class="form-control" cols="30" rows="15"></textarea>
                        </div>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
@endsection