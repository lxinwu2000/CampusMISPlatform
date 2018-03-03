<?php
namespace app\admin\controller;
use think\Db;
class TeacherintroduceController extends CommonController{
  public function index(){      
        return $this->fetch();
    }
    public function json(){     
            $m=model('Teacherintroduce');
            $res=$m->introduce();
            $name=model('Teachers')->where('rid',$res['teacherid'])->field('cnname')->find();
           if ($res){
              $data['state']=1;  
              $data['cnname']=$name['cnname'];
              $data['introduce']=$res['introduce'];
              return json($data);
          }else {
            $limit=input('get.limit');
            $page=input('get.page');
            $search='%'.input('key').'%'; 
            $where['cnname']=array('like',$search);
            $pages=($page-1)*$limit;             
            $limts="limit $pages,$limit";   
            
            $sql="SELECT ZD.*, ZT.cnname AS teachername
        FROM zxcms_teacherintroduce AS ZD, zxcms_teachers AS ZT
        WHERE ZT.rid= ZD.teacherid AND ZT.status=0 AND ZD.status=0"; 
            
            $count="SELECT count('rid')
        FROM zxcms_teacherintroduce AS ZD, zxcms_teachers AS ZT
        WHERE ZT.rid= ZD.teacherid AND ZT.status=0 AND ZD.status=0";           
              if(!empty($search)){                
                 $sql=$sql.' '."AND (ZT.`cnname` LIKE '%$search%')";         
                 $count=$count.' '."AND (ZT.`cnname` LIKE '%$search%')";         
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
    
    public function add(){
        $m=model('Teacherintroduce');
        if (request()->isPost()){
          if ($m->getinfo()){
              $data['state']=1;
              $data['msg']='添加成功';
              return json($data);
          }else {
              $data['state']=0;
              $data['msg']='添加失败';
              return json($data);
          }
        }else {
           $info=$m->teachers();
           $this->assign('teacherslist',$info);
           return  $this->fetch('info');
        }
    }
    
 public function edit(){
          $em=model('Teacherintroduce');       
          $rid=input('post.id');
          if ($em->editinfo($rid)){
              $data['msg']='更新成功';
              $data['state']=1;
              return json($data);
          }           
        else {
            $id=input('get.rid');
            $info=$em->teachers();
            $this->assign('teacherslist',$info);          
            $this->assign('editone',Db::name('teacherintroduce')->where('rid',$id)->find());
            return $this->fetch('info');
        }
    }
    
    public function delete(){
        $dm=model('Teacherintroduce');
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