//部门信息add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(teacherintroduce)', function(data){			 
		  var rid=$('#teacherintroducerid').val()
		      ,data=JSON.stringify(data.field);						
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Teacherintroduce/add','admin/Teacherintroduce/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Teacherintroduce/edit','admin/Teacherintroduce/index');
		  }	  	    
	    return false;
	  });
});