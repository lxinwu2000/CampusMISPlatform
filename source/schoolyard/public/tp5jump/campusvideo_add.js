//校园视频add、edit
layui.use(['form','upload','layedit'], function(){
	var form = layui.form,
		layedit=layui.layedit,
		upload=layui.upload;
	var	uploadInst=upload.render({
		elem: '#fileupload'
		,url: Root+'admin/Campusvideo/add'
		,accept: 'video'
		//小于等于2M
		,size:2048
		,before: function(obj){
			layer.load(1);
		}
		,done:function(ret){
			if(ret.code==0){
				$("#filename").val(ret.filename);
				$("#filepath").val(ret.src);
				layer.closeAll('loading');
			}
		}
		,error: function(){
			layer.msg('服务异常');
			layer.closeAll('loading');
		}
	});
	var editIndex = layedit.build('contents', {  
	          height: 150
	          ,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	});

	  form.on('submit(campusvideo)', function(data){			 
		  var rid=$('#campusvideorid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Campusvideo/add','admin/Campusvideo/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Campusvideo/edit','admin/Campusvideo/index');
		  }	  	    
	    return false;
	  });
});