@extends('master')
@section('title')
Quản lý biểu mẫu
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Quản lý biểu mẫu</p>
            </section>
            <section class="panel-body">
                <section class="header-toolbox">
                    <button id="btnAddNewTemplate" class="btn btn-info btn-sm"><i class="glyphicon-plus"></i> Thêm biểu mẫu</button>
                </section>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                           
                            <th>Tên biểu mẫu</th>
                            <th>Loại số liệu</th>
                            <th>Người tạo</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableTemplate">

                    </tbody>
                </table>
                <section class="paginations">
                    <ul id="paginationTable" class="pagination-md"></ul>
                </section>
            </section>
        </section>
    </section>
</section>
<script type="module" src="{{asset('js/features/template/index.js')}}"></script>

@endsection