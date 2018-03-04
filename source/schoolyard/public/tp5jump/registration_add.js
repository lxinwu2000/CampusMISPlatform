//领导信息add、edit
layui.use(['form','laydate','layedit'], function(){
	var form = layui.form,laydate=layui.laydate,
	layedit=layui.layedit;
	var editIndex = layedit.build('achievement', {  
	          height: 150
	          ,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	      });
	var textIndex = layedit.build('introduce', {  
	          height: 150
	          ,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	      });
	laydate.render({
		    elem: '#servicefrom'
		    ,type: 'datetime'
	});
	laydate.render({
		    elem: '#serviceto'
		    ,type: 'datetime'
	});
	$("form").click(function(data) {	    	
	  	        layedit.sync(editIndex);
				layedit.sync(textIndex);
	});
	  form.on('submit(leaders)', function(data){			 
		  var rid=$('#leadersrid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Registration/add','admin/Registration/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Registration/edit','admin/Registration/index');
		  }	  	    
	    return false;
	  });
});