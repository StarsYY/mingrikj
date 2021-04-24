<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>明日科技有限公司</title>
    <link href="assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="assets/css/container.css" rel="stylesheet" type="text/css">
    <link href="assets/css/reset.css" rel="stylesheet" type="text/css">
    <link href="assets/css/screen.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/tab.js"></script>
    <script src="/admin/assets/js/admin.js"></script>
</head>

<body>
<!--头部-->
<div class="header_bg">
    <div class="wrap">
        <div class="header">
            <div class="logo">
                <a href="/"><img src="/front/assets/img/logo.png" alt=""></a>
            </div>
            <div class="pull-icon">
                <a id="pull"></a>
            </div>
            <div class="cssmenu">
                <ul>
                    <li><a href="/">首页</a></li>
                    <li><a href="/front/about">企业简介</a></li>
                    <li><a href="/front/news">新闻</a></li>
                    <li><a href="/front/core">核心竞争力</a></li>
                    <li class="last"><a href="/front/contact">联系我们</a></li>
                </ul>
            </div>
            <!--清除浮动-->
            <div class="clear"></div>
        </div>
    </div>
</div>
<!--头部-->
<!--banner-->
<div class="second_banner"><img src="assets/img/5.gif" alt=""></div>
<!--//banner-->

<!--联系我们-->
<div class="container">
    <div class="left">
        <div class="menu_plan">
            <div class="menu_title">
                联系我们 <br> <span>Associate program</span>
            </div>
            <ul id="tab">
                <li onclick="changeValue(this)" class="active"><a href="#">联系我们</a></li>
            </ul>
        </div>
    </div>
    <div class="right">
        <div class="location">
            <span>当前位置：<a href="#">联系我们</a></span>
            <div class="brief" id="b">
                <a href="#">联系我们</a>
            </div>
        </div>
        <div style="font-size: 14px; margin-top: 53px; line-height: 36px;">
            <div id="tab_con">
                <div id="tab_con_4" class="dis-n" style="display: block;">
                    <table class="contact">
                        <tbody>
                        <tr>
                            <td width="18%" class="ct_bg">公司名称</td>
                            <td>明日科技有限公司</td>
                        </tr>
                        <tr>
                            <td class="ct_bg">联系人</td>
                            <td>张女士、王先生</td>
                        </tr>
                        <tr>
                            <td class="ct_bg">电话</td>
                            <td>0431-xxxxxxxx</td>
                        </tr>
                        <tr>
                            <td class="ct_bg">手机</td>
                            <td>151xxxxxxx</td>
                        </tr>
                        <tr>
                            <td class="ct_bg">邮箱</td>
                            <td>xxxxxxx@163.net</td>
                        </tr>
                        <tr>
                            <td class="ct_bg">地址</td>
                            <td>长春市卫星广场财富大厦1023室</td>
                        </tr>
                        <tr>
                            <td class="ct_bg">邮编</td>
                            <td>130000</td>
                        </tr>
                        <tr>
                            <td class="ct_bg">公司主页</td>
                            <td>www.mingrisoft.com</td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        <img src="img/map.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//联系我们-->
<!--页面底部开始-->
<div class="bottom">
    <div class="footer">
        <div class="gulid">
            <p>Copyright 2016 明日科技有限公司 All Rights.</p>
            <p>
                <a href="http://www.mingrisoft.com">明日科技</a> 技术支持
                <a href="/login">后台</a>
            </p>
            <p>吉ICP备 10002740号-2 吉公网安备22010202000132号</p>
        </div>
    </div>
</div>
<!--页面底部结束-->
</body>
<script>
    tabs("#tab", "active", "#tab_con");
</script>
</html>
