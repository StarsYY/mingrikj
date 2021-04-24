<!DOCTYPE html>
<html>
<head lang="en"><meta charset="UTF-8">
    <title>Login Page | Amaze UI Example</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="/admin/assets/i/favicon.png">
    <link rel="stylesheet" href="/admin/assets/css/amazeui.min.css" />
    <script src="/admin/assets/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>

    <style>
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }
        .header p {
            font-size: 14px;
        }
    </style>
    <script type="text/javascript" src="/admin/assets/js/admin.js"></script>
    <script src="/admin/assets/js/amazeui.min.js"></script>
    <script src="/admin/assets/js/jquery.cookie.js"></script></head>
<body>
<div class="header">
    <div class="am-g">
        <h1>Web ide</h1>
        <p>Integrated Development Environment<br/>代码编辑，代码生成，界面设计，调试，编译</p>
    </div>
    <hr />
</div>
<div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <h3>登录</h3>
        <hr>
        <div class="am-btn-group"></div>
        <br>
        <br>

        <form class="am-form">
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
            <label for="email">用户名:</label>
            <input type="text" name="username" id="username">
            <br>
            <label for="password">密码:</label>
            <input type="password" name="password" id="password">
            <br>
            <label for="remember-me">
                <input id="remember-me" type="checkbox">
                记住密码
            </label>
            <br />
            <div class="am-cf">
                <input type="button" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl" onclick="login()">
                <input type="button" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
            </div>
        </form>
        <hr>
        <p>© 2014 AllMobilize, Inc. Licensed under MIT license.{{$_SERVER['REMOTE_ADDR']}}</p>
    </div>
</div>
</body>
</html>
