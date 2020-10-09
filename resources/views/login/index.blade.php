@extends('master');
@section('title')
Đăng nhập
@endsection
@section('content')
<div id="back-to-home">
    <a href="index.html" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
</div>
<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html"><span><i class="fa fa-gg"></i></span>
            <span>Infinity</span></a>
    </div>
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">
            Sign In With Your Infinity Account
        </h4>
        <form action="#">
            <div class="form-group">
                <input id="sign-in-email" type="email" class="form-control" placeholder="Email" />
            </div>
            <div class="form-group">
                <input id="sign-in-password" type="password" class="form-control" placeholder="Password" />
            </div>
            <div class="form-group m-b-xl">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox" id="keep_me_logged_in" /><label for="keep_me_logged_in">Keep me signed
                        in</label>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="SING IN" />
        </form>
    </div>
    <div class="simple-page-footer">
        <p><a href="password-forget.html">FORGOT YOUR PASSWORD ?</a></p>
        <p>
            <small>Don't have an account ?</small>
            <a href="signup.html">CREATE AN ACCOUNT</a>
        </p>
    </div>
</div>
@endsection