<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use app\admin\model\Leaders;
class LeadersController extends CommonController{
    public function index(){
        return $this->fetch();
    }
   
    public function json(){
        $rid=input('get.rid'); 
        $operation=(int)input('get.operation');
      
        if (empty($rid)){
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
            //$where['cnname']=array('like',$search);
            $pages=($page-1)*$limit;
            $data=Leaders::where($where)->where('status',0)->field('rid,teacherid,iscurrent,servicefrom,serviceto,remark')->limit($pages,$limit)->select();
			foreach($data as $item){
			    $item['teachername']=$item->teacher['cnname'];
				$item['iscurrentname']='现任领导';
				if($item['iscurrent']=='1'){
					$item['iscurrentname']='历任领导';
				}
			}		
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=Leaders::where('status',0)->where($where)->count('rid');
            return json($res);
        }else if($operation==1){
            $res=model('Leaders')->achievement($rid);
            $data['state']=1;
            $data['cnname']=$res['cnname'];
            $data['achievement']=$res['achievement'];
            return json($data);
        }else if($operation==2){
            $res=model('Leaders')->lintroduce($rid);
            $data['state']=1;
            $data['cnname']=$res['cnname'];
            $data['introduce']=$res['introduce'];
            return json($data);
        }
    }
    
    public function delete(){
        $m=model('leaders');
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
		$db=new Leaders();
		if(request()->isPost()){
			$rid=input("post.id");
			$res=$db->editinfo($rid);
			if($res){
				$data['state']=1;
                $data['msg']='修改成功';
                return json($data);
			}
		}else{
			$res=model('Teachers')->field('rid,cnname')->select();
		    $this->assign('teacherslist',$res);
			$rid=input("get.rid");	
			$data=Leaders::where("rid",$rid)->find();
			$this->assign("data",$data);			
			return $this->fetch("info");
		}
    }
    
    public function add(){
		$db=new Leaders();
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
		    $res=model('Teachers')->field('rid,cnname')->select();
		    $this->assign('teacherslist',$res);
			return $this->fetch('info');
		} 
 }
}