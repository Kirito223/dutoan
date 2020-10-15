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

                        @if (count($listTo) > 0)
                        <div class="form-group">
                            <label for="">Đơn vị nhận</label>
                            <ul>
                                @foreach ($listTo as $item)
                                <li>{{$item}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                    </section>
                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Đính kèm:</label>
                            <ul>
                                @php
                                if ($notice->file != null) {
                                $file = json_decode($notice->file);
                                }else {
                                $file = [];
                                }

                                @endphp
                                @foreach ($file as $f)
                                <li><a class="downloadFile" data-file="{{$f}}">{{$f}}</a></li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="form-group">
                            <label for="">Nội dung:</label>
                            <textarea class="form-control" disabled cols="30" rows="15">
                                {{$notice->content}}</textarea>
                        </div>

                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<script type="module" src="{{asset('js/features/notice/viewNotice.js')}}"></script>

@endsection