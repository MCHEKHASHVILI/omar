const radioButtons = document.getElementsByName("paymentMethod");
const divs = [
    document.querySelector(".payWithPhone"),
    document.querySelector(".payWithApple"),
    document.querySelector(".payWithGoogle"),
];

radioButtons.forEach((radioButton, index) => {
    radioButton.addEventListener("change", () => {
        divs.forEach((div, i) => {
            if (i === index) {
                div.style.display = "block"; // Show the corresponding div
            } else {
                div.style.display = "none"; // Hide other divs
            }
        });
    });
});

window.onload = function () {
    var inputIds = ["verificationCode", "reVerificationCode", "tel"];
    inputIds.forEach(function (inputId) {
        var numberInput = document.getElementById(inputId);

        if (numberInput) {
            // Check if element with ID exists
            numberInput.addEventListener("input", function () {
                this.value = this.value.replace(/[^0-9]/g, ""); // Remove any non-numeric characters
            });
        }
    });
};

// Get the phone input element
const phoneInput = document.getElementById("tel");

// Add event listener for input changes
phoneInput.addEventListener("input", formatPhoneNumber);

function formatPhoneNumber() {
  // Remove any non-digit characters from the input value
  let phoneNumber = phoneInput.value.replace(/\D/g, "");

  // Define the desired phone number format
  const phoneNumberFormat = "XXXX-XXXX-XXX";

  // Check if the phone number has the correct format
  const isValidFormat = phoneNumber.length === phoneNumberFormat.length;

  // Format the phone number without the country code
  if (isValidFormat) {
    const formattedPhoneNumber = phoneNumberFormat.replace(/X/g, () => phoneNumber.charAt(0));
    phoneInput.value = formattedPhoneNumber;
  } else {
    phoneInput.value = phoneNumber;
  }
}


//CLick on button to appear OTP field

var showButton = document.querySelector(".verify-btn");
var myDiv = document.querySelector(".verification-div");
var resendCodeDiv = document.querySelector("#resendCode");
var verifyButton = document.querySelector(".verify-btn1");

// Add click event listener to the button
showButton.addEventListener("click", function () {
    showButton.style.display = "none";
    verifyButton.style.display = "block";
    // Show the div by removing the 'display: none' style
        myDiv.style.display = "block";
        var fiveMinutes = 60 * 0.1,
            display = document.querySelector("#time");
        startTimer(fiveMinutes, display, function () {
            // Timer has ended, show another div here
            display.style.display = "none"; // Hide the time div
            resendCodeDiv.style.display = "block"; // Show the resendCode div
        });
});

function startTimer(duration, display, callback) {
    var timer = duration,
        minutes,
        seconds;
    var interval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = "(" + minutes + ":" + seconds + ")";

        if (--timer < 0) {
            clearInterval(interval); // Clear the interval
            display.textContent = "(00:00)"; // Set display to 00:00
            if (typeof callback === "function") {
                callback(); // Invoke the callback function if provided
            }
        }
    }, 1000);
}
