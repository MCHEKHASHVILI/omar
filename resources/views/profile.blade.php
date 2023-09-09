@extends('layouts.base')

@section('title')
Profile
@endsection

@php
$getUrl = (Isop::isKeyExists($data, 'profile_img_url') != "" ? $data['profile_img_url'] : "");
$imageSignedUrl = Isop::generateFirebaseMediaUrl($getUrl);
@endphp
@section('content')
<section class="menu-container">

@if(\App::getLocale() == 'ar')
<style>
*{
direction: rtl;
text-align: right
}
</style>
@endif


    <div class="main-accordian">
        <button class="accordion d-flex justify-content-between" data-bs-toggle="modal" data-bs-target="#profileModal">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 py-4 h-100  d-flex flex-column justify-content-center align-items-start">
                <h1>{{trans('messages.profile')}}</h1>
                <span>{{trans('messages.general_information_and_pictures')}}</span>
            </div>
            <div class="col-lg-4 col-md-0 col-sm-0 h-100 d-flex justify-content-end align-items-center">
                <img class="d-sm-none detail_icon" src="{{ asset('public/assets/images/Vector.png') }}" />
            </div>
        </button>
    </div>


    <div class="main-accordian">
        <button class="accordion d-flex justify-content-between" data-bs-toggle="modal" data-bs-target="#subscribeModal">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 py-4 h-100  d-flex flex-column justify-content-center align-items-start">
                <h1>{{trans('messages.subscription')}}</h1>
                <span>{{trans('messages.subscribe_to_get_full_access')}}</span>
            </div>
            <div class="col-lg-4 col-md-0 col-sm-0 h-100 d-flex justify-content-end align-items-center">
                <img class="d-sm-none detail_icon" src="{{ asset('public/assets/images/Vector.png') }}" />
            </div>
        </button>
    </div>
    <div class="main-accordian">
        <button class="accordion d-flex justify-content-between" data-bs-toggle="modal" data-bs-target="#languageModal">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 py-4 h-100  d-flex flex-column justify-content-center align-items-start">
                <h1>{{trans('messages.change_language')}}</h1>
                <span>{{trans('messages.choose_the_language')}}</span>
            </div>
            <div class="col-lg-4 col-md-0 col-sm-0 h-100 d-flex justify-content-end align-items-center">
                <img class="d-sm-none detail_icon" src="{{ asset('public/assets/images/Vector.png') }}" />
            </div>
        </button>
    </div>
    <div class="main-accordian">
        <button class="accordion d-flex justify-content-between" data-bs-toggle="modal" data-bs-target="#mobileModal">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 py-4 h-100  d-flex flex-column justify-content-center align-items-start">
                <h1>{{trans('messages.change_mobile_number')}}</h1>
                <span>{{trans('messages.use_another_mobile')}}</span>
            </div>
            <div class="col-lg-4 col-md-0 col-sm-0 h-100 d-flex justify-content-end align-items-center">
                <img class="d-sm-none detail_icon" src="{{ asset('public/assets/images/Vector.png') }}" />
            </div>
        </button>
    </div>
    <div class="main-accordian">
        <button class="accordion d-flex justify-content-between" data-bs-toggle="modal" data-bs-target="#contactModal">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 py-4 h-100  d-flex flex-column justify-content-center align-items-start">
                <h1>{{trans('messages.contact_us')}}</h1>
                <span>{{trans('messages.any_issue_text')}}</span>
            </div>
            <div class="col-lg-4 col-md-0 col-sm-0 h-100 d-flex justify-content-end align-items-center">
                <img class="d-sm-none detail_icon" src="{{ asset('public/assets/images/Vector.png') }}" />
            </div>
        </button>
    </div>
</section>


<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">

        <div class="modal-content">

            <h1 id="exampleModalToggleLabel">{{trans('messages.profile')}}</h1>
            <p>{{trans('messages.general_information_and_pictures')}}</p>
            <form class="row">
                <div class="col-md-4">
                    <div class="image-upload">
                        <label class="profile-image-wrapper" for="file-input">
                            <img class="rounded-circle" style="margin:auto;width:120px;height:120px;display:block" src="{{ ($imageSignedUrl != '' ? $imageSignedUrl : 'asset(\'public/assets/images/fileinput.png\')') }}" />
                        </label>
                        <input id="file-input" type="file" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="select-box">

                        <!-- <label class="label required" for="first_name">{{trans('messages.first_name')}}</label>
                        <input type="text" name="first_name" placeholder="First Name" id="first_name" required>

                        <label class="label required" for="last_name">{{trans('messages.last_name')}}</label>
                        <input type="text" name="last_name" placeholder="Last Name" id="last_name" required>

                        <label class="label required" for="email">{{trans('messages.email')}}</label>
                        <input type="text" name="email" placeholder="Email" id="email" required>

                        <div class="row">

                            <button type="button" class="verify-btn"> {{trans('messages.save')}}</button>
                            <button type="button" class="ml-3 verify-btn " data-bs-dismiss="modal" aria-label="Close">
                                {{trans('messages.close')}}
                            </button>
                        </div> -->

                        <label class="label required" for="first_name">{{trans('messages.first_name')}}</label>
                        <input type="text" name="first_name" placeholder="First Name" id="first_name" value="{{ $data['first_name']??'' }}" required>
                        <span class="error-message" id="first_name_error"></span>

                        <label class="label required" for="last_name">{{trans('messages.last_name')}}</label>
                        <input type="text" name="last_name" placeholder="Last Name" id="last_name" value="{{ $data['last_name']??'' }}" required>
                        <span class="error-message" id="last_name_error"></span>

                        <label class="label required" for="email">{{trans('messages.email')}}</label>
                        <input type="text" name="email" placeholder="Email" id="email" value="{{ $data['email']??'' }}" required>
                        <span class="error-message" id="email_error"></span>

                        <div class="spinner-border alert alert-primary" role="status" id="spinner">
                            <span class="spinner-text"></span>
                        </div>


                        <!-- HTML -->
                        <!--<div class="alert alert-success" role="" id="success" style="display:none;">
                            <span class="success responseMsg"></span>
                        </div>-->


                        <div class="row">
                            <button type="button" class="verify-btn" disabled> {{trans('messages.save')}}</button>
                            <button type="button" class="ml-3 verify-btn " data-bs-dismiss="modal" aria-label="Close">
                                {{trans('messages.close')}}
                            </button>
                        </div>

                    </div>
                </div>


            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <h1 id="exampleModalToggleLabel">{{trans('messages.subscribe_now')}}</h1>
            <p>{{trans('messages.select_subscription_method')}}</p>
            <form action="#" class="radioo">
                <div>
                    <label for="radio1">
                        <input type="radio" name="paymentMethod" id="radio1">
                        {{trans('messages.pay_with')}} <span>+212 - 72056826</span>
                    </label>
                </div>
                <div id="input-field-container" class="payWithPhone">
                    <p>Choose your mobile service provider</p>
                    <select class="subscribe-radio">
                        <option>Select your mobile network provider.</option>
                        <option>Jazz</option>
                        <option>Zong</option>
                        <option>Telenor</option>
                    </select>
                </div>
                <label for="radio2">
                    <input type="radio" name="paymentMethod" value="2" id="radio2">Apple Pay </label>
                <div id="input-field-container" class="payWithApple">
                    <p class="ml-3">Select a plan and subscribe using your Apple Pay Account </p>
                    <div class="applePay-toggle">
                        <div class="applePay-col1">
                            <label class="card-radio-btn">
                                <input type="radio" name="demo" class="card-input-element d-none" id="demo1" checked="">
                                <div class="card card-body">
                                    <div class="content_head">Weekly</div>
                                    <div class="content_sub">USD 3</div>
                                </div>
                            </label>
                        </div>
                        <div class="applePay-col2">
                            <label class="card-radio-btn">
                                <input type="radio" name="demo" class="card-input-element d-none" id="demo1" checked="">
                                <div class="card card-body">
                                    <div class="content_head">Weekly</div>
                                    <div class="content_sub">USD 3</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <label for="radio3">
                    <input type="radio" name="paymentMethod" value="3" id="radio3">Google Play </label>

                <div id="input-field-container" class="payWithGoogle">
                    <p class="ml-3">Select a plan and subscribe using your Google Pay Account </p>
                    <div class="applePay-toggle">
                        <div class="applePay-col1">
                            <label class="card-radio-btn">
                                <input type="radio" name="demo" class="card-input-element d-none" id="demo1" checked="">
                                <div class="card card-body">
                                    <div class="content_head">Weekly</div>
                                    <div class="content_sub">USD 3</div>
                                </div>
                            </label>
                        </div>
                        <div class="applePay-col2">
                            <label class="card-radio-btn">
                                <input type="radio" name="demo" class="card-input-element d-none" id="demo1" checked="">
                                <div class="card card-body">
                                    <div class="content_head">Weekly</div>
                                    <div class="content_sub">USD 3</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>



            </form>
            <div class="popup-button">
                <button class="text-center">{{trans('messages.start_subscription')}}</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" style="direction:ltr" id="mobileModal" tabindex="-1" aria-labelledby="mobileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center">

                <h1 id="exampleModalToggleLabel">{{trans('messages.change_mobile_number')}}</h1>
            </div>
            <form style="direction:ltr">
                <div class="select-box">
                    <div class="get-started">
                        <p>{{trans('messages.use_another_mobile')}}</p>
                    </div>
                    <!-- here success and error message -->
                    <div class="alert alert-success" id="successOtpAuth" style="display:none"></div>
                    <div class="alert alert-danger" id="error" style="display:none"></div>
                    <span>{{trans('messages.new_mobile_number')}}</span>
                    <div class="selected-option mt-3">
                        <div>
                            <span class="iconify" data-icon="flag:gb-4x3"></span>
                        </div>
                        <input type="countryCode" id="countryCode" readonly>
                        <input type="tel" name="tel" @if(\App::getLocale() == 'ar') style="margin:0" @endif placeholder="Phone Number" maxlength="10" id="tel" required>

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
                    {{-- <div id="recaptcha-container"></div> --}}

                    <div class="d-flex justify-content-center">
                        <button type="button" class="verify-btn" onclick="sendOTP();">{{trans('messages.get_verification_code_for_new_phone')}}</button>
                        <button class="verify-btn1" style="display:none" onclick="verify()"> Verify </button>
                    </div>

                    <div class="options">
                        <input type="text" class="search-box" placeholder="Search Country Name">
                        <ol></ol>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="languageModal" tabindex="-1" aria-labelledby="languageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center">

                <h1 id="exampleModalToggleLabel">{{trans('messages.change_language')}}</h1>
            </div>
            <div class="select-box">
                <div class="get-started text-center">
                    <p>{{trans('messages.choose_the_language')}}</p>
                </div>

                <form action="{{ route('change-language') }}" method="POST" id="language-form">
                    @csrf
                    <select id="language-select" class="subscribe-radio" name="locale">
                        <option value="en" {{ session('locale') === 'en' ? 'selected' : '' }}>English</option>
                        <option value="ar" {{ session('locale') === 'ar' ? 'selected' : '' }}>Arabic</option>
                    </select>
                    
                </form>

                <script>
                    const form = document.getElementById('language-form');
                    const languageSelect = document.getElementById('language-select');

                    languageSelect.addEventListener('change', function() {
                        form.submit();
                    });
                </script>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <h1 id="exampleModalToggleLabel">{{trans('messages.contact_us')}}</h1>
            <p>{{trans('messages.any_issue_text')}}</p>
            <form>
                <label class="label required" for="message">{{trans('messages.your_message_to_us')}}</label>
                <textarea name="message" rows="4" placeholder="{{trans('messages.your_message')}}" id="message" required></textarea>
                <div class="d-flex justify-content-center">
                    <button type="button" class="verify-btn">{{trans('messages.send')}}</button>
                </div>


            </form>
        </div>
    </div>
</div>



@endsection

@section('pageScript')
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<script src="{{ asset('public/assets/js/script.js') }}"></script>
<script src="{{ asset('public/assets/js/countryCodesAndFlags.js') }}"></script>
<script src="{{ asset('public/assets/js/Modaljs.js') }}"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<!--<script src="{{ asset('public/assets/js/firebaseConfig.js?ver=' . time()) }}"></script>-->

<script>

    function changeLanguage() {
        var languageSelect = document.getElementById("language-select");
        var selectedLanguage = languageSelect.value;

        // Update the lang attribute in the HTML tag
        document.documentElement.lang = selectedLanguage;
        // Reload the page
        // location.reload();
    }

    $(document).ready(function() {
        // here check whether the user is logged in or not!

        let firstName = $("#first_name");
        let lastName = $("#last_name");
        let email = $("#email");
        let verifyButton = $(".verify-btn");
        let spinner = $("#spinner");
        let emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var uid = "";

        function validateFields() {
            let isValid = true;

            if (!firstName.val()) {
                $("#first_name_error").text("First name is required");
                isValid = false;
            } else {
                $("#first_name_error").text("");
            }

            if (!lastName.val()) {
                $("#last_name_error").text("Last name is required");
                isValid = false;
            } else {
                $("#last_name_error").text("");
            }

            if (!email.val() || !emailReg.test(email.val())) {
                $("#email_error").text("Please enter a valid email");
                isValid = false;
            } else {
                $("#email_error").text("");
            }

            verifyButton.prop("disabled", !isValid);
        }

        firstName.on("input", validateFields);
        lastName.on("input", validateFields);
        email.on("input", validateFields);
const firebaseConfig = {
  apiKey: "AIzaSyBAEGVbb-VPqcBRGAArzlYeZ5SSK75ghgs",
  authDomain: "stagintfitbite.firebaseapp.com",
  databaseURL: "https://stagintfitbite-default-rtdb.firebaseio.com",
  projectId: "stagintfitbite",
  storageBucket: "stagintfitbite.appspot.com",
  messagingSenderId: "917079452548",
  appId: "1:917079452548:web:f4a5e134c2d88fbbfa4bd1",
  measurementId: "G-HVTB8H34K8"
};
firebase.initializeApp(firebaseConfig);

        firebase.auth().onAuthStateChanged((user) => {
            if (user) {
                uid = user.uid;
                // ...
            console.log('workd')
            } else {
                // redirect to home page
                console.log("not signed in");
                // User is not signed in
            }
        });

        verifyButton.click(function() {
            spinner.show();
console.log('worked')

            $.ajax({
                url: "/user/update", // replace this with your Laravel route
                type: "POST",
                data: {
                    first_name: firstName.val(),
                    last_name: lastName.val(),
                    email: email.val(),
                    uid: uid,
                    _token: "{{ csrf_token() }}", // for CSRF protection in Laravel
                },
                // What to do before sending the post request
                beforeSend: function() {
                    $(".responseMsg").text();
                    // Show the spinner
                    $("#spinner").show();
                    $(".spinner-text").text("{{__('messages.uploading')}}");
                },

                success: function(response) {
                    spinner.hide();

                    // Parse the JSON response
                    var jsonResponse = JSON.parse(response);
                    // If the update was successful, display the success message
                    if (jsonResponse.success) {
                        $("#success").show();
                        $(".responseMsg").text(jsonResponse.msg);
                        $(".first_name").text(firstName.val());
                    } else {
                        // Otherwise, you might want to show an error message
                        alert(jsonResponse.msg);
                    }
                },
                error: function(xhr) {
                    spinner.hide();
                    alert("An error occurred. Please try again.");
                    // add code here to handle errors
                },
                complete: function() {
                    // Hide the spinner
                    $("#spinner").hide();
                    $(".spinner-text").text("");
                },
            });
        });
    });

    $("#file-input").on("change", function(e) {
        var file = e.target.files[0];

        var formData = new FormData();
        formData.append("file", file);
        formData.append("_token", "{{ csrf_token() }}"); // include the CSRF token

        $.ajax({
            url: "/user/upload-profile-image", // Update this with the correct route
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            // What to do before sending the post request
            beforeSend: function() {
                $(".responseMsg").text("");
                // Add the blur effect to the file input
                $("#file-input").css("filter", "blur(5px)");
                // Show the spinner
                $("#spinner").show();
                $(".spinner-text").text("Uploading....");
            },
            success: function(data) {
                $(".profile-image").attr("src", data.imageUrl); // set the uploaded image to the img tag
                // Remove the blur effect from the file input
                $("#file-input").css("filter", "");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ": " + errorThrown);
                $("#file-input").css("filter", "");
            },
            // handle complete response (in case of both success and error)
            complete: function() {
                // Remove the blur effect from the file input
                $("#file-input").css("filter", "");
                // Hide the spinner
                $("#spinner").hide();
                $(".spinner-text").text("");
            },
        });
    });
</script>


@endsection
