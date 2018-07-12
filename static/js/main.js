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
    $('.btn-user-logout').click(function (e) {
        $.ajax({
            type: 'GET',
            url: '/controller/UserController.php',
            data: {
                type: 'user-logout',
            },
            dataType: 'json',
            success: function (res) {
                if (res.code === 200) {
                    alert(res.msg);
                } else {
                    alert(res.msg);
                }
            },
            error: function (error) {
                log('error');
            },
        });
    });
    $('#username').keyup(function () {    //用户输入一个字符就触发响应
        log('触发用户名ajax校验');
        $.ajax({
            type: 'POST',
            url: '/controller/UserController.php?ajax_type=check_username',
            data: {
                'username': $(this).val(),
            },
            dataType: 'json',
            success: function (res) {
                $("#err_username").html(res['msg']);
            },
            error: function (error) {
                log('ajax失败');
            },
        });
    });
    $('#codeimg').click(function () {
        log('验证码被点击');
        $(this).attr('src', '/midware/Captcha.php?+Math.random()');
    });
});
