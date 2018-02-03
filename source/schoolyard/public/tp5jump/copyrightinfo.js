//版权信息
layui.use('form', function(){
	  var form = layui.form;   
	  form.on('submit(copyrightinfo)', function(data){
		  var rid=$('#copyid').val()
		   ,data=JSON.stringify(data.field);		     
	      Ajaxalls(rid,data,1,'admin/Copyrightinfo/edit');  	    
	    return false;
	  });
});






