//文件管理add、edit
layui.use(['form','upload'], function(){
	var form = layui.form,
		//laydate=layui.laydate,
		//layedit=layui.layedit,
		upload=layui.upload;
	//var editIndex = layedit.build('achievement', {  
	          //height: 150
	          //,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	      //});
	//var textIndex = layedit.build('introduce', {  
	          //height: 150
	          //,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	      //});
	//laydate.render({
		    //elem: '#servicefrom'
		    //,type: 'datetime'
	//});
	//laydate.render({
		    //elem: '#serviceto'
		    //,type: 'datetime'
	//});
	//$("form").click(function(data) {	    	
	  	        //layedit.sync(editIndex);
				//layedit.sync(textIndex);
	//});
	var uploadInst = upload.render({
	    elem: '#file' 
	    ,url: Root+'admin/Files/add'
	    ,accept: 'file'
	    ,size:10240
	    ,before: function(obj){ 
	       layer.load(1); 
	      }
	    ,done: function(ret){
	    	 if(ret.code==0){ 	
	             $('#filename').val(ret.filename);
				 $('#filepath').val(ret.filepath);
	    		 //$('#teachersimg').html('<img src="' + ret.src + '" width="80">');                         
				 //$("#filename").html("");
                  layer.closeAll('loading'); 
                 }    		    			    			     
		    }
	    ,error: function(){
	    layer.msg('服务异常');
	    layer.closeAll('loading'); 
	    }
	  });	
	  form.on('submit(files)', function(data){			 
		  var rid=$('#filesrid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Files/add','admin/Files/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Files/edit','admin/Files/index');
		  }	  	    
	    return false;
	  });
});