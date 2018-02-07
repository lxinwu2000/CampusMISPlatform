<?php
namespace app\admin\controller;

use app\admin\model\Organizeinfo;

class OrganizeinfoController extends CommonController{
    public function index(){
       $res=db('organizeinfo')->find();
       $this->assign('orglist',$res);    
       return $this->fetch();
    }
    public function info(){
       return  $this->fetch();
    }   
    public function edit(){  
    $orm=new Organizeinfo();
    $img=$orm->img();
    if (!$img){
        $info=$orm->getinfo();
        if ($info){
            $data['msg']='修改成功';
            $data['state']=1;
            return json($data);
        }else {
            $data['msg']='修改失败';
            $data['state']=0;
            return json($data);
        }
    }else {
        $ret["msg"]=$img['msg'];
        $ret["code"] =0;
        $ret["src"] =$img['src'];       
        return json($ret);
    }
    
        
  }    
   
   
    
}