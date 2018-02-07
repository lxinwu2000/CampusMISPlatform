<?php
namespace app\admin\controller;


class PositionsController extends CommonController{
    public function index(){       
       return  $this->fetch();
    }
    public function json(){ 
        $pos=model('Positions');
        $res=$pos->lookintro();
        if($res){
            $data['state']=1;
            $data['cnname']=$res['cnname'];
            $data['introduce']=$res['introduce'];
            return json($data);
            
        }else {
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
            $where['cnname|enname']=array('like',$search);
            $pages=($page-1)*$limit;
            $data=db('positions')->where($where)->where('status',0)->limit($pages,$limit)->select();
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=db('positions')->where('status',0)->where($where)->count('rid');
            return json($res);
        }
          
    }

    public function add(){
     $addm=model('Positions');
     if (request()->isPost()){  
         if($addm->getinfo()){
             $data['msg']='添加成功';
             $data['state']=1;
             return json($data);
         }else {
             $data['msg']='名称已经存在';
             $data['state']=0;
             return json($data);        
         }
     }else {
            return  $this->fetch('info');
        }
    
                   
  }
    public function edit(){       
        $editm=model('positions');
        $id=input('post.id');
        if ($editm->editinfo($id)){
            $data['msg']='更新成功';
            $data['state']=1;
            return json($data);
        }else {
            $rid=input('get.rid');
            $res=db('positions')->where('rid',$rid)->find();
            $this->assign('editone',$res);
            return $this->fetch('info');
        }
       
    }
       
    
    public function delete(){
        $dm=model('Positions');
        $result=$dm->del();
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
}

