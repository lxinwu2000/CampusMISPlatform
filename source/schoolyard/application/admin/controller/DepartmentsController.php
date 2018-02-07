<?php
namespace app\admin\controller;
use app\admin\controller\CommonController;

class DepartmentsController extends CommonController{
    public function index(){      
       return  $this->fetch();       
    }
    
   public  function add(){
       if(request()->isPost()){
       
       }else {     
       return $this->fetch('info');
      }
   }
}