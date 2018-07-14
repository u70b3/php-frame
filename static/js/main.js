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
            url: '/controller/RouteController.php',
            data: {
                ajax_type: 'user_logout',
            },
            dataType: 'json',
            success: function (res) {
                if (res.code === 200) {
                    window.location.href = "/index.html";
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
            url: '/controller/RouteController.php?type=check_username',
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
    $('#confirm').blur(function () {    //确认密码检测
        let val = $('#password').val();
        log('触发密码校验', val);
        if (val !== '') {
            if ($(this).val() === '') {
                $('#dis_con_pwd').text('请输入您的密码');
                pwdFlag = false;
            } else if ($(this).val() !== val) {
                $('#dis_con_pwd').text('请确认您的密码');
                pwdFlag = false;
            } else {
                $('#dis_con_pwd').text('');
                pwdFlag = true;
            }
        } else {
            $('#dis_con_pwd').text('');
            pwdFlag = false;
        }
    });
});
//TODO 注册失败这里要优雅一点
//TODO 登陆失败也要给出提示
