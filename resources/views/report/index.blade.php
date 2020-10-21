@extends('master')
@section('title')
Danh sách dự toán
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Danh sách dự toán</p>
            </section>
            <section class="panel-body">
                <div class="header-toolbox">
                    <a href="/report/add" class="btn btn-info btn-sm"><i class="fas fa-plus fa-sm fa-fw"></i> Lập
                        báo cáo</a>
                </div>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên báo cáo</th>
                            <th>Loại báo cáo</th>
                            <th>Ngày tạo</th>
                            <th>Người tạo</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableReport">

                    </tbody>
                </table>
                <section class="paginations">
                    <ul id="paginationTable" class="pagination-md"></ul>
                </section>
            </section>
        </section>
    </section>
</section>

<script type="module" src="{{asset('js/features/reports/index.js')}}"></script>

@endsection