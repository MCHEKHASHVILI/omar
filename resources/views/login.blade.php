
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
    <title>{{ config('app.name', 'FitBite') }} | @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{asset('assets/css/style1.css')}}">
    
    @yield('pageStyle')
</head>
<body>
    <div class="col-md-12 px-5 py-2 d-flex justify-content-between bg-white">
        <div class="d-flex align-items-center">

            <img src="{{ asset('assets/images/logo.png') }}" class="header-img" alt="FitBite" style="height: 50px;" />
        </div>
        <div class="side-header d-flex align-items-center">
            <img src="{{ asset('assets/images/mask-group.png') }}" class="side-header-img mr-3">
            <p>العربية</p>
        </div>
    </div>

  

    <form class="col-md-12">
        <div class="select-box col-md-3 py-5" style="margin: 7rem auto;">
            <div class="get-started">
                <h2>Get Started</h2>
                <p>Please enter your mobile number to get access.</p>
            </div>
            <!-- here success and error message -->
            <div class="alert alert-success" id="successOtpAuth" style="display:none"></div>
            <div class="alert alert-danger" id="error" style="display:none"></div>
            <p>Mobile Number</p>
            <div class="selected-option">
                <div>
                    <span class="iconify" data-icon="flag:gb-4x3"></span>
                </div>
                <input type="countryCode" id="countryCode" readonly>
                <input type="tel" name="tel" placeholder="Phone Number" maxlength="10" id="tel" required>
            </div>
    
            <div class="verification-div" style="display: none ;">
                <p>Please enter the verification code sent to <span id="userMobile"></span></p>
                <div id="time"></div>
                <div id="resendCode" style="display:none;"><a href="">RESEND CODE</a></div>
                <div class="verif-input">
                    <input type="text" id="verificationCode" name="verificationCode" placeholder="Enter the Verification code" class="verification-input" maxlength="6" />
                </div>
            </div>
    
            <!--  here added captcha verifier  -->
            <div id="recaptcha-container"></div>
    
            <button type="button" class="verify-btn w-100" onclick="sendOTP();"> Get Verification Code </button>
            <button class="verify-btn1 w-100" style="display:none" onclick="verify()"> Verify </button>
            <div class="options">
                <input type="text" class="search-box" placeholder="Search Country Name">
                <ol></ol>
            </div>
    
        </div>
    
    </form>

    <div class="footer row col-md-12 d-flex justify-content-between">
        <div class="w-100">
            
            <p style="text-align: center">Copyright © 2023 FitBite - All Rights Reserved</p>
        </div>
    </div>

  
</body>

  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> --}}

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  
  <script type="text/javascript" src="{{ asset('assets/js/firebase.js') }}"></script>

  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/countryCodesAndFlags.js') }}"></script>
  <script src="{{ asset('assets/js/Modaljs.js') }}"></script>  <script src="{{asset('assets/js/sidebar.js')}}"></script>
</html>
