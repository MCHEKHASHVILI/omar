// calling render function
window.onload = function () {
    render();
};

// render function is to append recaptcha
function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container"
    );
    recaptchaVerifier.render();

}

// if mobile number filled and captcha verified then send otp
function sendOTP() {
    let getMobileNumber = $("#countryCode").val() + $("#tel").val();
    var number = getMobileNumber.replaceAll("-", "");

    firebase
        .auth()
        .signInWithPhoneNumber(number, window.recaptchaVerifier)
        .then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            $("#userMobile").text(number);
            $("#successAuth").show();
            $("#successAuth").show();
        })
        .catch(function (error) {

              console.log(error)
            $("#error").text(error.message);
            $("#error").show();
        });
}

// here verifiy the opt rcvd on mobile
function verify() {
    event.preventDefault();
    var code = $("#verificationCode").val();

    $("#successOtpAuth").text("").hide();
    $("#error").text("").hide();

    coderesult
        .confirm(code)
        .then(function (result) {
            var user = result.user;
            var credential = firebase.auth.PhoneAuthProvider.credential(
                coderesult.verificationId,
                code
            );
            callSaveUserDataApi(user.uid, user.phoneNumber);
            $("#successOtpAuth").text("Successful Operation - تمت العملية بنجاح").show();
            location.href = location.origin + "/home";
        })
        .catch(function (error) {
            $("#error").text(error.message).show();
        });
}

firebase.auth().onAuthStateChanged(
    function (user) {
        if (user) {
            // User is signed in.
            var uid = user.uid;
            // Set the cookie
            document.cookie = `uid=${uid}`;
            
        } else {
            // User is signed out.
            console.log("User is signed out.");
            // Clear the cookie if user is not signed in
            document.cookie = `uid=; expires=Thu, 01 Jan 1970 00:00:00 UTC;`;
        }
    },
    function (error) {
        console.log(error);
    }
);
