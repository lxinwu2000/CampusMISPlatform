<?php
namespace app\admin\controller;
use think\Request;
class OrganizeinfoController extends CommonController{
    public function index(){
       $res=db('organizeinfo')->find();
       $this->assign('orglist',$res);    
       return $this->fetch();
    }
    public function info(){
       return  $this->fetch();
    }   
    public function edit(){  
    $request=Request::instance();
    $info=json_decode($request->post('data'),true);
    $info['createtime']=date('Y-m-d H:i:s');
    $info['createuser']=session('user_id');
    $id=input('post.id');
    $res=db('organizeinfo')->where('rid', $id)->update($info);
    if ($res){
        $data['msg']='修改成功';
        $data['state']=1;
        return json($data);
    }else {
        $data['msg']='修改失败';
        $data['state']=0;
        return json($data);
    }
        
    }    
    public function logo(){      
        $ret = array();
        if ($_FILES["file"]["error"] > 0)
        {
            $ret["msg"] =  $_FILES["file"]["error"] ;
            $ret["code"] = 1;           
            return json($ret);
        }else{
            $pic =  $this->upload();
            if($pic['info']== 1){               
                $url =request()->root(true).'/public'.'/uploads/'.'logo/'.$pic['savename'];
                $logopath='/public'.'/uploads/'.'logo/'.$pic['logopath'];
            }  else {
                $ret["msg"] = $this->error($pic['err']);
                $ret["code"] = 1;
            }
            $ret["msg"]= "上传成功！";
            $ret["code"] = 0;
            $ret["src"] = $url;
            $ret["logopath"]=$logopath;
            return json($ret);
        }    
    }
    private  function upload(){
        deldir('./public/uploads/logo');
        $rid=db('organizeinfo')->count();
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'logo');
        $reubfo = array();
        if($info){
            $reubfo['info']= 1;
            $reubfo['savename'] = $info->getSaveName();
            $reubfo['logopath']=$info->getSaveName();
            $data['logopath']='/public'.'/uploads/'.'logo/'.$info->getSaveName();
            db('organizeinfo')->where('rid', $rid)->update($data);           
        }else{
            $reubfo['info']= 0;
            $reubfo['err'] = $file->getError();;
        }
        return $reubfo;
    }
    
}