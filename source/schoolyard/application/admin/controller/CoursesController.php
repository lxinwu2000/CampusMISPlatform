<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use app\admin\model\Courses;

class CoursesController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){
        $id=input('get.rid');
        if (empty($id)){
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
			$where['cnname|enname']=array('like',$search);
            $pages=($page-1)*$limit;
            $data=Courses::where($where)->where('status',0)->limit($pages,$limit)->select();

            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=Courses::where('status',0)->where($where)->count('rid');
            return json($res);
        }
    }
    
    public function delete(){
        $m=model('courses');
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
		$grade=new Courses();
		if(request()->isPost()){
			$rid=input("post.id");
			$res=$grade->editinfo($rid);
			if($res){
				$data['state']=1;
                $data['msg']='修改成功';
                return json($data);
			}
		}else{
			$rid=input("get.rid");
			
			$data=Courses::where("rid",$rid)->find();
			$this->assign("gradesedit",$data);
			
			return $this->fetch("info");
		}
    }
    
    public function add(){
		$db=new Courses();
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
			return $this->fetch('info');		
		} 
 }
}