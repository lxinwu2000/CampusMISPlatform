<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use app\admin\model\Students;
use app\admin\model\Classes;


class StudentsController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){
        $id=input('get.rid');
        if (empty($id)){
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
			$where['studentnumber|idcard|cnname|enname']=array('like',$search);
            $pages=($page-1)*$limit;
            $data=Students::where($where)->where('status',0)->limit($pages,$limit)->select();
			foreach($data as $item){
				$item['classname']=$item->classes['cnname'];
			}
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=Students::where('status',0)->where($where)->count('rid');
            return json($res);
        }
    }
    
    public function delete(){
        $m=model('students');
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
		$db=new Students();
		if(request()->isPost()){
			$rid=input("post.id");
			$res=$db->editinfo($rid);
			if($res){
				$data['state']=1;
                $data['msg']='修改成功';
                return json($data);
			}
		}else{
			$rid=input("get.rid");
			
			$classeslist=Classes::where('status',0)->select();
			$this->assign("classeslist",$classeslist);

			$data=Students::where("rid",$rid)->find();
			$this->assign("data",$data);
			
			return $this->fetch("info");
		}
    }
    
    public function add(){
		$grade=new Students();
		if(request()->isPost()){
			$res=$grade->getinfo();
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
			$classeslist=Classes::where('status',0)->select();
			$this->assign("classeslist",$classeslist);
			return $this->fetch('info');		
		} 
 }
}