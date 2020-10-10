@extends('blankpage');
@section('title')
Đăng nhập
@endsection
@section('content')
<style>
    #login-box {
        margin: 0 auto;
        position: absolute;
        top: 80px;
        left: 24%;
        text-align: center;
    }

    body {
        background-image: url("../public/images/loginimage.png") !important;
        background-repeat: no-repeat;
    }

    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #d60f3a;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        margin: 0 auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .spinner {
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
</style>
<div class="simple-page-wrap">

    <div class="simple-page-form animated flipInY" id="login-form">
        <div class="row">
            <div id="login-box" class="col-md-6 col-sm-6">
                <h4 class="form-title m-b-xl text-center">
                    Đăng nhập hệ thống
                </h4>
                <form action="#">
                    <div class="form-group">
                        <input id="username" type="text" class="form-control" placeholder="Nhập tên đăng nhập" />
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control" placeholder="Nhập mật khẩu" />
                    </div>
                    <div class="spinner hidden">
                        <div class="loader"></div>
                        <p>Đang kiểm tra vui lòng đợi</p>
                    </div>
                    <input type="button" id="btnLogin" class="btn btn-primary" value="ĐĂNG NHẬP" />
                </form>
            </div>
        </div>
    </div>

</div>
<script type="module" src="{{asset('js/features/login/index.js')}}"></script>

@endsection