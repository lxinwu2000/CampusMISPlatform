<?php
namespace app\admin\controller;
use think\Request;

class CopyrightinfoController extends CommonController{
    public function index(){
       return  $this->fetch();
    }
    public function add(){
        $request=Request::instance();
        $info=json_decode($request->post('data'),true);
        $info['createtime']=date('Y-m-d H:i:s');
        $info['createuser']=session('user_id');
        $res=db('copyrightinfo')->insert($info);
         if ($res){
            $data['msg']='添加成功';
            $data['state']=1;
            return json($data);
        }else {
            $data['msg']='添加失败';
            $data['state']=0;
            return json($data);
        }
    }
}