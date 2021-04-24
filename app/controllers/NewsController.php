<?php


class NewsController extends BaseController
{
    /**
     * 控制器过滤器
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except'=>array('Login', 'DoLogin')));
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    /**
     * 新闻列表页
     */
    public function getIndex(){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        $datas = Input::all();
        Input::has('options')?$options = $datas['options']:$options = 2;
        Input::has('search')?$search = $datas['search']:$search = '';

        if ($options == 2){
            $newss = Neww::Where('title','like','%'.$search.'%')->orderBy('updated_at', 'desc')->paginate(6);
            $count = Neww::Where('title','like','%'.$search.'%')->count();
            return View::make('news.list', array('newss'=>$newss, 'search'=>$search, 'count'=>$count, 'options'=>$options));
        }
        $newss = Neww::Where('type','like',$options)->Where('title','like','%'.$search.'%')->orderBy('updated_at', 'desc')->paginate(6);
        $count = Neww::Where('type','like',$options)->Where('title','like','%'.$search.'%')->count();
        return View::make('news.list', array('newss'=>$newss, 'search'=>$search, 'count'=>$count, 'options'=>$options));
    }

    /**
     * 添加新闻
     */
    public function getAddNews(){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        return View::make('news.addnews');
    }

    public function postAddNews(){
        $datas = Input::all();
        $rules = array(
            'title'=>'required|unique:newws',
            'publisher'=>'required',
            'content'=>'required'
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg1 = $validator->messages()->first('title');
            $msg2 = $validator->messages()->first('publisher');
            $msg3 = $validator->messages()->first('content');
            $msg = $msg1."\n".$msg2."\n".$msg3;
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $news = new Neww();
        $news->title=$datas['title'];
        $news->publisher=$datas['publisher'];
        $news->content=$datas['content'];
        $news->type=$datas['type'];
        $news->save();

        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        $history->lastop = "管理员 ". Auth::user()->username. " 添加了 ". $datas['title']. " 文章";
        $history->save();

        $data = array('success'=>true, 'msg'=>'添加成功');
        return json_encode($data);
    }

    /**
     * 编辑新闻
     */
    public function getEditNews($id){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        $news = Neww::find($id);
        return View::make('news.editnews')->with('news', $news);
    }

    public function postEditNews(){
        $datas = Input::all();

        DB::table("newws")->where("id",$datas['id'])->delete();

        $rules = array(
            'title'=>'required|unique:newws',
            'content'=>'required',
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg1 = $validator->messages()->first('title');
            $msg2 = $validator->messages()->first('content');
            $msg = $msg1."\n".$msg2;
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $id = $datas['id'];
        $news = New Neww();
        $news->id=$id;
        $news->title=$datas['title'];
        $news->publisher=$datas['publisher'];
        $news->content=$datas['content'];
        $news->type=$datas['type'];
        $news->save();

        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        $history->lastop = "管理员 ". Auth::user()->username. " 修改了 ". $datas['title']. " 文章，但这篇文章不是他自己的......";
        $history->save();

        $data = array('success'=>true, 'msg'=>'修改成功');
        return json_encode($data);
    }

    /**
     * 新闻详情
     */
    public function getInfo($id){
        if (!Auth::user()->type){
            return Redirect::to('/login');
        }

        $news = Neww::find($id);
//        $author=$news->author->name;
        $user = User::Where('username', 'like', $news->publisher)->first();
        $comment = Comment::Where('comtitle', 'like', $news->title)->orderBy('created_at', 'desc')->paginate(8);
        $count = Comment::Where('comtitle', 'like', $news->title)->count();
        return View::make('news.info')
            ->with('news', $news)
            ->with('user', $user)
            ->with('comment', $comment)
            ->with('count', $count);;
    }

    /**
     * 删除新闻
     */
    public function postDeloneNews(){
        $datas = Input::all();
        $id = $datas['id'];
        $news = Neww::find($id);

        $history = new History();
        $history->hsname = Auth::user()->username;
        $history->hstype = 1;
        $history->lastop = "管理员 ". Auth::user()->username. " 删除别人的文章(". $news->title. ")!!!";
        $history->save();

        Neww::destroy($id);

        return json_encode(array('success'=>true, 'msg'=>"删除成功"));
    }

    /**
     * 删除所选新闻
     */
    public function postDelallNews(){
        $datas = Input::all();

        foreach ($datas['id'] as $v){
            $id = $v;
            Neww::destroy($id);
        }

        return json_encode(array('success'=>true, 'msg'=>"删除成功"));
    }
}