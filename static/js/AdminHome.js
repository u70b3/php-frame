let insert = function (arr, func) {
    let length = arr.length;
    for (let i = 0; i < length; i++) {
        let temp = arr[i];
        func(temp);
    }
};

let showUserInfo = function (res) {
    $('.infoTemplate').hide();
    let users = res['data'];
    insert(users, insertUserInfo);
};
let showUserApply = function (res) {
    $('.infoTemplate').hide();
    let userApplys = res['data'];
    log(userApplys);
    insert(userApplys, insertUserApply);

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
                                <tr><td >id</td>       <td ><span class="table-id">${id}</span></td></tr>
                                <tr><td>用户名</td>     <td>${username}</td></tr>
                                <tr><td>身份证号</td>     <td>${idcard}</td></tr>
                                <tr><td>所属单位</td>     <td>${company}</td></tr>
                            </table>
                            <p>
                                <button class="btn btn-success pass-user" >通过</button>
                                <button class="btn btn-default delete-user">删除</button>
                            </p>
                        </div>
                    </div>
                </div>
            `;
    return t;
};
let UserApplyTemplate = function (userApply) {
    let id = userApply.id;
    let username = userApply.username;
    let idcard = userApply.idcard;
    let MAC = userApply.MAC;
    let company = userApply.company;
    let t = `
                <div class="col-md-6 infoTemplate">
                    <div class="thumbnail">
                        <div class="caption" >
                            <table class="table table-hover table-bordered table-striped">
                                <tr><td >申请编号</td>       <td ><span class="table-id">${id}</span></td></tr>
                                <tr><td>用户名</td>     <td>${username}</td></tr>
                                <tr><td>身份证号</td>     <td>${idcard}</td></tr>
                                <tr><td>所属单位</td>     <td>${company}</td></tr>
                                <tr><td>MAC地址</td>     <td>${MAC}</td></tr>
                            </table>
                            <p>
                                <button class="btn btn-success pass-apply" >通过</button>
                                <!--TODO 11-->
                                <button class="btn btn-default delete-apply">拒绝</button>
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
let insertUserApply = function (userApply) {
    let UserApplyCell = UserApplyTemplate(userApply);
    let UserApplyList = $('.info');
    UserApplyList.append(UserApplyCell);
};
let updateActiveMenu = function (m, className) {
    $('.' + className).removeClass(className);
    m.addClass(className);
};
let showInfo = function (targetType) {
    if (targetType === 'register') {
        getData(showUserInfo, 'show_users');
    } else if (targetType === 'applyMAC') {
        getData(showUserApply, 'show_user_applys');
    }
};
let getData = function (func, ajax_type) {
    $.ajax({
        type: 'GET',
        url: '/controller/RouteController.php',
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
let changeStatus = function (ajax_type, id) {
    $.ajax({
        type: 'GET',
        url: '/controller/RouteController.php',
        data: {
            ajax_type: ajax_type,
            id: id,
        },
        dataType: 'json',
        success: function (res) {
            log('ajax成功');
        },
        error: function (error) {
            log('ajax失败');
        },
    });
};
let sideMenuEvents = function () {
    $('.mysidebar').find('.side-menu').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        let menu = $(this);
        let targetType = menu.attr('data-target');
        showInfo(targetType);
        updateActiveMenu(menu, 'myactive');
    });
};
let passEvent = function () {
    $('.info').on('click', '.infoTemplate .pass-user', function (e) {
        e.preventDefault();
        e.stopPropagation();
        let id = $(this).parents('.infoTemplate').find('.table-id').html();
        // log(id);
        changeStatus('pass_user', id);
        getData(showUserInfo, 'show_users');
    });
};

let passApplyEvent = function () {
    $('.info').on('click', '.infoTemplate .pass-apply', function (e) {
        e.preventDefault();
        e.stopPropagation();
        let id = $(this).parents('.infoTemplate').find('.table-id').html();
        log(id);
        changeStatus('pass_apply', id);
        getData(showUserApply, 'show_user_applys');
    });
};

let deleteApplyEvent = function () {
    $('.info').on('click', '.infoTemplate .delete-apply', function (e) {
        e.preventDefault();
        e.stopPropagation();
        let id = $(this).parents('.infoTemplate').find('.table-id').html();
        // log(id);
        changeStatus('delete_apply', id);
        getData(showUserApply, 'show_user_applys');
    });
};

let deleteUserEvent = function () {
    $('.info').on('click', '.infoTemplate .delete-user', function (e) {
        e.preventDefault();
        e.stopPropagation();
        let id = $(this).parents('.infoTemplate').find('.table-id').html();
        // log(id);
        changeStatus('delete_user', id);
        getData(showUserInfo, 'show_users');
    });
};


let __main = function () {
    getData(showUserInfo, 'show_users');
    sideMenuEvents();
    passEvent();
    passApplyEvent();
    deleteApplyEvent();
    deleteUserEvent();
};
$(document).ready(function () {

    __main();
});
