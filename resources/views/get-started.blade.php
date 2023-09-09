@extends('layouts.getStarted.app')

@section('title')
Get Started
@endsection

@section('content')


<form class="col-lg-12">
    <div class="select-box col-lg-4 py-5" style="margin: 7rem auto;direction:ltr;">
        <div class="get-started text-center">
            <h2>{{trans('messages.get_started')}}</h2>
            <p>{{trans('messages.enter_your_mobile_to_get_access')}}</p>
        </div>
        <!-- here success and error message -->
        <div class="alert alert-success" id="successOtpAuth" style="display:none">{{trans('successfull_operation')}}</div>
        <div class="alert alert-danger" id="error" style="display:none"></div>
        <!--<p @if(\App::getLocale() == 'ar')style="text-align: right"@endif>
            {{trans('messages.mobile_number')}}
        </p>-->
        <div class="selected-option" style="justify-content:center">
            <div>
                <span class="iconify" data-icon="flag:gb-4x3"></span>
            </div>
             <input type="countryCode" id="countryCode" readOnly>
            <input type="tel" name="tel" @if(app()->getLocale() == 'ar') style="direction:rtl"  @endif placeholder="{{trans('messages.phone_number')}}" maxlength="10" id="tel" required>
        </div>

        <div class="verification-div" style="display: none ;">
            <p @if(app()->getLocale() == 'ar')style="text-align: right"@endif>{{trans('messages.enter_verification_code_sent_to')}} <span id="userMobile"></span></p>
            <div id="time"></div>
            <div id="resendCode" style="display:none;"><a href="">{{trans('messages.resend_code')}}</a></div>
            <div class="verif-input">
                <input type="text" id="verificationCode" name="verificationCode" placeholder="{{trans('messages.enter_the_verification_code')}}" class="verification-input" maxlength="6" />
            </div>
        </div>

        <!--  here added captcha verifier  -->
        <div id="recaptcha-container"></div>

        <button type="button" class="verify-btn w-100" onclick="sendOTP();"> {{trans('messages.get_verification_code')}} </button>
        <button class="verify-btn1" style="display:none" onclick="verify()"> {{trans('messages.verify')}} </button>
        <div class="options">
            <input type="text" class="search-box" @if(app()->getLocale() == 'ar') style="direction:rtl"  @endif placeholder="{{trans('messages.search_country')}}">
            <ol></ol>
        </div>

    </div>

</form>
@endsection

@section('pageScript')
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script type="text/javascript" src="{{ asset('public/assets/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/firebaseConfig.js?ver=') . time() }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/firebase.js?ver=') . time() }}"></script>
@endsection
