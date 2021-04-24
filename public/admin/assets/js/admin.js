$(function (){
    $("input:checkbox[id='seluserAll']").click(function() {
        if($(this).is(':checked')) {
            $('input:checkbox').each(function() {
                $(this).prop("checked", true);
            });
        } else {
            $('input:checkbox').each(function() {
                $(this).prop("checked", false);
            });
        }
    });

    $("input:checkbox[id='selnewsAll']").click(function() {
        if($(this).is(':checked')) {
            $('input:checkbox').each(function() {
                $(this).prop("checked", true);
            });
        } else {
            $('input:checkbox').each(function() {
                $(this).prop("checked", false);
            });
        }
    });
});



//登录


function login() {
    data = {
        'username': $("#username").val().trim(),
        'password': $("#password").val(),
        '_token': $("#_token").val()
    };
    $.post('/login', data, function (data) {
        if (data.success) {
            alert(data.msg);
            location.href="/adm";
        } else {
            alert(data.msg);
        }
    }, 'json')
}



//用户



//添加用户
function redadd() {
    location.href="/adm/user/add-user";
}

function register() {
    var type = 2;
    var types = document.getElementsByName("type");
    for(var i=0; i<types.length; i++){
        if(types[i].checked){
            type = types[i].value;
            break;
        }
    };

    data = {
        'username': $("#username").val().trim(),
        'email': $("#email").val().trim(),
        'password': $("#password").val(),
        'password_confirmation': $("#password_confirmation").val(),
        'type': type,
        '_token': $("#_token").val()
    };
    $.post('/adm/user/add-user', data, function (data) {
        if (data.success) {
            alert(data.msg);
            location.href="/adm/user";
        } else {
            alert(data.msg);
        }
    }, 'json');
}

function abandon(){
    location.href="/adm/user";
}

//用户详情、修改个人资料
function userinfo(obj){
    var id = $(obj).prev().val();
    location.href="/adm/user/info/" + id;
}

function edituser(){
    data = {
        'id': $("#id").val(),
        'telephone': $("#telephone").val().trim(),
        'qq': $("#qq").val().trim(),
        'weibo': $("#weibo").val().trim(),
        'intro': $("#intro").val(),
        '_token': $("#_token").val()
    };
    $.post('/adm/user/info', data, function (data) {
        if (data.success) {
            alert(data.msg);
            location.href="/adm/user";
        } else {
            alert(data.msg);
        }
    }, 'json');
}

//修改密码
function editpwd(obj){
    var id = $(obj).prev().prev().val();
    location.href="/adm/user/edit-user/" + id;
}

function changepwd(){
    data = {
        'id': $("#id").val(),
        'password': $("#password").val(),
        'password_confirmation': $("#password_confirmation").val(),
        '_token': $("#_token").val()
    };
    $.post('/adm/user/edit-user', data, function (data) {
        if (data.success) {
            alert(data.msg);
            location.href="/adm/user";
        } else {
            alert(data.msg);
        }
    }, 'json');
}

//删除用户
function delone(obj){
    var id = $(obj).prev().prev().prev().val();
    var username = $(obj).prev().prev().prev().prev().val();
    var authname = $(obj).prev().prev().prev().prev().prev().val();
    if (authname == username){
        alert("不能删除当前登录用户哦(✿◡‿◡)");
        return;
    }
    var mymessage=confirm("确定要删除 " + username + " 用户么？");
    if (mymessage){
        data = {
            'id': id,
            'logname': authname,
            'username': username,
            '_token': $("#_token").val()
        };
        $.post('/adm/user/delone-user', data, function (data) {
            if (data.success) {
                location.href="/adm/user";
            } else {
                alert(data.msg);
            }
        }, 'json');
    }
}

//删除所选用户
function delalluser(obj){
    var dau = document.getElementsByName("userlist");
    var arr = new Array();
    for(var i = 0; i < dau.length; i++){
        if(dau[i].checked){
            arr.push(dau[i].value);
            if (dau[i].value == $(obj).val()){
                alert("不能删除当前登录用户哦(✿◡‿◡)");
                return;
            }
        }
    }
    var mymessage=confirm("确定要删除这些用户么？");
    if (mymessage){
        for(var i = 0; i < dau.length; i++){
            data = {
                'id': arr,
                '_token': $("#_token").val()
            };
            $.post('/adm/user/delall-user', data, function (data) {
                if (data.success) {
                    location.href="/adm/user";
                } else {
                    alert(data.msg);
                }
            }, 'json');
        }
    }
}




//新闻



function newsadd() {
    location.href="/adm/news/add-news";
}

function addnews() {
    var type = 2;
    var types = document.getElementsByName("type");
    for(var i=0; i<types.length; i++){
        if(types[i].checked){
            type = types[i].value;
            break;
        }
    };

    data = {
        'title': $("#title").val().trim(),
        'publisher': $("#publisher").val().trim(),
        'content': $("#content").val(),
        'type': type,
        '_token': $("#_token").val()
    };
    $.post('/adm/news/add-news', data, function (data) {
        if (data.success) {
            alert(data.msg);
            location.href="/adm/news";
        } else {
            alert(data.msg);
        }
    }, 'json');
}

function abandon_news(){
    location.href="/adm/news";
}


//修改新闻
function newsedit(obj){
    var id = $(obj).prev().prev().val();
    location.href="/adm/news/edit-news/" + id;
}

function editnews(){
    var type = 2;
    var types = document.getElementsByName("type");
    for(var i=0; i<types.length; i++){
        if(types[i].checked){
            type = types[i].value;
            break;
        }
    }
    if(type != "1" && type != "0"){
        alert("请选择新闻类别");
        return;
    }

    data = {
        'id': $("#id").val(),
        'title': $("#title").val(),
        'publisher': $("#publisher").val(),
        'content': $("#content").val(),
        'type': type,
        '_token': $("#_token").val()
    };
    $.post('/adm/news/edit-news', data, function (data) {
        if (data.success) {
            alert(data.msg);
            location.href="/adm/news";
        } else {
            alert(data.msg);
        }
    }, 'json');
}

//新闻详情
function newsinfo(obj){
    var id = $(obj).prev().val();
    location.href="/adm/news/info/" + id;
}

//删除新闻
function delonenews(obj){
    var id = $(obj).prev().prev().prev().val();
    var title = $(obj).prev().prev().prev().prev().val();
    var mymessage=confirm("确定要删除 " + title + " 新闻么？");
    if (mymessage){
        data = {
            'id': id,
            '_token': $("#_token").val()
        };
        $.post('/adm/news/delone-news', data, function (data) {
            if (data.success) {
                location.href="/adm/news";
            } else {
                alert(data.msg);
            }
        }, 'json');
    }
}

//删除所选新闻
function delallnews(){
    var dau = document.getElementsByName("newslist");
    var mymessage=confirm("确定要删除这些新闻么？");
    var arr = new Array();
    for(var i = 0; i < dau.length; i++) {
        if (dau[i].checked) {
            arr.push(dau[i].value);
        }
    }
    if (mymessage){
        for(var i = 0; i < dau.length; i++){
            data = {
                'id': arr,
                '_token': $("#_token").val()
            };
            $.post('/adm/news/delall-news', data, function (data) {
                if (data.success) {
                    location.href="/adm/news";
                } else {
                    alert(data.msg);
                }
            }, 'json');
        }
    }
}





//前台


//返回新闻列表
function abandon_front(){
    location.href="/front/news";
}

//评论
function say_log(){
    alert("还没登陆呐！");
}

function say(obj){
    if ($("#content").val().trim() == ""){
        alert("评论内容不能为空");
        return;
    }
    var id = $(obj).val();

    data = {
        'title': $("#title").val(),
        'content': $("#content").val().trim(),
        '_token': $("#_token").val()
    };
    $.post('/front/comnews', data, function (data) {
        if (data.success) {
            location.href="/front/info/" + id;
        } else {
            alert(data.msg);
        }
    }, 'json');
}

//前台登录
function frontlog(obj){
    if ($("#username").val().trim() == "" || $("#password").val() == ""){
        alert("用户名和密码不能为空");
    }
    var id = $(obj).val();

    data = {
        'username': $("#username").val().trim(),
        'password': $("#password").val(),
        '_token': $("#_token").val()
    };
    $.post('/front/frlog', data, function (data) {
        if (data.success) {
            location.href="/front/info/" + id;
        } else {
            alert(data.msg);
        }
    }, 'json');
}

//前台注册用户
function zhuce(obj){
    var id = $(obj).val();

    data = {
        'username': $("#username1").val().trim(),
        'password': $("#password1").val(),
        'password_confirmation': $("#password_confirmation").val(),
        'email': $("#email").val().trim(),
        '_token': $("#_token").val()
    };
    $.post('/front/frzhuce', data, function (data) {
        if (data.success) {
            alert("chenggong")
            location.href="/front/info/" + id;
        } else {
            alert(data.msg);
        }
    }, 'json');
}
