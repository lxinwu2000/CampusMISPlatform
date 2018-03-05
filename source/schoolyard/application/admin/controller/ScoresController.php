<?php
namespace app\admin\controller;

use think\Request;
use app\admin\model\Scores;
use app\admin\model\Courses;
use app\admin\model\Students;

class ScoresController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){     
            $limit=input('limit');
            $page=input('page');
            $pages=($page-1)*$limit;
            $data=Scores::where($where)->where('status',0)->limit($pages,$limit)->select();
			for($i=0;$i<count($data);$i++){
				$data[$i]["studentname"]=$data[$i]->student['cnname'];
				$data[$i]["coursename"]=$data[$i]->course['cnname'];
			}
			//使用for循环实现模糊查询begin
			$datares=array();
			if((input('key')!=null)&&!empty(input('key'))){
				$key=input('key');
				for($i=0;$i<count($data);$i++){
					if(stripos($data[$i]['studentname'],$key)!==false){
						array_push($datares,$data[$i]);
					}else if(stripos($data[$i]['coursename'],$key)!==false){
						array_push($datares,$data[$i]);
					}
				}
			}else{
				for($i=0;$i<count($data);$i++){
					array_push($datares,$data[$i]);
				}
			}
			unset($data);
			//使用for循环实现模糊查询end
            $res=array();
            $res['data']=$datares;
            $res['code']=0;
            $res['count']=count($datares);
            return json($res);
    }
    
    public function delete(){
        $m=model('scores');
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
		$db=new Scores();
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
			$studentslist=Students::where("status",0)->select();
			$this->assign("studentslist",$studentslist);

			$courseslist=Courses::where("status",0)->select();
			$this->assign("courseslist",$courseslist);
			$data=Scores::where("rid",$rid)->find();
			$this->assign("data",$data);			
			return $this->fetch("info");
		}
    }
    
    public function add(){
		$db=new Scores();
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
			$studentslist=Students::where("status",0)->select();
			$this->assign("studentslist",$studentslist);

			$courseslist=Courses::where("status",0)->select();
			$this->assign("courseslist",$courseslist);
			return $this->fetch('info');		
		} 
 }
}