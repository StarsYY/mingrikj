@extends('layout.layout')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <from>
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <div class="am-cf am-padding am-padding-bottom-0">
                    <div class="am-fl am-cf">
                        <strong class="am-text-primary am-text-lg">修改密码</strong> /
                        <small>Edit Password</small>
                    </div>
                </div>

                <hr>

                <div class="am-tabs am-margin" data-am-tabs>
                    <ul class="am-tabs-nav am-nav am-nav-tabs">
                        <li class="am-active"><a href="#tab1">修改密码</a></li>
                    </ul>

                    <div class="am-tabs-bd">
                        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                            <div style="display: none">
                                <input type="text" id="id" name="id" value="{{$user->id}}">
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">用户名</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-primary">
                                        <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                                        <input type="text" id="username" name="username" class="am-form-field" placeholder="Username" value="{{$user->username}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">密码</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-warning">
                                        <span class="am-input-group-label"><i class="am-icon-money am-icon-fw"></i></span>
                                        <input type="password" id="password" name="password" class="am-form-field" placeholder="Password" value="{{$user->password}}">
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">确认密码</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-warning">
                                        <span class="am-input-group-label"><i class="am-icon-money am-icon-fw"></i></span>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="am-form-field" placeholder="Confirm Password" value="{{$user->password}}">
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top"></div>

                        </div>

                    </div>
                </div>

                <div class="am-margin">
                    <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="changepwd()">保存修改</button>
                    <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="abandon()">放弃</button>
                </div>
            </from>
        </div>
    </div>
    <!-- content end -->
@stop