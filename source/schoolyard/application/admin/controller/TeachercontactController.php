<?php
namespace app\admin\controller;
use app\admin\model\Teachercontact;

class TeachercontactController extends CommonController{
    public function index(){
        $this->assign('arrs',db('teachers')->where('status',0)->field('rid')->select());       
        return $this->fetch();
    }
    public function json(){
        $limit=input('limit');
        $page=input('page');
        $search='%'.input('key').'%';
        $where['phone|teacherid']=array('like',$search);
        $pages=($page-1)*$limit;
        $data=db('teachercontact')->where($where)->where('status',0)->limit($pages,$limit)->select();
        $res=array();
        $res['data']=$data;
        $res['code']=0;
        $res['count']=db('teachercontact')->where('status',0)->where($where)->count('rid');
        return json($res);
    }
    public function add(){
        $m=new Teachercontact();
        if (request()->isPost()){                    
            if ($m->getinfo()){
                $data['msg']='添加成功';
                $data['state']=1;
                return json($data);              
            }else{
                $data['msg']='老师已经存在';
                $data['state']=0;
                return json($data);
            }
        }else {
            $te=model('Teachers');
            $this->assign('teacherslist',$te->field('cnname')->select());            
            return $this->fetch('info');
        }
    }
    public function edit(){       
        if (request()->isPost()){
            $rid=input('post.id');
            $ms=model('Teachercontact');
            if ($ms->editinfo($rid)){
                $data['msg']='更新成功';
                $data['state']=1;
                return json($data);
            }else {
                $data['msg']='更新失败';
                $data['state']=0;
                return json($data);
            }
        }else {
            $rid=input('get.rid');
            $te=model('Teachers');
            $this->assign('teacherslist',$te->field('cnname')->select());
            $res=db('teachercontact')->where('rid',$rid)->find();
            $this->assign('editone',$res);
            return $this->fetch('info');
        }
    }
    
    public function delete(){
        $dm=model('Teachercontact');
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