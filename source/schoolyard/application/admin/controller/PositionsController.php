<?php
namespace app\admin\controller;


use think\Request;

class PositionsController extends CommonController{
    public function index(){ 
       $this->assign('countid',db('positions')->where('status',0)->count());
       return  $this->fetch();
    }
    public function json(){
        $limit=input('get.limit');
        $page=input('get.page');
        $pages=($page-1)*$limit;
        $search='%'.input('get.search').'%';
        $where['cnname|enname']=array('like',$search);       
        $list=db('positions')->limit($pages,$limit)->where($where)->where('status',0)->select();
        $res=array();       
        $res['data']=$list;
        $res['code']=0;
        return json($res);
    }

    public function deleteall(){
        $rid=input('post.data/a');
        $where['rid']=array('in',$rid);
        $data['status']=1;
        $res=db('positions')->where($where)->update($data);
        if ($res){
            $data['msg']='批量删除成功';
            $data['state']=1;
            return json($data);
        }else {
            $data['msg']='批量删除失败';
            $data['state']=0;
            return json($data);
        }
    }
    public function info(){      
        return  $this->fetch();
    }
    public function add(){
        $request=Request::instance();      
        $data=json_decode($request->post('data'),true);
        $where['cnname']=$data['cnname'];
        $result=db('positions')->where($where)->find();
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
        $res=db('positions')->insert($data);
        if($result){
            $data['msg']='姓名已存在！';
            $data['state']=0;
            return json($data);
        }else {
            if ($res){
                $data['msg']='添加成功';
                $data['state']=1;
                return json($data);
            }else {
                $data['msg']='添加失败';
                $data['state']=0;
                return json($data);
            }
        }
       
    }
    public function edit(){
        $rid=input('get.rid');
        $res=db('positions')->where('rid',$rid)->find();
        $this->assign('editone',$res);
        return $this->fetch('info');
    }
    
    public function update(){
        $request=Request::instance();
        $data=json_decode($request->post('data'),true);
        $rid=input('post.id');
        $data['createtime']=date('Y-m-d H:i:s');
        $data['createuser']=session('user_id');
        $res=db('positions')->where('rid',$rid)->update($data);      
            if ($res){
                $data['msg']='更新成功';
                $data['state']=1;
                return json($data);
            }else {
                $data['msg']='更新失败';
                $data['state']=0;
                return json($data);
            }
        
    }
    
    public function lookinfo(){
        $rid=input('get.rid');
        $res=db('positions')->where('rid',$rid)->find();
        $this->assign('info',$res);
        return $this->fetch('intro');      
        
    }
    
    public function delete(){
        $rid=input('post.id');
        $data['status']=1;
        $res=db('positions')->where('rid',$rid)->update($data);
        if ($res){
            $data['msg']='删除成功';
            $data['state']=1;
            return json($data);
        }else {
            $data['msg']='删除失败';
            $data['state']=0;
            return json($data);
        }
    }
}

//     public function hasids(){
//         $search='%'.input('get.search').'%';
//         $where['cnname|enname']=array('like',$search);
//         if($search==''){
//             $ids=db('positions')->where('status',0)->count();
//             $res['hasids']=$ids;
//             return json($res);
//         }else {
//             $ids=db('positions')->where($where)->where('status',0)->count();
//             $res['hasids']=$ids;
//             return json($res);
//         }

//     }