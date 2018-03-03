//课程信息add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(students)', function(data){			 
		  var rid=$('#studentsrid').val()
		      ,data=JSON.stringify(data.field);						
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Students/add','admin/Students/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Students/edit','admin/Students/index');
		  }	  	    
	    return false;
	  });
});