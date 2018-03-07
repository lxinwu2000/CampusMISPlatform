//应聘信息add、edit
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
	    ,url: Root+'admin/Candidates/add'
	    ,accept: 'file'
		,exts:'docx|doc|pdf'
	    ,size:2048
	    ,before: function(obj){ 
	       layer.load(1); 
	      }
	    ,done: function(ret){
	    	 if(ret.code==0){
				 $("#uploadres").html("上传成功");
				 $('#filepath').val(ret.src);
                  layer.closeAll('loading'); 
                 }    		    			    			     
		    }
	    ,error: function(){
	    layer.msg('服务异常');
	    layer.closeAll('loading'); 
	    }
	  });	
	  form.on('submit(candidates)', function(data){			 
		  var rid=$('#candidatesrid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Candidates/add','admin/Candidates/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Candidates/edit','admin/Candidates/index');
		  }	  	    
	    return false;
	  });
});