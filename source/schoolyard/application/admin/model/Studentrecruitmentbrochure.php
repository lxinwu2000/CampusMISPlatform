<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Studentrecruitmentbrochure extends Model{
	public function getinfo(){
		$resquest=Request::instance();
        $data=json_decode($resquest->post('data'),true);
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
		$existsdata=$this::where("cnname",$data['cnname'])->find();
		
		//重复添加数据，如果原数据有效，则提示错误
		//如果原数据为删除状态，则更新原数据
		if($existsdata){
			if($existsdata['status']=='1'){
				$data['status']='0';
				return $this->allowField(true)->save($data,['cnname'=>$data['cnname']]);
			}else{
				return false;
			}
		}else{
			return $this->allowField(true)->save($data);
		}
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

	//上传照片
   public function img(){
       $file = request()->file('file');
       if (empty($file)){
           return false;
       }else {
        $data = array();
            if ($_FILES["file"]["error"] > 0){
                $data["msg"] =  $_FILES["file"]["error"] ;
                $data["code"] = 1;
                return $data;
            }else{
                $pic =  $this->upload();
                if($pic['info']== 1){
                    $url =request()->root(true).'/public'.'/uploads/'.'studentrecruitmentbrochure/'.$pic['savename'];
                    $imgpath='/public'.'/uploads/'.'studentrecruitmentbrochure/'.$pic['imgpath'];
                }  else {
                    $data["msg"] = $this->error($pic['err']);
                    $data["code"] = 1;
                }
                $data["msg"]= "上传成功！";
                $data["code"] = 0;
                $data["src"] = $url;
                $data["imgpath"]=$imgpath;
                return $data;
            }
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
    
    private  function upload(){
       
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'studentrecruitmentbrochure');
        $reubfo = array();
        if($info){
            $reubfo['info']= 1;
            $reubfo['savename'] = $info->getSaveName();
            $reubfo['imgpath']=$info->getSaveName();
            $data['imgpath']='/public'.'/uploads/'.'studentrecruitmentbrochure/'.$info->getSaveName();
        }else{
            $reubfo['info']= 0;
            $reubfo['err'] = $file->getError();
        }
        return $reubfo;
    }
}