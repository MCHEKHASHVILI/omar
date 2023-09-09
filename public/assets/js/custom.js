function callSaveUserDataApi(uid, phoneNumber) {
    // console.log(user.uid + " Moible " + user.phoneNumber);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
        },
    });
    var type = "POST";
    var ajaxurl = "/user/store";
    $.ajax({
        type: type,
        url: ajaxurl,
        data: { uid: uid, phoneNumber: phoneNumber },
        dataType: "json",
        beforeSend: function () {
            $(".loader").show();
        },
        success: function (data) {
            // console.log(data);
            // if (data.success) {
            window.location.href = "/home";
            // }
        },
        error: function (data) {
            console.log(data);
        },
    });
}
