//机构信息
layui.use(['form','upload'], function(){
	  var form = layui.form
	      ,upload=layui.upload;
	  var uploadInst = upload.render({
		    elem: '#logo' 
		    ,url: Root+'admin/Organizeinfo/edit' 
		    ,accept: 'images'
		    ,size:1024
		    ,before: function(obj){ 
		       layer.load(1); 
		      }
		    ,done: function(ret){
	    	 if(ret.code==0){ 		
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






