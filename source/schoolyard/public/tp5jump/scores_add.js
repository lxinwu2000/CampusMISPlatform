//成绩管理add、edit
layui.use(['form','laydate'],function(){
	var form = layui.form,laydate=layui.laydate;
	laydate.render({
		elem: '#examdate'
		,type: 'datetime'
	});
	form.on('submit(scores)',function(data){
		var rid=$('#scoresrid').val(),data=JSON.stringify(data.field);
		if(rid==''){
			Ajaxalls(null,data,n,'admin/Scores/add','admin/Scores/index');
		}else{
			Ajaxalls(rid,data,1,'admin/Scores/edit','admin/Scores/index');
		}
		return false;
	});
});