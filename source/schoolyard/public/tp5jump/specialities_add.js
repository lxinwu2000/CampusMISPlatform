//年级信息add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(specialities)', function(data){			 
		  var rid=$('#specialitiesrid').val()
		      ,data=JSON.stringify(data.field);
		  //alert(rid);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/specialities/add','admin/specialities/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/specialities/edit','admin/specialities/index');
		  }	  	    
	    return false;
	  });
});