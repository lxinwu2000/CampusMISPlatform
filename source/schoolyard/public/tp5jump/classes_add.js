//年级信息add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(classes)', function(data){			 
		  var rid=$('#classesrid').val()
		      ,data=JSON.stringify(data.field);
		  //alert(rid);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/classes/add','admin/classes/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/classes/edit','admin/classes/index');
		  }	  	    
	    return false;
	  });
});