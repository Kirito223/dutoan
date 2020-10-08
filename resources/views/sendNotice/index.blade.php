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
                            <input type="text" class="form-control" name="" id="" placeholder="">

                        </div>

                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Đơn vị:</label>
                            <input type="text" class="form-control" name="" id="" placeholder="">
                        </div>


                    </section>
                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Đính kèm:</label>
                            <input type="text" class="form-control" name="" id="" placeholder="">
                            <ul>
                                <li>file</li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung:</label>
                            <textarea class="form-control" cols="30" rows="15"></textarea>
                        </div>
                    </section>
                    <section class="col-md-12 col-xl-12">
                        <section class="toolbox">
                            <button class="btn btn-primary">Gửi</button>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td scope="row"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </section>

            </section>
        </section>
    </section>
</section>
<script type="module" src="{{asset('js/features/notice/index.js')}}"></script>
@endsection