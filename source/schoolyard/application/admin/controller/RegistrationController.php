<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use app\admin\model\Registration;
class RegistrationController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){
        $limit=input('limit');
		$page=input('page');
		$search='%'.input('key').'%';
		$where['name']=array('like',$search);
		$pages=($page-1)*$limit;
		$data=Registration::where($where)->where('status',0)->limit($pages,$limit)->select();
		$res=array();
		$res['data']=$data;
		$res['code']=0;
		$res['count']=Registration::where('status',0)->where($where)->count('rid');
		return json($res);
    }
    
    public function delete(){
        $m=model('registration');
        $result=$m->del();
        if ($result==1){
            $data['state']=1;
            $data['msg']='删除成功';
            return json($data);
        }else if($result==2){
             $data['state']=1;
             $data['msg']='批量删除成功';
            return json($data);
        }
    }
        
    public function edit(){
		$db=new Registration();
		if(request()->isPost()){
			$rid=input("post.id");
			$res=$db->editinfo($rid);
			if($res){
				$data['state']=1;
                $data['msg']='修改成功';
                return json($data);
			}
		}else{
			//$res=model('Teachers')->field('rid,cnname')->select();
		    //$this->assign('teacherslist',$res);
			$rid=input("get.rid");	
			$data=Registration::where("rid",$rid)->find();
			$this->assign("data",$data);			
			return $this->fetch("info");
		}
    }
    
    public function add(){
		$db=new Registration();
		if(request()->isPost()){
			$res=$db->getinfo();
			if($res){
				$data['state']=1;
                $data['msg']='添加成功';
                return json($data);
			}else{
				$data['state']=0;
                $data['msg']='添加失败,数据已存在或数据库执行错误';
                return json($data);
			}
		}else{
		    //$res=model('Teachers')->field('rid,cnname')->select();
		    //$this->assign('teacherslist',$res);
			return $this->fetch('info');
		} 
 }
}