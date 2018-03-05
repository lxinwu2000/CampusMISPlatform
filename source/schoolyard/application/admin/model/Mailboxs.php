<?php
namespace app\admin\model;
use think\Model;
use think\Request;
use think\Db;

class Mailboxs extends Model{
	public function Teacher(){
		return $this->belongsTo('Teachers','receiverid','rid')->field('cnname');
	}

	public function getinfo(){
		$resquest=Request::instance();
        $data=json_decode($resquest->post('data'),true);
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
		return $this->allowField(true)->save($data);
		//$existsdata=$this::where("cnname",$data['cnname'])->find();
		
		////重复添加数据，如果原数据有效，则提示错误
		////如果原数据为删除状态，则更新原数据
		//if($existsdata){
			//if($existsdata['status']=='1'){
				//$data['status']='0';
				//return $this->allowField(true)->save($data,['cnname'=>$data['cnname']]);
			//}else{
				//return false;
			//}
		//}else{
			//return $this->allowField(true)->save($data);
		//}
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

	//获取现任领导对应的教师信息：rid和cnname
	public function getLeaders(){
		$sql="select rid,cnname from zxcms_teachers where status=0 and exists(select 1 from zxcms_leaders where status=0 and iscurrent=0 and teacherid=zxcms_teachers.rid)";
		$data=Db::query($sql);
		return $data;
	}
}