<?php
namespace app\admin\controller;
use app\admin\controller\CommonController;
use app\admin\model\Departments;
class DepartmentsController extends CommonController{
    public function index(){       
       return  $this->fetch();       
    }
    public function json(){
        $m= model('Departments');
        $res=$m->lookintro();
        if ($res){
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
            $data=db('departments')->where($where)->where('status',0)->limit($pages,$limit)->select();
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=db('departments')->where('status',0)->where($where)->count('rid');
            return json($res);
        }
       
    }
    
public function delete(){
        $dm=model('Departments');
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
    
    public function edit(){
          $em=model('Departments');       
          $rid=input('post.id');
          if ($em->editinfo($rid)){
              $data['msg']='更新成功';
              $data['state']=1;
              return json($data);
          }           
        else {
            $res=$em->teachers();
            $this->assign('terlist',$res);
            $this->assign('parentslist',$em->parents());          
            $this->assign('departedit',$em->editone());
            return $this->fetch('info');
        }
    }
    
    
   public  function add(){
       $dem=new Departments();
       if(request()->isPost()){    
       $datas=$dem->getinfo();
           if (is_array($datas)){
               return json($datas);
           }else{               
           $data['msg']='添加成功';
           $data['state']=1;
           return json($data);                    
           }
       }else {  
       $res=$dem->teachers();      
       $this->assign('terlist',$res);
       $this->assign('parentslist',$dem->parents());
       return $this->fetch('info');
      }
   }
}