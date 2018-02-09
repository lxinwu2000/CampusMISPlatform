<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Teachercontact extends Model{
    public function getinfo(){
        $resquest=Request::instance();
        $data=json_decode($resquest->post('data'),true);
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
        $teacherid=$data['teacherid'];
        $res=$this->where('teacherid',$teacherid)->find();
        if ($res){
            return false;
        }else {
            return $this->allowField(true)->save($data);
        }
        
    }
    //编辑
    public function editinfo($rid){
        $resquest=Request::instance();
        $data=json_decode($resquest->post('data'),true);
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
        $info=$this::save($data,['rid'=>$rid]);
        if ($info){
            return true;
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