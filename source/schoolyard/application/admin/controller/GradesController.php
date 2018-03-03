<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use app\admin\model\Grades;

class GradesController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){    
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
            $pages=($page-1)*$limit;
            $data=Grades::where('status',0)->limit($pages,$limit)->select();
			foreach($data as $item){
				$item['teachername']=$item->teacher['cnname'];
			}
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=Grades::where('status',0)->count('rid');
            return json($res);        
    }
    
    public function delete(){
        $m=model('grades');
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
		$grade=new Grades();
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
			
			$data=Grades::where("rid",$rid)->find();
			$this->assign("gradesedit",$data);

			$teacherslist=$grade->getTeachers();
			$this->assign("teacherslist",$teacherslist);
			
			return $this->fetch("info");
		}
    }
    
    public function add(){
		$grade=new Grades();
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
			$teacherslist=$grade->getTeachers();
			$this->assign("teacherslist",$teacherslist);
			return $this->fetch('info');		
		} 
 }
}