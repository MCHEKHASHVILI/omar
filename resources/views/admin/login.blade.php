@extends('layouts.getStarted.app')

@section('title')
Admin Login
@endsection

@section('content')
<form class="col-md-12" method="POST" action="{{route('admin.login')}}">
    <div class="select-box col-md-3 py-5" style="margin: 7rem auto;">
        <div class="get-started">
            <h2>Login</h2>
        </div>
        <br>
       @csrf
        <!-- here success and error message -->
        <div class="alert alert-success" id="successOtpAuth" style="display:none"></div>
        <div class="alert alert-danger" id="error" style="display:none"></div>
        <input type="text" name="tel" placeholder="Username" required>
        <input type="pass" name="password" placeholder="Password" required>


        <!--  here added captcha verifier  -->
        <div id="recaptcha-container"></div>

        <button type="submit" class="verify-btn w-100"> Login now! </button>
    </div>

</form>
@endsection

@section('pageScript')
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
@endsection
