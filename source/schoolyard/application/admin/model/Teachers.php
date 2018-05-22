<?php
namespace app\admin\model;
use think\Model;
use think\Db;
class Teachers extends Model{
    public function educationleve($level){
        $arr=array("博士后","博士","硕士","研究生","大学本科","大学专科（大专）","高中/职中/中专","初中","小学");
        return $arr[$level-1];
    }
    public function del(){
            $rid=input('post.id');
            if (!empty($rid)){
                $data['status']=1;
                $res=Db::name('teachers')->where('rid',$rid)->update($data);
                if ($res){
                    return  1;
                }
            }else {
                $rid=input('checkedid/a');
                $where['rid']=array('in',$rid);
                $data['status']=1;
                $res=Db::name('teachers')->where($where)->update($data);
                if ($res){
                    return  2;
                }
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
                    $url =request()->root(true).'/uploads/'.'teachers/'.$pic['savename'];
                    $photopath='/uploads/'.'teachers/'.$pic['photopath'];
                }  else {
                    $data["msg"] = $this->error($pic['err']);
                    $data["code"] = 1;
                }
                $data["msg"]= "上传成功！";
                $data["code"] = 0;
                $data["src"] = $url;
                $data["photopath"]=$photopath;
                return $data;
            }
       }
   }
   
   private  function upload(){
       $file = request()->file('file');
       $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'teachers');
       $reubfo = array();
       if($info){
           $reubfo['info']= 1;
           $reubfo['savename'] = $info->getSaveName();
           $reubfo['photopath']=$info->getSaveName();
       }else{
           $reubfo['info']= 0;
           $reubfo['err'] = $file->getError();;
       }
       return $reubfo;
   }
   
   
}