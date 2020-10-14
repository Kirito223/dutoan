@extends('master')
@section('title')
Lập dự toán
@endsection
@section('content')
<section class="row">
    <section class="col-md-12 col-xs-12">
        <section class="panel panel-default">
            <section class="panel-heading">
                <p class="panel-title">Lập dự toán</p>
            </section>
            <section class="panel-body">
                <section class="row">
                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Tên dự toán</label>
                            <input type="text" class="form-control" name="" id="name" placeholder="">

                        </div>

                    </section>

                    <section class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="">Đơn vị báo cáo:</label>
                            @php

                            @endphp
                            <input disabled data-department="{{$idDepartment}}" value="{{$nameDepartment}}" type="text"
                                class="form-control" name="" id="department" placeholder="">
                        </div>
                    </section>

                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Thời gian</label>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="time" id="precious" value="1">
                                    Quý
                                </label>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="time" id="month" value="2">
                                    Tháng
                                </label>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="time" id="year" value="3">
                                    Năm
                                </label>
                            </div>
                        </div>
                    </section>
                    <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Biểu mẫu báo cáo</label>
                            <select id="template" class="form-control"></select>
                        </div>
                    </section>
                    {{-- <section class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="">Đính kèm:</label>
                            <input type="text" class="form-control" name="" id="" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung:</label>
                            <textarea class="form-control" cols="30" rows="15"></textarea>
                        </div>
                    </section> --}}

                </section>
                <section class=" row">
                    <section class="col-md-12 col-xl-12">
                        <table id="tableEvaluation" class="table table-bordered table-inverse ">
                            <thead class="thead-default">
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Đơn vị</th>
                                    <th>Giá trị</th>
                                </tr>
                            </thead>
                            <tbody id="BodyEvaluation">

                            </tbody>
                        </table>
                    </section>
                    <section class="col-md-12 col-xl-12">
                        <section class="toolbox">
                            <button id="btnSave" class="btn btn-primary btn-sm">Lưu dự toán</button>
                            
                        </section>
                    </section>
                </section>

            </section>
        </section>
    </section>
</section>

<script type="module" src="{{asset('js/features/estimates/index.js')}}"></script>
@endsection