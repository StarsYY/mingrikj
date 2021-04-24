@extends('layout.layout')
@section('content')
    <!-- content start -->
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf">
                    <strong class="am-text-primary am-text-lg">修改新闻</strong> /
                    <small>Edit News</small>
                </div>
            </div>

            <hr>

            <div class="am-tabs am-margin" data-am-tabs>
                <ul class="am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active"><a href="#tab1">新闻概要</a></li>
                </ul>

                <div class="am-tabs-bd">
                    <form>
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
                        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                            <div style="display: none">
                                <input type="text" id="id" name="id" value="{{$news->id}}">
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">标题</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-primary">
                                        <span class="am-input-group-label"><i class="am-icon-money am-icon-fw"></i></span>
                                        <input type="text" id="title" name="title" class="am-form-field" placeholder="Title" value="{{$news->title}}">
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">作者</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-warning">
                                        <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                                        <input type="text" id="publisher" name="publisher" class="am-form-field" placeholder="Publisher" value="{{$news->publisher}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">新闻内容</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-input-group am-input-group-danger">
                                        <span class="am-input-group-label"><i class="am-icon-bookmark am-icon-fw"></i></span>
                                        <textarea rows="9" cols="125" id="content" name="content" placeholder="Article content">{{$news->content}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="am-g am-margin-top">
                                <div class="am-u-sm-4 am-u-md-2 am-text-right">新闻类别</div>
                                <div class="am-u-sm-8 am-u-md-10">
                                    <div class="am-btn-group" data-am-button>
                                        <label class="am-btn am-btn-default am-btn-xs">
                                            <input type="radio" name="type" id="option1" value="0"> 国际新闻
                                        </label>
                                        <label class="am-btn am-btn-default am-btn-xs">
                                            <input type="radio" name="type" id="option2" value="1"> 国内新闻
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="am-margin">
                <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="editnews()">保存修改</button>
                <button type="button" class="am-btn am-btn-primary am-btn-xs" onclick="abandon_news()">放弃</button>
            </div>
        </div>
    </div>
    <!-- content end -->
@stop