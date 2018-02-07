//部门信息add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(departments)', function(data){			 
		  var rid=$('#departrid').val()
		      ,data=JSON.stringify(data.field);						
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Departments/add','admin/Departments/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Departments/edit','admin/Departments/index');
		  }	  	    
	    return false;
	  });
});