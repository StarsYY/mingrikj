@extends('layout.layout')
@section('content')
    <!-- content start -->
    <div class="admin-content">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">首页</strong> / <small>一些常用模块</small>
            </div>
        </div>

        <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
            <li><a href="/adm/user" class="am-text-success">
                    <span class="am-icon-btn am-icon-file-text"></span><br/>用户管理</a>
            </li>
            <li><a href="/adm/news" class="am-text-warning">
                    <span class="am-icon-btn am-icon-briefcase"></span><br/>新闻管理</a>
            </li>
        </ul>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-bd am-table-striped admin-content-table">
                    <thead>
                    <tr>
                        <th>用户</th>
                        <th>用户类型</th>
                        <th>最后一次操作</th>
                        <th>时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($his as $v)
                        <tr>
                            <td>{{$v->hsname}}</td>
                            <td>@if($v->hstype == 1)管理员@else普通用户@endif</td>
                            <td>{{$v->lastop}}</td>
                            <td>{{$v->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- content end -->
@stop