<?php
namespace app\admin\controller;
class NewsController extends CommonController{
    public function index(){
        return $this->fetch();
    }
}