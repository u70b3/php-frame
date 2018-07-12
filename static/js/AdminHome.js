$(document).ready(function () {

    let showUserInfo = function (res) {
        $('.infoTemplate').hide();
        let users = res['data'];
        for (let i = 0; i < users.length; i++) {
            let user = users[i];
            insertUserInfo(user);
        }
    };
    let UserInfoTemplate = function (user) {
        let id = user.id;
        let username = user.username;
        let idcard = user.idcard;
        let company = user.company;
        let t = `
                    <div class="col-md-4 infoTemplate">
                        <div class="thumbnail">
                            <div class="caption" >
                                <table class="table table-hover table-bordered table-striped">
                                    <tr><td>id</td>     <td>${id}</td></tr>
                                    <tr><td>用户名</td>     <td>${username}</td></tr>
                                    <tr><td>身份证号</td>     <td>${idcard}</td></tr>
                                    <tr><td>所属单位</td>     <td>${company}</td></tr>
                                </table>
                                <p>
                                    <a href="/controller/UserController.php?type=admin-pass&id=${id}" class="btn btn-success" role="button">通过</a>
                                    <a href="/controller/UserController.php?type=admin-delete&id=${id}" class="btn btn-default" role="button">删除</a>
                                </p>
                            </div>
                        </div>
                    </div>
                `;
        return t;
    };
    let insertUserInfo = function (user) {
        let UserInfoCell = UserInfoTemplate(user);
        let UserInfoList = $('.info');
        UserInfoList.append(UserInfoCell);
    };

    let mysidebar = $('.mysidebar');
    mysidebar.find('.side-menu').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        let menu = $(this);
        let targetType = menu.attr('data-target');
        showInfo(targetType);
        updateActiveMenu(menu, 'myactive');
    });
    let updateActiveMenu = function (m, className) {
        $('.' + className).removeClass(className);
        m.addClass(className);
    };
    let showInfo = function (targetType) {
        if (targetType === 'register') {
            getData(showUserInfo, 'show_users');
        } else if (targetType === 'applyMAC') {

        }
    };
    let getData = function (func, ajax_type) {
        $.ajax({
            type: 'GET',
            url: '/controller/UserController.php',
            data: {
                ajax_type: ajax_type,
            },
            dataType: 'json',
            success: function (res) {
                func(res);
            },
            error: function (error) {
                console.log('error');
            },
        });
    };
});
