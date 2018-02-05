//职务信息add/edit
layui.use(['form','layedit'], function(){
	  var form = layui.form
	      ,layedit=layui.layedit;
	      var editIndex = layedit.build('positions_editor', {  
	          height: 150
	          ,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	      }); 	 
	      $("form").click(function(data) {	    	
	  	        layedit.sync(editIndex);    	       
	  	    });	 	    	       	     
	  form.on('submit(positions)', function(data){			 
		  var rid=$('#postrid').val()
		      ,data=JSON.stringify(data.field);						
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Positions/add','admin/Positions/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Positions/update','admin/Positions/index');
		  }	  	    
	    return false;
	  });
});
