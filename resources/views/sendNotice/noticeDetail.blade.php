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
                            <input type="text" value="{{$notice->title}}" class="form-control" disabled>

                        </div>

                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Người gửi</label>
                            <input type="text" value="{{$notice->name}}" class="form-control" disabled>
                        </div>


                    </section>
                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Đính kèm:</label>
                            <ul>
                                @php
                                $file = json_decode($notice->file);
                                @endphp
                                @foreach ($file as $f)
                                <li>{{$f}}</li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="form-group">
                            <label for="">Nội dung:</label>
                            <textarea class="form-control" value="{{$notice->content}}" disabled cols="30"
                                rows="15"></textarea>
                        </div>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
@endsection