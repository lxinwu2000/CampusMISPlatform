<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Teacherintroduce extends Model{
    //添加
    public function getinfo(){
        $requerst=Request::instance();
        $data=json_decode($requerst->post('data'),true);
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
        return $this->allowField(true)->save($data);        
    }
    //老师
    public function teachers(){
        $m=model('Teachers');
        return $m->where('status',0)->field('rid,cnname')->select();
    }
   //编辑
    public function editinfo($rid){
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
    
    //事迹介绍
    public function introduce(){
        $rid=input('get.rid');
        $res=$this->where('rid',$rid)->field('teacherid,introduce')->find();
        if ($res){
            return $res;
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