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

                    <button type="button" onclick="abandon_news()" class="am-btn am-btn-default">返回</button>
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
