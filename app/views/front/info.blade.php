<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Sidebar | Amaze UI Example</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="/admin/assets/i/favicon.png">
    <link rel="stylesheet" href="/admin/assets/css/amazeui.min.css"/>
    <style>
        @media only screen and (min-width: 641px) {
            .am-offcanvas {
                display: block;
                position: static;
                background: none;
            }

            .am-offcanvas-bar {
                position: static;
                width: auto;
                background: none;
                -webkit-transform: translate3d(0, 0, 0);
                -ms-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
            .am-offcanvas-bar:after {
                content: none;
            }

        }

        @media only screen and (max-width: 640px) {
            .am-offcanvas-bar .am-nav>li>a {
                color:#ccc;
                border-radius: 0;
                border-top: 1px solid rgba(0,0,0,.3);
                box-shadow: inset 0 1px 0 rgba(255,255,255,.05)
            }

            .am-offcanvas-bar .am-nav>li>a:hover {
                background: #404040;
                color: #fff
            }

            .am-offcanvas-bar .am-nav>li.am-nav-header {
                color: #777;
                background: #404040;
                box-shadow: inset 0 1px 0 rgba(255,255,255,.05);
                text-shadow: 0 1px 0 rgba(0,0,0,.5);
                border-top: 1px solid rgba(0,0,0,.3);
                font-weight: 400;
                font-size: 75%
            }

            .am-offcanvas-bar .am-nav>li.am-active>a {
                background: #1a1a1a;
                color: #fff;
                box-shadow: inset 0 1px 3px rgba(0,0,0,.3)
            }

            .am-offcanvas-bar .am-nav>li+li {
                margin-top: 0;
            }
        }

        .my-head {
            margin-top: 40px;
            text-align: center;
        }

        .my-button {
            position: fixed;
            top: 0;
            right: 0;
            border-radius: 0;
        }
        .my-sidebar {
            padding-right: 0;
            border-right: 1px solid #eeeeee;
        }

        .my-footer {
            border-top: 1px solid #eeeeee;
            padding: 10px 0;
            margin-top: 10px;
            text-align: center;
        }
    </style>

    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="/admin/assets/js/jquery.min.js"></script>
    <!--<![endif]-->
    <script src="/admin/assets/js/amazeui.min.js"></script>
    <script src="/admin/assets/js/app.js"></script>
    <script src="/admin/assets/js/admin.js"></script>
</head>
<body>
<header class="am-g my-head">
    <div class="am-u-sm-12 am-article">
        <h1 class="am-article-title">{{$news->title}}</h1>
        <p class="am-article-meta">{{$news->publisher}}</p>
        <p class="am-article-meta">{{$news->created_at}}</p>
    </div>
</header>
<hr class="am-article-divider"/>
<div class="am-g am-g-fixed">
    <div class="am-u-md-9 am-u-md-push-3">
        <div class="am-g">
            <div class="am-u-sm-11 am-u-sm-centered">
                <div class="am-cf am-article">
                    <div class="am-align-left">
                        <img src="http://s.amazeui.org/media/i/demos/bing-1.jpg" alt="" width="240">
                    </div>
                    <p>{{$news->content}}</p>
                    <hr class="am-article-divider">
                    <h2>作者简介</h2>
                    <p>《{{$news->title}}》作者{{$news->publisher}}，{{$user->Intro}}</p>
                    <hr class="am-article-divider">
                </div>
                <hr/>
                <ul class="am-comments-list">
                    <li class="am-comment">
                        <form>
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                        <a href="#link-to-user-home">
                            @if(!Auth::check())
                            <img src="/images/timg.jpg" class="am-comment-avatar" width="48" height="48">
                            @else
                            <img src="{{Auth::user()->portrait}}" class="am-comment-avatar" width="48" height="48">
                            @endif
                        </a>
                        <div class="am-comment-main">
                            <header class="am-comment-hd">
                                <div class="am-comment-meta">
                                    @if(!Auth::check())
                                    <a href="#" id="tf" class="am-comment-author">您还没有登录哦，请登陆后再评论</a>
                                    <a style="float: right" href="#" id="ttf" class="am-comment-author">没有张账号？快速注册</a>
                                    @else
                                    <a href="#" class="am-comment-author">{{Auth::user()->username}}</a>
                                    <a style="float: right" href="/out/{{$news->id}}" class="am-comment-author">退出</a>
                                    @endif
                                </div>
                            </header>
                            <textarea rows="3" cols="79" id="content" name="content" placeholder="Comment Content"></textarea>
                            @if(!Auth::check())
                            <button type="button" onclick="say_log()" class="am-btn am-btn-default am-btn-block">说点啥吧</button>
                            @else
                            <input type="text" id="title" value="{{$news->title}}" hidden>
                            <button type="button" onclick="say(this)" value="{{$news->id}}" class="am-btn am-btn-default am-btn-block">说点啥吧</button>
                            @endif
                        </div>
                        </form>
                    </li>
                    <li class="am-comment" id="con" style="display: none">
                        <form>
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                        <br>
                        <div class="am-input-group">
                            <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                            <input type="text" id="username" name="username" class="am-form-field" placeholder="Username">
                        </div><br>
                        <div class="am-input-group">
                            <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                            <input type="password" id="password" name="password" class="am-form-field" placeholder="Password">
                        </div><br>
                        <div style="text-align: right">
                            <button type="button" onclick="frontlog(this)" value="{{$news->id}}" class="am-btn am-btn-default">登录</button>
                        </div>
                        </form>
                    </li>
                    <li class="am-comment" id="ccon" style="display: none">
                        <form>
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                            <br>
                            <div class="am-input-group">
                                <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                                <input type="text" id="username1" name="username1" class="am-form-field" placeholder="Username">
                            </div><br>
                            <div class="am-input-group">
                                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                                <input type="password" id="password1" name="password1" class="am-form-field" placeholder="Password">
                            </div><br>
                            <div class="am-input-group">
                                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="am-form-field" placeholder="Password">
                            </div><br>
                            <div class="am-input-group">
                                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                                <input type="email" id="email" name="email" class="am-form-field" placeholder="Email">
                            </div><br>
                            <div style="text-align: right">
                                <button type="button" onclick="zhuce(this)" value="{{$news->id}}" class="am-btn am-btn-default">快速注册</button>
                            </div>
                        </form>
                    </li>
                    @foreach($comment as $c)
                    <li class="am-comment">
                        <a href="#link-to-user-home">
                            <img src="{{$c->head}}" class="am-comment-avatar" width="48" height="48">
                        </a>
                        <div class="am-comment-main">
                            <header class="am-comment-hd">
                                <div class="am-comment-meta">
                                    <a href="#link-to-user" class="am-comment-author">{{$c->comname}}</a> 评论于 <time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">北京时间 {{$c->created_at}}</time>
                                </div>
                            </header>
                            <div class="am-comment-bd">
                                <p>{{$c->comcontent}}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach

                    <div class="am-cf">
                        <br>共 {{$count}} 条评论
                        <div class="am-fr">
                            <ul class="am-pagination">{{$comment->links()}}</ul>
                        </div>
                    </div>

                    <button type="button" onclick="abandon_front()" class="am-btn am-btn-default">返回</button>
                </ul>
            </div>
        </div>
    </div>
    <div class="am-u-md-3 am-u-md-pull-9 my-sidebar">
        <div class="am-offcanvas" id="sidebar">
            <div class="am-offcanvas-bar">
                <ul class="am-nav">
                    <li><a href="#">{{$news->title}}</a></li>
                    <li class="am-nav-header">目录</li>
                    <li><a href="#">原文</a></li>
                    <li><a href="#">作者简介</a></li>
                    <li><a href="#">读者评论</a></li>
                </ul>
            </div>
        </div>
    </div>
    <a href="#sidebar" class="am-btn am-btn-sm am-btn-success am-icon-bars am-show-sm-only my-button" data-am-offcanvas><span class="am-sr-only">侧栏导航</span></a>
</div>
<footer class="my-footer">
    <p>sidebar template<br><small>© Copyright XXX. by the AmazeUI Team.</small></p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="/admin/assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="/admin/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/admin/assets/js/amazeui.min.js"></script>
</body>
</html>

<script>
    function e(obj) {
        return document.getElementById(obj)
    }

    e('tf').onclick = function(event) {
        e('con').style.display = 'block';
        stopBubble(event);
        document.onclick = function() {
            e('con').style.display = 'none';
            document.onclick = null;
        }
    }
    e('con').onclick = function(event) {
        //只阻止了向上冒泡，而没有阻止向下捕获，所以点击con的内部对象时，仍然可以执行这个函数
        stopBubble(event);
    }

    e('ttf').onclick = function(event) {
        e('ccon').style.display = 'block';
        stopBubble(event);
        document.onclick = function() {
            e('ccon').style.display = 'none';
            document.onclick = null;
        }
    }
    e('ccon').onclick = function(event) {
        //只阻止了向上冒泡，而没有阻止向下捕获，所以点击con的内部对象时，仍然可以执行这个函数
        stopBubble(event);
    }

    //阻止冒泡函数
    function stopBubble(e) {
        if (e && e.stopPropagation) {
            e.stopPropagation(); //w3c
        } else {
            window.event.cancelBubble = true; //IE
        }
    }
</script>