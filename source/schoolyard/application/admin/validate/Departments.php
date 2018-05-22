<?php
//验证器Departments
namespace app\admin\Validate;
use think\Validate;
class Shop extends Validate{
    protected $rule = [
        'cnname'  =>  'chs|unique:departments',
    ];
    
    protected $message = [
        'cnname.chs'  =>  '只能用中文',
        'cnname.unique'=>'名称已经存在',
    ];
    
    protected $scene = [
        'add'   =>  ['cnname'],
    ];
   
}