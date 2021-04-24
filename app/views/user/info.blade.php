@extends('layout.layout')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">个人资料</strong> / <small>Personal
                        Information</small></div>
            </div>

            <hr/>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
                    <div class="am-panel am-panel-default">
                        <div class="am-panel-bd">
                            <div class="am-g">
                                <form method="post" action="/adm/user/up" enctype="multipart/form-data" class="am-form">
                                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                                    <div class="am-u-md-4">
                                        <img id="uhead" name="uhead" class="am-img-circle am-img-thumbnail" src="{{$user->portrait}}" />
                                    </div>
                                    <div class="am-u-md-8">
                                        <p>使用本地上传头像。 </p>
                                        <div style="display: none">
                                            <input type="text" id="id" name="id" value="{{$user->id}}">
                                        </div>
                                        <div class="am-form-group">
                                            <input type="file" id="user-pic" name="pic">
                                            <p class="am-form-help">{{$p}}</p>
                                            <button type="submit" class="am-btn am-btn-primary am-btn-xs">保存</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="am-panel am-panel-default">
                        <div class="am-panel-bd">
                            <div class="user-info">
                                <p>等级信息</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar" style="width: 60%"></div>
                                </div>
                                <p class="user-info-order">当前等级：<strong>LV8</strong> 活跃天数：<strong>587</strong>
                                    距离下一级别：<strong>160</strong></p>
                            </div>
                            <div class="user-info">
                                <p>信用信息</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar am-progress-bar-success" style="width: 80%"></div>
                                </div>
                                <p class="user-info-order">信用等级：正常 当前信用积分：<strong>80</strong></p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                    <form class="am-form am-form-horizontal">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                        <div style="display: none">
                            <input type="text" id="id" name="id" value="{{$user->id}}">
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="username" name="username" placeholder="姓名 / Name" value="{{$user->username}}" readonly>
                                <small>输入你的名字，让我们记住你。</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-email" class="am-u-sm-3 am-form-label">电子邮件 / Email</label>
                            <div class="am-u-sm-9">
                                <input type="email" id="email" name="email" placeholder="输入你的电子邮件 / Email" value="{{$user->email}}" readonly>
                                <small>邮箱你懂得...</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">电话 / Telephone</label>
                            <div class="am-u-sm-9">
                                <input type="tel" id="telephone" name="telephone" placeholder="输入你的电话号码 / Telephone">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-QQ" class="am-u-sm-3 am-form-label">QQ</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="qq" name="qq" placeholder="输入你的QQ号码">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-weibo" class="am-u-sm-3 am-form-label">微博 / Twitter</label>
                            <div class="am-u-sm-9">
                                <input type="text" id="weibo" name="weibo" placeholder="输入你的微博 / Twitter">
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
                            <div class="am-u-sm-9">
                                <textarea class="" rows="5" id="intro" name="intro" placeholder="输入个人简介"></textarea>
                                <small>250字以内写出你的一生...</small>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <div class="am-u-sm-9 am-u-sm-push-3">
                                <button type="button" onclick="edituser()" class="am-btn am-btn-primary">保存修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- content end -->
@stop
