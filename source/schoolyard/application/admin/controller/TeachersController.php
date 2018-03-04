<?php
namespace app\admin\controller;

use think\Request;
use think\Db;
use app\admin\model\Teachers;

class TeachersController extends CommonController{
    public function index(){      
        return $this->fetch();
    }
   
    public function json(){
        $id=input('get.rid');
        if (empty($id)){
            $limit=input('limit');
            $page=input('page');
            $search='%'.input('key').'%';
            $where['number|cnname|enname']=array('like',$search);
            $pages=($page-1)*$limit;
            $data=db('teachers')->where($where)->where('status',0)->limit($pages,$limit)->select();
            $res=array();
            $res['data']=$data;
            $res['code']=0;
            $res['count']=db('teachers')->where('status',0)->where($where)->count('rid');
            return json($res);
        }else {
            $result=db('teachers')->where('rid',$id)->field('photopath,cnname')->find();
            $photopath=request()->root(true).$result['photopath'];
            if ($result){
                $data['state']=1;
                $data['src']=$photopath;
                $data['cnname']=$result['cnname'];
                return json($data);
            }else {
                $data['state']=0;
                $data['msg']='加载失败，请重试';
                return json($data);
            }
        }
      
    }
    
    public function delete(){
        $m=model('Teachers');
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
      $img=new Teachers();
      $data=$img->img();
      if (!$data){
          //编辑信息
          $request=Request::instance();
          if ($request->isPost()){
              $rid=input('post.id');
              $request=Request::instance();
              $info=json_decode($request->post('data'),true);
              $imgutl=$info['photopath'];
              $hasimg=Db::name('teachers')->where('rid',$rid)->field('photopath')->find();
              $info['createtime']=date('Y-m-d H:i:s');
              $info['createuser']=session('user_id'); 
              if ($imgutl==$hasimg['photopath']){
                  $res=Db::name('teachers')->where('rid',$rid)->update($info);
                  if ($res){
                      $data['state']=1;
                      $data['msg']='更新成功';
                      return json($data);
                  }else {
                      $data['state']=0;
                      $data['msg']='更新失败';
                      return  json($data);
                  }
              }else {
                  delimg($hasimg['photopath']);
                  $res=Db::name('teachers')->where('rid',$rid)->update($info);
                  if ($res){
                      $data['state']=1;
                      $data['msg']='更新成功';
                      return json($data);
                  }else {
                      $data['state']=0;
                      $data['msg']='更新失败';
                      return  json($data);
                  }
              }
             
          }else {
              $rid=input('get.rid');
              $res=Db::name('teachers')->where('rid',$rid)->find();
              $this->assign('editone',$res);
              return $this->fetch('info');
          } 
      }else {
          if ($data['code']==0){
              $ret["msg"]=$data["msg"];
              $ret["code"] =$data["code"];
              $ret["src"] = $data["src"];
              $ret["photopath"]=$data["photopath"];
              return json($ret);
          }
      }
             
    }
    
    public function add(){
        $img=new Teachers();
        $data=$img->img();       
        if(!$data){
            //上传信息
            $request=Request::instance();
            if ($request->isPost()){
            $request=Request::instance();
            $info=json_decode($request->post('data'),true);
            $info['createtime']=date('Y-m-d H:i:s');
            $info['createuser']=session('user_id');
            $where['number']=$info['number'];
            $hasnumber=Db::name('teachers')->where($where)->find();
            if ($hasnumber){
                if ($hasnumber['status']=='1'){
                    $data['status']=0;
                    $res=Db::name('teachers')->where($where)->update($data);
                    if ($res){
                        $data['state']=1;
                        $data['msg']='添加成功';
                        return json($data);
                    }else {
                        $data['state']=0;
                        $data['msg']='添加失败';
                        return  json($data);
                    }
                }else {
                    $data['state']=0;
                    $data['msg']='教工编号已经存在';
                    return json($data);
                }
               
            }else{
                $res=Db::name('teachers')->insert($info);
                if ($res){
                    $data['state']=1;
                    $data['msg']='添加成功';
                    return json($data);
                }else {
                    $data['state']=0;
                    $data['msg']='添加失败';
                    return  json($data);
                }
            }
         }else {
             return $this->fetch('info');
         }
        }else {
            //上传图片
            if ($data['code']==0){
                $ret["msg"]=$data["msg"];
                $ret["code"] =$data["code"];
                $ret["src"] = $data["src"];
                $ret["photopath"]=$data["photopath"];
                return json($ret);
            }
        }
         
      
        
         
 }
    
    
    
    
    
}