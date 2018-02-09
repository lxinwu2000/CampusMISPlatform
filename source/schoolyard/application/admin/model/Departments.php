<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Departments extends Model{
    
    //查看简介
    public function lookintro(){
        $rid=input('get.rid');
        $res=$this->where('rid',$rid)->field('cnname,introduce')->find();
        if ($res){
            return $res;
        }else {
            return false;
        }
    }
    //添加
   public function getinfo(){
        $resquest=Request::instance();
        $data=json_decode($resquest->post('data'),true);
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
        $res=$this->validate('Departments.add')->save($data);
        if(!$res){
            $data['msg']=$this->getError();
            $data['state']=0;
            return $data;
        }else {
           return $this->allowField(true)->save($data);         
        }
 } 
    //负责人
    public function teachers(){
        $teachers=model('Teachers');
        return $teachers->field('rid,cnname')->select();        
    }
    //上级部门
    public function parents(){
        return $this->field('rid,cnname')->select();
    }
    //     删除
    public function del(){
        $rid=input('post.id');
        if (!empty($rid)){
            $data['status']=1;
            $res=$this::where('rid',$rid)->update($data);
            if ($res){
                return  1;
            }
        }else {
            $rid=input('checkedid/a');
            $where['rid']=array('in',$rid);
            $data['status']=1;
            $res=$this::where($where)->update($data);
            if ($res){
                return  2;
            }
        }
    }
    //编辑
    
    public function editone(){
        $rid=input('get.rid');        
        return $this::where('rid',$rid)->find();
    }
    
   
    public  function editinfo($rid){
        $request=Request::instance();
        if ($request->isPost()){
            $data=json_decode($request->post('data'),true);
            $data['createtime']=date('Y-m-d H:i:s');
            $data['createuser']=session('user_id');
            return $this->allowField(true)->save($data,['rid' => $rid]);           
        }else {
            return false;
        }
    }
    
}