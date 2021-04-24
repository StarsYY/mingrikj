<?php


class FrontController extends BaseController
{
    /**
     * 前台首页
     */
    public function Index(){
        return View::make('index');
    }

    /**
     * 企业简介
     */
    public function getAbout(){
        return View::make('front.about');
    }

    /**
     * 企业新闻
     */
    public function getNews(){
        $newss = Neww::paginate(10);
        $count = Neww::count();
        return View::make('front.news')->with('newss', $newss)->with('count', $count);
    }

    /**
     * 企业新闻详情
     */
    public function getInfo($id){
        $news = Neww::find($id);
        $user = User::Where('username', 'like', $news->publisher)->first();
        $comment = Comment::Where('comtitle', 'like', $news->title)->orderBy('id', 'desc')->paginate(8);
        $count = Comment::Where('comtitle', 'like', $news->title)->count();
        return View::make('front.info')
            ->with('news', $news)
            ->with('user', $user)
            ->with('comment', $comment)
            ->with('count', $count);
    }

    /**
     * 核心竞争力
     */
    public function getCore(){
        return View::make('front.core');
    }

    /**
     * 联系我们
     */
    public function getContact(){
        return View::make('front.contact');
    }

    /**
     * 评论
     */
    public function postComnews(){
        $datas = Input::all();

        $user = User::find(Auth::user()->id);
        $comment = New Comment();
        $comment->comname = $user->username;
        $comment->head = $user->portrait;
        $comment->comtitle = $datas['title'];
        $comment->comcontent = $datas['content'];
        $comment->save();

        $history = new History();
        $history->hsname = $user->username;
        $history->hstype = Auth::user()->type;
        $history->lastop = $user->username . " 评论了 " . $datas['title'];
        $history->save();

        return json_encode(array('success'=>true, 'msg'=>"chenggong"));
    }

    /**
     * 前台登录
     */
    public function postFrlog(){
        $datas = Input::all();

        $username=$datas['username'];
        $password=$datas['password'];
        $type = User::where('username', 'like', $username)->first();
        if (Auth::attempt(array('username'=>$username, 'password'=>$password))){
            $history = new History();
            $history->hsname = $username;
            $history->hstype = $type->type;
            $history->lastop = $username. " 登陆了前台";
            $history->save();

            return json_encode(array('success'=>true, 'msg'=>'登录成功'));
        } else {
            return json_encode(array('success'=>false, 'msg'=>'用户名或密码错误'));
        }
    }

    /**
     * 前台退出
     */
    public function Out($id){
        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = Auth::user()->type;
        $history->lastop = Auth::user()->username. " 退出了前台";
        $history->save();

        Auth::logout();
        return Redirect::to('/front/info/'.$id);
    }

    /**
     * 前台注册
     */
    public function postFrzhuce(){
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
        $user->type=0;
        $user->portrait="/images/def.jpg";
        $user->save();

        $history = new History();
        $history->hsname = "游客";
        $history->hstype = 0;
        $history->lastop = "游客注册了一个新用户：". $datas['username'];
        $history->save();

        $data = array('success'=>true, 'msg'=>'添加成功');
        return json_encode($data);
    }
}
