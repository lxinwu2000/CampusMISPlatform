//机构信息
layui.use(['form','upload'], function(){
	  var form = layui.form
	      ,upload=layui.upload;
	  var uploadInst = upload.render({
		    elem: '#logo' 
		    ,url: Root+'admin/Organizeinfo/logo' 
		    ,accept: 'images'
		    ,size:1024
		    ,before: function(obj){ 
		       layer.load(1); 
		      }
		    ,done: function(ret){
	    	 if(ret.code==0){ 		
//	    		 $('#logopath').html('<input type="text"  name="logopath" value="' + ret.logopath + '"  autocomplete="off" class="layui-input">');
                 $('#showImg').html('<img src="' + ret.src + '" width="80">');          
                  layer.msg(ret.msg, {icon: 6}); 
                  layer.closeAll('loading'); 
                 }    		    			    			     
		    }
		    ,error: function(){
		    layer.msg('服务异常');
		    layer.closeAll('loading'); 
		    }
		  });	  
	  form.on('submit(organizeinfo)', function(data){
		  var rid=$('#editrid').val()
		      ,data=JSON.stringify(data.field);		  
	 Ajaxalls(rid,data,1,'admin/Organizeinfo/edit');  	    
	    return false;
	  });
});







//$.ajax({
//url: Root+'admin/Organizeinfo/edit',
//type: "post",
//data:{"data":JSON.stringify(data.field),"id":id},
//dataType: "json",			
//success: function(data){
//if(data.state==1){		
//layer.msg(data.msg, {icon: 6});		   		 				    		  
//}else{
//layer.msg(data.msg, {icon: 5});
//}
//},
//error:function(){
//	layer.msg('服务异常！');
//}			
//});
