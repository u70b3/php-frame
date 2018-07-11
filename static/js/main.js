// class="active"
let log = function () {
    console.log.apply(console, arguments)
};
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
    $('#username').keyup(function () {    //用户输入一个字符就触发响应
        $.ajax({
            type: 'POST',
            url: '/controller/UserController.php?ajax_type=check_username',
            data: {
                'username': $(this).val(),
            },
            dataType: 'json',
            success: function (res) {
                log(res);
                $("#err_username").html(res['msg']);
            },
            error: function (error) {
                log('error');
            },
        });
    });
});
