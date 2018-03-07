//发展历程add、edit
layui.use(['form','laydate'], function(){
	var form = layui.form,
		laydate=layui.laydate;
	laydate.render({
		elem: '#eventdate'
		,type: 'datetime'
	});
	form.on('submit(developmenthis)', function(data){			 
	  var rid=$('#developmenthisrid').val()
		  ,data=JSON.stringify(data.field);
	  //alert(rid);
	  if(rid==''){
		  Ajaxalls(null,data,n,'admin/Developmenthis/add','admin/Developmenthis/index');
	  }else{
		  Ajaxalls(rid,data,1,'admin/Developmenthis/edit','admin/Developmenthis/index');
	  }	  	    
	return false;
	});
});