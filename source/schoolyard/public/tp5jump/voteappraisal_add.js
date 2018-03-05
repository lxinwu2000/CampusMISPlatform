//投票评优add、edit
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
	form.on('submit(voteappraisal)',function(data){
		var rid=$('#voteappraisalrid').val()
		      ,data=JSON.stringify(data.field);
		//alert(data);
		if(rid==''){
			Ajaxalls(null,data,n,'admin/Voteappraisal/add','admin/Voteappraisal/index');
		}else{
			Ajaxalls(rid,data,1,'admin/Voteappraisal/edit','admin/Voteappraisal/index');
		}
		return false;
	});
});