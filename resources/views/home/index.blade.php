@extends('master')
@section('title')
Trang chủ
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-header">
                <p class="panel-title">Thông báo</p>
            </section>
            <section class="panel-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Người gửi</th>
                            <th>Ngày gửi</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableNotice">

                    </tbody>
                </table>
                <section class="paginations">
                    <ul id="paginationTable" class="pagination-lg"></ul>
                </section>
            </section>
        </section>
    </section>
</section>
<script type="module" src="{{asset('js/features/home/index.js')}}"></script>

@endsection