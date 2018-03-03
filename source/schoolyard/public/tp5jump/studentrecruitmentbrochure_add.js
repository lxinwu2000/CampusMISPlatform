//招生简章add、edit
layui.use(['form','layedit'], function(){
	var form = layui.form,
		layedit=layui.layedit;
	var editIndex = layedit.build('content', {  
	          height: 150
	          ,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	      });
	$("form").click(function(data) {	    	
	  	        layedit.sync(editIndex);
	});

	  form.on('submit(studentrecruitmentbrochure)', function(data){			 
		  var rid=$('#studentrecruitmentbrochurerid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Studentrecruitmentbr/add','admin/Studentrecruitmentbr/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Studentrecruitmentbr/edit','admin/Studentrecruitmentbr/index');
		  }	  	    
	    return false;
	  });
});