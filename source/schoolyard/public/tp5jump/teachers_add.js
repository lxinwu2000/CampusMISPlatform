//教师信息add/edit
layui.use(['form','laydate','upload'], function(){
	  var form = layui.form
	      ,laydate=layui.laydate
	      ,upload=layui.upload;
	    laydate.render({
		    elem: '#birthday'
		    ,type: 'datetime'
		  });
	    laydate.render({
		    elem: '#entrydate'
		    ,type: 'datetime'
		  });
	    var uploadInst = upload.render({
		    elem: '#photopath' 
		    ,url: Root+'admin/Teachers/photopath' 
		    ,accept: 'images'
		    ,size:512
		    ,before: function(obj){ 
		       layer.load(1); 
		      }
		    ,done: function(ret){
	    	 if(ret.code==0){ 	
	             $('.teachersimg').show();
	             $('#teacherphotopath').html('<input type="text"  name="photopath" value="' + ret.photopath+ '"  autocomplete="off" class="layui-input">');	    		
	    		 $('#teachersimg').html('<img src="' + ret.src + '" width="80">');                         
                  layer.closeAll('loading'); 
                 }    		    			    			     
		    }
		    ,error: function(){
		    layer.msg('服务异常');
		    layer.closeAll('loading'); 
		    }
		  });	    
	    
	    	    	       	     
	  form.on('submit(teachers)', function(data){			 
		  var rid=$('#teachersrid').val()
		      ,data=JSON.stringify(data.field);						
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Teachers/add','admin/Teachers/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Teachers/update','admin/Teachers/index');
		  }	  	    
	    return false;
	  });
});
