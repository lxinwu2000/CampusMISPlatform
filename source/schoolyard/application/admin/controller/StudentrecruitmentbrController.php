<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use app\admin\model\Studentrecruitmentbrochure;

class StudentrecruitmentbrController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){
        $id=input('get.rid');
        if (empty($id)){
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
            $where['cnname']=array('like',$search);
            $pages=($page-1)*$limit;
            $data=Studentrecruitmentbrochure::where($where)->where('status',0)->limit($pages,$limit)->select();
            $res=array();
            for($i=0;$i<count($data);$i++){
                if(empty($data[$i]['imgpath'])){
                    $data[$i]['imgpath']='暂无';
                }else {
                    $data[$i]['imgpath']='<a href="'.$data[$i]['imgpath'].'" target="_blank"><img src="'.$data[$i]['imgpath'].'" width="50" height="50" class="simg"/></a>';
                }
                
            }
            $res['data']=$data;
            $res['code']=0;
            $res['count']=Studentrecruitmentbrochure::where('status',0)->where($where)->count('rid');
            return json($res);
        }
    }
    
    public function delete(){
        $m=model('studentrecruitmentbrochure');
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
		$db=new Studentrecruitmentbrochure();
		$data=$db->img();
		if (!$data){
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
		        $data=Studentrecruitmentbrochure::where("rid",$rid)->find();
		        $this->assign("data",$data);
		        return $this->fetch("info");
		    }
		}else {
		    if ($data['code']==0){
		        $ret["msg"]=$data["msg"];
		        $ret["code"] =$data["code"];
		        $ret["src"] = $data["src"];
		        $ret["imgpath"]=$data["imgpath"];
		        return json($ret);
		    }
		}
		
    }
    
    public function add(){
		$db=new Studentrecruitmentbrochure();
		$data=$db->img();
		if (!$data){
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
		}else {
		    if ($data['code']==0){
		        $ret["msg"]=$data["msg"];
		        $ret["code"] =$data["code"];
		        $ret["src"] = $data["src"];
		        $ret["imgpath"]=$data["imgpath"];
		        return json($ret);
		    }
		}
		
 }
}