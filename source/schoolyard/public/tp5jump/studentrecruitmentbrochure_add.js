//招生简章add、edi

layui.use(['form','layedit','upload'], function(){
	var form = layui.form
		,layedit=layui.layedit
	    ,upload=layui.upload; 
	var uploadInst = upload.render({
	    elem: '#imgpath' 
	    ,url: Root+'admin/Studentrecruitmentbr/add'
	    ,accept: 'images'
	    ,size:1024
	    ,before: function(obj){ 
	       layer.load(1); 
	      }
	    ,done: function(ret){
	    	 if(ret.code==0){ 	
	             $('.teachersimg').show();
	             $('#teacherphotopath').html('<input type="text"  name="imgpath" value="' + ret.imgpath+ '"  autocomplete="off" class="layui-input">');	    		
	    		 $('#teachersimg').html('<img src="' + ret.src + '" width="80">');                         
                  layer.closeAll('loading'); 
                 }    		    			    			     
		    }
	    ,error: function(){
	    layer.msg('服务异常');
	    layer.closeAll('loading'); 
	    }
	  });	  
	var editIndex = layedit.build('content', {  
	          height: 150
	          ,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	      });
	$("form").click(function(data) {	    	
	  	        layedit.sync(editIndex);
	});

	  form.on('submit(studentrecruitmentbrochure)', function(data){			 
		  var rid=$('#studentrecruitmentbrochurerid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Studentrecruitmentbr/add','admin/Studentrecruitmentbr/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Studentrecruitmentbr/edit','admin/Studentrecruitmentbr/index');
		  }	  	    
	    return false;
	  });
});