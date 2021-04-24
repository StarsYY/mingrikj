@extends('layout.layout')
@section('content')
    <!-- content start -->
    <div class="admin-content">

        <!-- 新闻上方区域，增删... -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary am-text-lg">后台</strong> / <small>新闻管理</small>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <button type="button" onclick="newsadd()" class="am-btn am-btn-default">
                            <span class="am-icon-plus"></span> 新增
                        </button>
                        <button type="button" class="am-btn am-btn-default" onclick="delallnews()">
                            <span class="am-icon-trash-o"></span> 删除
                        </button>
                    </div>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <select data-am-selected="{btnSize: 'sm'}">
                    <option value="2">所有类别</option>
                    <option value="1">国内新闻</option>
                    <option value="0">国际新闻</option>
                    </select>
                </div>
            </div>

            <div class="am-u-sm-12 am-u-md-3">
                <form action="/adm/news">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" id="search" name="search" class="am-form-field">
                        <span class="am-input-group-btn">
						    <button class="am-btn am-btn-default" type="submit">搜索</button>
				        </span>
                    </div>
                </form>
            </div>
        </div>
        <!-- 新闻上方区域，增删...结束 -->

        <!-- 新闻区域 -->
        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th class="table-check"><input type="checkbox" id="selnewsAll"/></th>
                            <th class="table-id">ID</th>
                            <th class="table-type">标题</th>
                            <th class="table-author am-hide-sm-only">作者</th>
                            <th class="table-type">新闻类别</th>
                            <th class="table-date am-hide-sm-only">修改日期</th>
                            <th class="table-set">操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($newss as $v)
                            <tr>
                                <td><input type="checkbox" name="newslist" value="{{$v->id}}"/></td>
                                <td>{{$v->id}}</td>
                                <td>{{$v->title}}</td>
                                <td class="am-hide-sm-only">{{$v->publisher}}</td>
                                <td>@if($v->type == 1)国内新闻@else国际新闻@endif</td>
                                <td class="am-hide-sm-only">{{$v->updated_at}}</td>
                                <td>
                                    <div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <input type="hidden" value="{{$v->title}}"/>
                                            <input type="hidden" value="{{$v->id}}"/>
                                            <button type="button" onclick="newsinfo(this)" class="am-btn am-btn-default am-btn-xs am-text-success">
                                                <span class="am-icon-pencil-square-o"></span> 新闻详情
                                            </button>
                                            <button type="button" onclick="newsedit(this)" class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                                <span class="am-icon-pencil-square-o"></span> 修改新闻
                                            </button>
                                            <button type="button" onclick="delonenews(this)" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                                <span class="am-icon-trash-o"></span> 删除
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="am-cf">
                        共 {{$count}} 条记录
                        <div class="am-fr">
                            @if(isset($search))
                                <ul class="am-pagination">{{$newss->appends(array('search' => $search))->links()}}</ul>
                            @else
                                <ul class="am-pagination">{{$newss->links()}}</ul>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <p>注：测试程序......</p>
                </form>
            </div>
        </div>
        <!-- 新闻区域结束 -->
    </div>
    <!-- content end -->
@stop