<?php


class UserController extends BaseController
{
    /**
     * 控制器过滤器
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except'=>array('Login', 'DoLogin')));
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    /**
     * 后台首页
     */
    public function adminIndex(){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        $his = History::orderBy('id', 'desc')->paginate(7);
        return View::make('adminindex')->with('his', $his);
    }

    /**
     * 用户列表页
     */
    public function getIndex(){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        $search = Input::get('search');
        if ($search == ""){
            $count = User::count();
            $users = User::paginate(6);
            return View::make('user.list')->with('users', $users)->with('count', $count);
        } else{
            $users = User::Where('username','like','%'.$search.'%')->paginate(6);
            $count = User::Where('username','like','%'.$search.'%')->count();
            return View::make('user.list')->with('users', $users)->with('search', $search)->with('count', $count);
        }
    }

    /**
     * 添加用户
     */
    public function getAddUser(){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        return View::make('user.adduser');
    }

    public function postAddUser(){
        $datas = Input::all();
        $rules = array(
            'username'=>'required|unique:users|alpha_num',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|confirmed'
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg1 = $validator->messages()->first('username');
            $msg2 = $validator->messages()->first('email');
            $msg3 = $validator->messages()->first('password');
            $msg = $msg1."\n".$msg2."\n".$msg3;
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $user = new User();
        $user->username=$datas['username'];
        $user->email=$datas['email'];
        $user->password=Hash::make($datas['password']);
        $user->type=$datas['type'];
        $user->portrait="/images/def.jpg";
        $user->save();

        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        $history->lastop = "管理员 ". Auth::user()->username. " 添加了一个新管理员用户：". $datas['username'];
        $history->save();

        $data = array('success'=>true, 'msg'=>'添加成功');
        return json_encode($data);
    }

    /**
     * 上传头像
     * @return false|string
     */
    public function postUp(){
        $id = Input::get('id');
        $user = User::find($id);

        $type = $_FILES["pic"]["type"];
        $allow_types = array("image/jpeg", "image/jpeg", "image/png", "image/gif");
        if (!in_array($type, $allow_types)) {
            return View::make('user.info')->with('user', $user)->with('p', '该文件不是图片');
        }
        if ($_FILES["pic"]["size"] > 200000000) {
            return View::make('user.info')->with('user', $user)->with('p', '图片大小超过限制');
        }

        //获取上传的临时文件，并保存在$target_path中
        $tmp_path = $_FILES["pic"]["tmp_name"];
        $ext = substr($_FILES["pic"]["name"], strrpos($_FILES["pic"]["name"], "."));
        $target_path = "./public/images/" . time() . "_" . $id . $ext;
        move_uploaded_file($tmp_path, $target_path);
        $path_true = "/images/" . time() . "_" . $id . $ext;

        $comment = Comment::Where('comname','like',$user->username)->get();
        foreach ($comment as $c){
            $c->head = $path_true;
            $c->save();
        }

        $user->portrait = $path_true;
        $user->save();

        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        if (Auth::user()->username == $user->username){
            $history->lastop = "管理员 ". $user->username. " 换了个新头像";
        } else{
            $history->lastop = "管理员 ". Auth::user()->username. " 修改了 ". $user->username. " 的头像";
        }
        $history->save();

        return View::make('user.info')->with('user', $user)->with('p', '上传成功');
    }

    /**
     * 用户详情
     */
    public function getInfo($id){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        $user = User::find($id);
        return View::make('user.info')->with('user', $user)->with('p', '请选择要上传的文件...');
    }

    public function postInfo(){
        $datas = Input::all();
        $rules = array(
            'telephone'=>'between:11,11',
            'qq'=>'max:12',
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg1 = $validator->messages()->first('telephone');
            $msg2 = $validator->messages()->first('qq');
            $msg = $msg1."\n".$msg2;
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $id = $datas['id'];
        $user = User::find($id);
        $user->telephone=$datas['telephone'];
        $user->qq=$datas['qq'];
        $user->weibo=$datas['weibo'];
        $user->intro=$datas['intro'];
        $user->save();

        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        if (Auth::user()->username == $user->username){
            $history->lastop = "管理员 ". $user->username. " 修改了自己的资料";
        } else{
            $history->lastop = "管理员 ". Auth::user()->username. " 竟然修改别人(". $user->username. ")的资料!!!";
        }
        $history->save();

        $data = array('success'=>true, 'msg'=>'修改成功');
        return json_encode($data);
    }

    /**
     * 修改密码
     */
    public function getEditUser($id){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        $user = User::find($id);
        return View::make('user.edituser')->with('user', $user);
    }

    public function postEditUser(){
        $datas = Input::all();
        $rules = array(
            'password'=>'required|min:6|confirmed',
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg = $validator->messages()->first('password');
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $id = $datas['id'];
        $password = $datas['password'];
        $user = User::find($id);
        $user->password=Hash::make($password);
        $user->save();

        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        if (Auth::user()->username == $user->username){
            $history->lastop = "管理员 ". $user->username. " 把自己密码改了";
        } else{
            $history->lastop = "管理员 ". Auth::user()->username. " 竟然修改别人(". $user->username. ")的密码!!!";
        }
        $history->save();

        $data = array('success'=>true, 'msg'=>'修改成功');
        return json_encode($data);
    }

    /**
     * 删除单个用户
     */
    public function postDeloneUser(){
        $datas = Input::all();
        $id = $datas['id'];
        User::destroy($id);

        $history = new History();
        $history->hsname = $datas['logname'];
        $history->hstype = 1;
        $history->lastop = "管理员 ". $datas['logname']. " 把别人(". $datas['username']. ")的用户删了!!!";
        $history->save();

        return json_encode(array('success'=>true, 'msg'=>"删除成功"));
    }

    /**
     * 删除所选用户
     */
    public function postDelallUser(){
        $datas = Input::all();

        foreach ($datas['id'] as $v){
            $id = $v;
            User::destroy($id);
        }

        return json_encode(array('success'=>true, 'msg'=>"删除成功"));
    }

    /**
     * 登录后台
     */
    public function Login(){
        return View::make('user.login');
    }

    public function DoLogin(){
        $datas = Input::all();
        $rules = array(
            'username'=>'required',
            'password'=>'required'
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg1 = $validator->messages()->first('username');
            $msg2 = $validator->messages()->first('password');
            $msg = $msg1."\n".$msg2;
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $username=$datas['username'];
        $password=$datas['password'];
        $type = User::where('username', 'like', $username)->first();
        if ($type->type == 0){
            return json_encode(array('success'=>false, 'msg'=>'普通用户不能登录哦(❁´◡`❁)'));
        } else if (Auth::attempt(array('username'=>$username, 'password'=>$password))){
            if (($_SERVER['REMOTE_ADDR'] == "221.192.180.224") && ($username == "admin")){
                $history = new History();
                $history->hsname = $username;
                $history->hstype = 1;
                $history->lastop = "管理员 ". $username. " 在本机登陆了";
                $history->save();

                return json_encode(array('success'=>true, 'msg'=>'登录成功，即将跳转到后台首页'));
            } elseif (($_SERVER['REMOTE_ADDR'] != "221.192.180.224") && ($username == "admin")){
                return json_encode(array('success'=>false, 'msg'=>'您的电脑没有权限登录此用户'));
            }

            $history = new History();
            $history->hsname = $username;
            $history->hstype = 1;
            $history->lastop = "管理员 ". $username. " 登陆了";
            $history->save();

            return json_encode(array('success'=>true, 'msg'=>'登录成功，即将跳转到后台首页'));
        } else {
            return json_encode(array('success'=>false, 'msg'=>'用户名或密码错误'));
        }
    }

    /**
     * 用户注销
     */
    public function Logout(){
        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        $history->lastop = "管理员 ". Auth::user()->username. " 退出了";
        $history->save();

        Auth::logout();
        return Redirect::to('/login');
    }
}