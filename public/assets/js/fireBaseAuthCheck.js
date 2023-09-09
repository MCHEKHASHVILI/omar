firebase.auth().onAuthStateChanged(function (user) {
    if (!user) {
        // User is signed in.
        // var uid = user.uid;

        // Check if the current URL is allowed
        var allowedPages = [
            getBaseUrl(),
            getBaseUrl() + "/",
            getBaseUrl() + "/home",
        ];
        var currentUrl = window.location.href;

        if (!allowedPages.includes(currentUrl)) {
            // Redirect to the home page or default page
            window.location.href = getBaseUrl() + "public/home";
        }
    }
});

function getBaseUrl() {
    var baseUrl = window.location.protocol + "//" + window.location.hostname;
    if (window.location.port) {
        baseUrl += ":" + window.location.port;
    }
    return baseUrl;
}


firebase.auth().onAuthStateChanged(function (user) {
    var allowedPages = [
        getBaseUrl(),
        getBaseUrl() + "",
        getBaseUrl() + "/home",
    ];
    var currentUrl = window.location.href;

    if (user) {
        // User is signed in.
        if (!allowedPages.includes(currentUrl)) {
            // Redirect to the home page or default page
            window.location.href = getBaseUrl() + "/home";
        }
    } else {
        // User is not signed in
        if (currentUrl !== getBaseUrl() + "/home") {
            // Redirect to the home page or default page
             window.location.href = getBaseUrl() + "/home";
        }
    }
});

function getBaseUrl() {
    var baseUrl = window.location.protocol + "//" + window.location.hostname;
    if (window.location.port) {
        baseUrl += ":" + window.location.port;
    }
     console.log(window.location.protocol + "//" + window.location.hostname)
    return baseUrl;
}
