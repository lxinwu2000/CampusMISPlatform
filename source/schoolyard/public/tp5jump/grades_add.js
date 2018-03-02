//年级信息add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(grades)', function(data){			 
		  var rid=$('#gradesrid').val()
		      ,data=JSON.stringify(data.field);						
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Grades/add','admin/Grades/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Grades/edit','admin/Grades/index');
		  }	  	    
	    return false;
	  });
});