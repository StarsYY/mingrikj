@extends('layout.layout')
@section('content')
    <!-- content start -->
    <div class="admin-content">

        <!-- 用户上方区域，增删... -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">后台</strong> / <small>用户管理</small>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <button type="button" class="am-btn am-btn-default" onclick="redadd()">
                            <span class="am-icon-plus"></span> 新增
                        </button>
                        <button type="button" class="am-btn am-btn-default" onclick="delalluser(this)" id="nowname" value="{{Auth::user()->id}}">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>
                    </div>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <select id="select" onchange="selchange()">
                        <option value="2" @if($options == 2)selected@endif>所有类别</option>
                        <option value="1" @if($options == 1)selected@endif>管理员</option>
                        <option value="0" @if($options == 0)selected@endif>普通用户</option>
                    </select>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-input-group am-input-group-sm">
                    <input type="text" id="search" name="search" class="am-form-field" value="@if(isset($search)){{$search}}@endif">
                    <span class="am-input-group-btn">
                        <button class="am-btn am-btn-default" type="button" onclick="selchange()">搜索</button>
                    </span>
                </div>
            </div>
        </div>
        <!-- 用户上方区域，增删...结束 -->

        <!-- 用户区域 -->
        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox" id="seluserAll"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-type">用户类型</th>
                        <th class="table-author am-hide-sm-only">用户名</th>
                        <th class="table-author am-hide-sm-only">邮箱</th>
                        <th class="table-date am-hide-sm-only">修改日期</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $v)
                    <form>
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                        <tr>
                            @if($v->username != "admin")
                            <td><input type="checkbox" name="userlist" value="{{$v->id}}"/></td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$v->id}}</td>
                            <td>@if($v->type == 1)管理员@else普通用户@endif</td>
                            <td class="am-hide-sm-only">{{$v->username}}</td>
                            <td class="am-hide-sm-only">{{$v->email}}</td>
                            <td class="am-hide-sm-only">{{$v->updated_at}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <input type="hidden" value="{{Auth::user()->username}}"/>
                                        <input type="hidden" value="{{$v->username}}"/>
                                        <input type="hidden" value="{{$v->id}}"/>
                                        @if($v->username == "admin")
                                            @if(Auth::user()->username == "admin")
                                            <button type="button" onclick="userinfo(this)" class="am-btn am-btn-default am-btn-xs am-text-success">
                                                <span class="am-icon-pencil-square-o"></span> 用户详情
                                            </button>
                                            <button type="button" onclick="editpwd(this)" class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                                <span class="am-icon-pencil-square-o"></span> 修改密码
                                            </button>
                                            <button type="button" onclick="delone(this)" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </button>
                                            @else
                                            <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                                <span class="am-icon-trash-o"></span> 您没有权限操作此用户
                                            </button>
                                            @endif
                                        @else
                                        <button type="button" onclick="userinfo(this)" class="am-btn am-btn-default am-btn-xs am-text-success">
                                            <span class="am-icon-pencil-square-o"></span> 用户详情
                                        </button>
                                        <button type="button" onclick="editpwd(this)" class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                            <span class="am-icon-pencil-square-o"></span> 修改密码
                                        </button>
                                        <button type="button" onclick="delone(this)" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                            <span class="am-icon-trash-o"></span> 删除
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </form>
                    @endforeach

                    </tbody>

                </table>


                <div class="am-cf">
                    共 {{$count}} 条记录
                    <div class="am-fr">
                        <ul class="am-pagination">{{$users->appends(array('search' => $search, 'options' => $options))->links()}}</ul>
                    </div>
                </div>
                <hr/>
                <p>注：测试程序......</p>
            </div>
        </div>
        <!-- 用户区域结束 -->
    </div>
    <!-- content end -->
@stop
