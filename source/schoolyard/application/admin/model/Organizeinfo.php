<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Organizeinfo extends Model{
    public function img(){
        $resquest=Request::instance();
        $file=$resquest->file('file');
        if (empty($file)){
            return false;
        }else {
            $ret = array();
            if ($_FILES["file"]["error"] > 0)
            {
                $ret["msg"] =  $_FILES["file"]["error"] ;
                $ret["code"] = 1;
                return $ret;
            }else{
                $pic =  $this->upload();
                if($pic['info']== 1){
                    $url =request()->root(true).'/uploads/'.'logo/'.$pic['savename'];
                    $logopath='/uploads/'.'logo/'.$pic['logopath'];
                    $ret["msg"]= "上传成功！";
                    $ret["code"] = 0;
                    $ret["src"] = $url;                 
                    return $ret;
                }              
            }
        }
    }
    
    public function getinfo(){
        $resquest=Request::instance();
        $info=json_decode($resquest->param('data'),true);
        $info['createtime']=date('Y-m-d H:i:s');
        $info['createuser']=session('user_id');
        $rid=input('post.id');
        $result=$this->allowField(true)->save($info,['rid'=>$rid]);
        if ($result){
            return true;
        }else {
            return false;
        }
    }
    
    private  function upload(){
        deldir('./uploads/logo');
        $rid=db('organizeinfo')->count();
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'logo');
        $reubfo = array();
        if($info){
            $reubfo['info']= 1;
            $reubfo['savename'] = $info->getSaveName();
            $reubfo['logopath']=$info->getSaveName();
            $data['logopath']='/uploads/'.'logo/'.$info->getSaveName();
            db('organizeinfo')->where('rid', $rid)->update($data);           
        }else{
            $reubfo['info']= 0;
            $reubfo['err'] = $file->getError();
        }
        return $reubfo;
    }
}
