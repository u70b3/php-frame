
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="/static/css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="/static/css/style.css">
    <link type="text/css" rel="stylesheet" href="/static/css/fileinput.css">
    <link rel="icon" href="/static/icons/lbs.ico" type="image/x-icon"/>
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.js"></script>
    <script src="/static/js/fileinput.js"></script>
    <script src="/static/js/fileinput_locale_zh.js"></script>
    <script src="/static/js/main.js"></script>
    <title>
        登陆
    </title>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li role="presentation">
                <button class="btn btn-user-register">专业单位注册
            </li>
            <li role="presentation">
                <button class="btn btn-user-login">专业单位登陆
            </li>
            <li role="presentation">
                <a class="btn" role="button" href="/controller/UserController.php?type=user-logout">登出</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <form class="form-horizontal user-register" method="post"
          action="/controller/UserController.php?type=user-register">
        <div class="form-group">
            <label class="col-sm-2 control-label">账号</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="请输入账号" name="username">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" placeholder="请输入密码" name="password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">证件号码</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="请输入证件号码" name="idcard">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" class="btn btn-warning">注册</button>
            </div>
        </div>
    </form>
    <form class="form-horizontal user-login" method="post" action="/controller/UserController.php?type=user-login">
        <div class="form-group">
            <label class="col-sm-2 control-label">账号</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="请输入账号" name="username">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" placeholder="请输入密码"  name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" class="btn btn-primary">登陆</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
