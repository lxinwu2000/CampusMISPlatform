<?php
namespace app\admin\controller;
use think\Request;

class CopyrightinfoController extends CommonController{
    public function index(){
        $list=db('copyrightinfo')->find();
        $this->assign('copylist',$list);
       return  $this->fetch();
    }
    public function edit(){
        $request=Request::instance();
        $info=json_decode($request->post('data'),true);
        $info['createtime']=date('Y-m-d H:i:s');
        $info['createuser']=session('user_id');
        $rid=input('post.id');
        $res=db('copyrightinfo')->where('rid',$rid)->update($info);
         if ($res){
            $data['msg']='修改成功';
            $data['state']=1;
            return json($data);
        }else {
            $data['msg']='修改失败';
            $data['state']=0;
            return json($data);
        }
    }
}