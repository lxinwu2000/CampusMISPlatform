<?php

namespace app\home\controller;

use think\Controller;

class IndexController  extends Controller{

    public function index() {
        $m=model('Index');
       $v=$m->test(4,9);
        echo $v;
    }

   

}
