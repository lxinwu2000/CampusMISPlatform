<?php
namespace app\admin\controller;
use think\Db;
class TeacherintroduceController extends CommonController{
  public function index(){      
        return $this->fetch();
    }
    public function json(){        
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