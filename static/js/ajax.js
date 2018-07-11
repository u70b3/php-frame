$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '/controller/UserController.php',
        data: {
            ajax_type: 'show_users',
        },
        dataType: 'json',
        success: function (res) {
            showUserInfo(res);
            //已经是parse过的了
        },
        error: function (error) {
            console.log('error');
        },
    });
    let showUserInfo = function (res) {
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
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <div class="caption" >
                                <table class="table table-hover table-bordered table-striped">
                                
                                    <tr><td>id</td>     <td>${id}</td></tr>
                                    <tr><td>用户名</td>     <td>${username}</td></tr>
                                    <tr><td>身份证号</td>     <td>${idcard}</td></tr>
                                    <tr><td>所属单位</td>     <td>${company}</td></tr>
                                </table>
                                <p>
                                    <a href="#" class="btn btn-success" role="button">通过</a>
                                    <a href="#" class="btn btn-default" role="button">再看看</a>
                                </p>
                            </div>
                        </div>
                    </div>
                `;
        return t;
    };
    let insertUserInfo = function (user) {
        let UserInfoCell = UserInfoTemplate(user);
        let UserInfoList = $('.row');
        UserInfoList.append(UserInfoCell);
    };
});
