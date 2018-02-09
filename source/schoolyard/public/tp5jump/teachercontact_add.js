//教师信息add/edit
layui.use('form', function(){
	  var form = layui.form;	     	    	    	    	       	     
	  form.on('submit(teachercontact)', function(data){		  
		  var rid=$('#teachercontrid').val()
		      ,data=JSON.stringify(data.field);	      
			  if(rid==''){
				  Ajaxalls(null,data,n,'admin/teachercontact/add','admin/teachercontact/index');
			  }else{
				  Ajaxalls(rid,data,1,'admin/teachercontact/edit','admin/teachercontact/index');
			  }	  	    		 
	    return false;
	  });
});


