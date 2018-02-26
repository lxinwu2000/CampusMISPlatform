<?php
namespace app\admin\controller;
use app\admin\model\Teachercontact;
use think\Db;
class TeachercontactController extends CommonController{
    public function index(){      
        return $this->fetch();
    }
    public function json(){
        $limit=input('limit');
        $page=input('page');
        $search='%'.input('key').'%';
        $pages=($page-1)*$limit;      
       
        if (!empty($search)){
        $sql=$sql.' '."AND (ZD.`phone` LIKE '%$search%' OR ZT.`cnname` LIKE '%$search%');";
        }else {
        $ql="SELECT ZD.*, ZT.cnname AS teachername
        FROM zxcms_teachercontact AS ZD, zxcms_teachers AS ZT
        WHERE ZT.rid= ZD.teacherid AND ZT.status=0 AND ZD.status=0;";
        }
        $data=Db::query($ql);       
        $res=array();
        $res['data']=$data;
        $res['code']=0;
        $res['count']=db('teachercontact')->where('status',0)->count('rid');
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
            $this->assign('teacherslist',$te->field('rid,cnname')->select());            
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
            $this->assign('teacherslist',$te->field('rid,cnname')->select());
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