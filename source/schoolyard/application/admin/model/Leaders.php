<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Leaders extends Model{
	public function Teacher(){
		return $this->belongsTo('Teachers','teacherid','rid');
	}

	public function getinfo(){
		$resquest=Request::instance();
        $data=json_decode($resquest->post('data'),true);
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
		$existsdata=$this::where("teacherid",$data['teacherid'])->find();
		
		//重复添加数据，如果原数据有效，则提示错误
		//如果原数据为删除状态，则更新原数据
		if($existsdata){
			if($existsdata['status']=='1'){
				$data['status']='0';
				return $this->allowField(true)->save($data,['teacherid'=>$data['teacherid']]);
			}else{
				return false;
			}
		}else{
			return $this->allowField(true)->save($data);
		}
	}
//政绩
public function achievement($rid){
    return $this->where('rid',$rid)->field('rid,achievement,cnname')->find();
}
//简介
public function lintroduce($rid){
    return $this->where('rid',$rid)->field('rid,introduce,cnname')->find();
}
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

    //删除
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