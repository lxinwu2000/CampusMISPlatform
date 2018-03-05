//民意信息征集add、edit
layui.use(['form','laydate'],function(){
	var form = layui.form,laydate=layui.laydate;
	laydate.render({
		elem: '#fromdate'
		,type:'datetime'
	});
	laydate.render({
		elem: '#todate'
		,type:'datetime'	
	});
	form.on('submit(opinionpublish)',function(data){
		var rid=$('#opinionpublishrid').val()
		      ,data=JSON.stringify(data.field);
		if(rid==''){
			Ajaxalls(null,data,n,'admin/Opinionpublish/add','admin/Opinionpublish/index');
		}else{
			Ajaxalls(rid,data,1,'admin/Opinionpublish/edit','admin/Opinionpublish/index');
		}
		return false;
	});
});