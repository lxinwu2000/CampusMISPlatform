//全局根目录
var Root="";
Root='/'+'schoolyard'+'/';

//layui
layui.use(['element','layer'], function(){
  var $ = layui.jquery;
  var element = layui.element;
  layer=layui.layer;  
});

//全局ajax新增和编辑及删除
//id 表字段的id
//n 操作如add(无)、edit(1)、delete(2)默认是add 
//data 数据
//url 接口

//调用示列 edit ：Ajaxalls(rid,data,1,'admin/Organizeinfo/edit'); 
//      add ：Ajaxalls(rid,data,n,'admin/Organizeinfo/add'); 
//      delete ：Ajaxalls(rid,data,2,'admin/Organizeinfo/delete');

//后台示列
//public function edit(){  
//    $request=Request::instance();
//    $info=json_decode($request->post('data'),true);
//    $info['createtime']=date('Y-m-d H:i:s');
//    $info['createuser']=session('user_id');
//    $id=input('post.id');
//    $res=db('organizeinfo')->where('rid', $id)->update($info);
//    if ($res){       
//        $data['state']=1;
//        return json($data);
//    }else {
//        $data['state']=0;
//        return json($data);
//    }
//        
//    }    

var id,data,n,path;
function Ajaxalls(id,data,n,path){
	id=Number(id);
	if(id==0){
	 return false;
	}else{
		id=Number(id);
	}
	switch(n)
	{	
	case 1:	
	$.ajax({
			url:Root+path,
			type: "post",
			data:{"data":data,"id":id},
			dataType: "json",			
			success: function(data){
			if(data.state==1){		
			 layer.msg('修改成功！',{icon:6,time:1000});		   		 				    		  
			}else{
			layer.msg('修改失败！',{icon:5,time:1000});	
			}
			},
			error:function(){
			layer.msg('服务异常');				
		    }			
		});		
	  break;
	case 2:	
		$.ajax({
			url:Root+path,
			type: "post",
			data:{"id":id},
			dataType: "json",			
			success: function(data){
				if(data.state==1){		
					 layer.msg('删除成功！',{icon:6,time:1000});		   		 				    		  
					}else{
					layer.msg('删除失败！',{icon:5,time:1000});	
					}
					},
					error:function(){
					layer.msg('服务异常');				
				    }			
		});		
	  break;
	default:			
	 $.ajax({
			url:Root+path,
			type: "post",
			data:{"data":data},
			dataType: "json",			
			success: function(data){
				if(data.state==1){		
					 layer.msg('添加成功！',{icon:6,time:1000});		   		 				    		  
					}else{
					layer.msg('添加失败！',{icon:5,time:1000});	
					}
					},
					error:function(){
					layer.msg('服务异常');				
				    }			
		});		
	}
		
}