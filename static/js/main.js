// class="active"
$(document).ready(function () {
    $(".btn-user-login").addClass("btn-primary");
    $(".btn-user-register").click(function (e) {
        e.preventDefault();
        $("form").hide();
        $(".btn").removeClass("btn-primary");

        $(".user-register").show();
        $(".btn-user-register").addClass("btn-primary");
    });
    $(".btn-user-login").click(function (e) {
        e.preventDefault();
        $("form").hide();
        $(".btn").removeClass("btn-primary");

        $(".user-login").show();
        $(".btn-user-login").addClass("btn-primary");
    });
    $(".btn-archives-register").click(function (e) {
        e.preventDefault();
        $("form").hide();
        $(".btn").removeClass("btn-primary");

        $(".archives-register").show();
        $(".btn-archives-register").addClass("btn-primary");
    });
});
