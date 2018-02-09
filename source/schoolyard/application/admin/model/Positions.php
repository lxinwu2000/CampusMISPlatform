<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Positions extends Model{
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
    //添加数据
    public function getinfo(){
            $request=Request::instance();
            $data=json_decode($request->post('data'),true);
            $data['createtime']=date('Y-m-d H:i:s');
            $data['createuser']=session('user_id');
            $name=$data['cnname'];
            $res=$this->where('cnname',$name)->find();
            if ($res){               
                return false;               
            }else {              
                return  $this->allowField(true)->save($data);               
            }                      
    }
   //编辑
  public  function editinfo($rid){
      $request=Request::instance();
      if ($request->isPost()){
          $data=json_decode($request->post('data'),true);
          $data['createtime']=date('Y-m-d H:i:s');
          $data['createuser']=session('user_id');
          $info=$this->allowField(true)->save($data,['rid' => $rid]);
          if ($info){
            return true;
          }
      }else {
          return false;
      }
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
}