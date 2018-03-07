//招聘计划add、edit
layui.use(['form','laydate'], function(){
	  var form = layui.form,laydate=layui.laydate;
	  laydate.render({
		elem: '#fromdate',type: 'datetime'
	  });
	  laydate.render({
		elem: '#todate',type: 'datetime'
	  });
	  form.on('submit(recruitplan)', function(data){			 
		  var rid=$('#recruitplanrid').val()
		      ,data=JSON.stringify(data.field);
		  //alert(rid);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/recruitplan/add','admin/recruitplan/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/recruitplan/edit','admin/recruitplan/index');
		  }	  	    
	    return false;
	  });
});