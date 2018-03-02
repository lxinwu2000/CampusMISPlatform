<?php
namespace app\admin\controller;
use app\admin\controller\CommonController;
use app\admin\model\Departments;

use  think\Db;

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
            $limit=input('get.limit');
            $page=input('get.page');
            $search='%'.input('key').'%'; 
            $where['cnname']=array('like',$search);
            $pages=($page-1)*$limit;             
            $limts="limit $pages,$limit";   
            
            $sql="SELECT ZD.`rid`,ZD.`cnname`,ZD.`enname`,ZD.`remark`,ZT.`cnname` AS teachername,
                CASE ZD.`parentid` WHEN 0 THEN '顶级部门' ELSE 
                (SELECT TMP_ZD.cnname FROM zxcms_departments TMP_ZD WHERE TMP_ZD.`rid` = ZD.`parentid`) END AS pname
                FROM zxcms_departments ZD LEFT JOIN zxcms_teachers ZT ON ZT.`rid` = ZD.`head`  
                WHERE ZT.status=0 AND ZD.status=0"; 
            
            $count="SELECT count('rid')
                FROM zxcms_departments ZD LEFT JOIN zxcms_teachers ZT ON ZT.`rid` = ZD.`head`  
                WHERE ZT.status=0 AND ZD.status=0";           
              if(!empty($search)){                
                 $sql=$sql.' '."AND (ZD.`cnname` LIKE '%$search%' OR ZT.`cnname` LIKE '%$search%')";         
                 $count=$count.' '."AND (ZD.`cnname` LIKE '%$search%' OR ZT.`cnname` LIKE '%$search%')";         
              }
            $count=Db::query($count);                   
            $data=Db::query($sql.' '.$limts);          
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=$count[0]["count('rid')"];
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