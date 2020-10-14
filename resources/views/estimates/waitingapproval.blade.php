@extends('master')
@section('title')
Danh sách dự toán chờ phê duyệt
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Danh sách dự toán chờ phê duyệt</p>
            </section>
            <section class="panel-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên dự toán</th>
                            <th>Loại dự toán</th>
                            <th>Ngày gửi</th>
                            <th>Người gửi</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTableEstimate">

                    </tbody>
                </table>
                <section class="paginations">
                    <ul id="paginationTable" class="pagination-md"></ul>
                </section>
            </section>
        </section>
    </section>
</section>
<script type="module" src="{{asset('js/features/estimates/approval.js')}}"></script>

@endsection