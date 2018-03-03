//课程信息add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(courses)', function(data){			 
		  var rid=$('#coursesrid').val()
		      ,data=JSON.stringify(data.field);						
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Courses/add','admin/Courses/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Courses/edit','admin/Courses/index');
		  }	  	    
	    return false;
	  });
});