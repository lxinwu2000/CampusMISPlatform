<?php
namespace app\admin\controller;

use think\Request;
use app\admin\model\Opinionpublish;

class OpinionpublishController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){     
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
            $where['subject']=array('like',$search);
            $pages=($page-1)*$limit;
            $data=Opinionpublish::where($where)->where('status',0)->limit($pages,$limit)->select();
			for($i=0;$i<count($data);$i++){
				$data[$i]["publishername"]=$data[$i]->admin['username'];
			}
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=Opinionpublish::where('status',0)->where($where)->count('rid');
            return json($res);
    }
    
    public function delete(){
        $m=model('opinionpublish');
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
		$db=new Opinionpublish();
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
			$data=Opinionpublish::where("rid",$rid)->find();
			$this->assign("data",$data);			
			return $this->fetch("info");
		}
    }
    
    public function add(){
		$db=new Opinionpublish();
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