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
                                <td><button  class="btn btn-sm btn-default"><i class="fas fa-eye "></i> Xem</button></td>
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
            </section>
        </section>
    </section>
</section>

@endsection