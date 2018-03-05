//校长信箱add、edit
layui.use('form', function(){
	  var form = layui.form;	         	       	     
	  form.on('submit(mailboxs)', function(data){			 
		  var rid=$('#mailboxsrid').val()
		      ,data=JSON.stringify(data.field);
		  //alert(rid);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Mailboxs/add','admin/Mailboxs/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Mailboxs/edit','admin/Mailboxs/index');
		  }	  	    
	    return false;
	  });
});