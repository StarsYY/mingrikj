@extends('layout.layout')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <from>
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <div class="am-cf am-padding am-padding-bottom-0">
                    <div class="am-fl am-cf">
                        <strong class="am-text-primary am-text-lg">添加新用户</strong> /
                        <small>Add User</small>
                    </div>
                </div>

                <hr>

                <div class="am-tabs am-margin" data-am-tabs>
                    <ul class="am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="#tab1">用户信息</a></li>
                    </ul>

                    <div class="am-tabs-bd">
                        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">用户名</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-primary">
                                        <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                                        <input type="text" id="username" name="username" minlength="1" class="am-form-field" placeholder="Username" required>
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">邮箱</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-success">
                                        <span class="am-input-group-label"><i class="am-icon-empire am-icon-fw"></i></span>
                                        <input type="email" id="email" name="email" class="am-form-field" placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">密码</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-warning">
                                        <span class="am-input-group-label"><i class="am-icon-money am-icon-fw"></i></span>
                                        <input type="password" id="password" name="password" class="am-form-field" placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">确认密码</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-warning">
                                        <span class="am-input-group-label"><i class="am-icon-money am-icon-fw"></i></span>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="am-form-field" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">用户级别</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-btn-group" data-am-button>
                                        <label class="am-btn am-btn-default am-btn-xs">
                                            <input type="radio" name="type" id="option1" value="0" checked> 普通用户
                                        </label>
                                        <label class="am-btn am-btn-default am-btn-xs">
                                            <input type="radio" name="type" id="option2" value="1"> 管理员
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="am-margin">
                    <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="register()">添加</button>
                    <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="abandon()">放弃</button>
                </div>
            </from>
        </div>
    </div>
    <!-- content end -->
@stop