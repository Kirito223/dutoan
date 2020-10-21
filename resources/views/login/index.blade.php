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

    .title-login {
        color: #ffffff;
    }

    body {
        background-image: url("../images/bglogin.jpg") !important;
    }

    .copyright {
        margin-top: 10px;
    }

    .m-0 {
        color: white;
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
                <h4 class="form-title m-b-xl text-center title-login">
                    ĐĂNG NHẬP HỆ THỐNG
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
                        <p style="color: #ffffff;">Đang kiểm tra vui lòng đợi</p>
                    </div>
                    <input type="button" id="btnLogin" class="btn btn-primary" value="ĐĂNG NHẬP" />
                </form>
                <div class="bg-blue py-4 fluid-container copyright">
                    <div class="row px-3">
                        <div class="col-12 justify-content-center row m-0 p-0">
                            <p class="m-0">Bản quyền thuộc về: Công ty TNHH Ứng Dụng và Triển Khai Phần
                                Mềm Lihanet
                            </p>
                        </div>
                        <div class="col-12 justify-content-center row m-0 p-0">
                            <p class="m-0">Địa chỉ: Lô 29 Hoa Lư Nối Dài - P.Đống Đa - Tp Quy Nhơn - Tình Bình Định
                            </p>
                        </div>
                        <div class="col-12 justify-content-center row m-0 p-0">
                            <p class="m-0">Điện thoại: (0256) 6.555.678 - Email: <a
                                    href="mailto:lihanet@gmail.com">lihanet@gmail.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="module" src="{{asset('js/features/login/index.js')}}"></script>

@endsection