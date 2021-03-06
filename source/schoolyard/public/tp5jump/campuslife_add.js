//校园生活add、edit
layui.use(['form','upload','layedit'], function(){
	var form = layui.form,
		layedit=layui.layedit,
		upload=layui.upload;
	var	uploadInst=upload.render({
		elem: '#imgpath'
		,url: Root+'admin/Campuslife/add'
		,accept: 'images'
		,size:1024
		,before: function(obj){
			layer.load(1);
		}
		,done:function(ret){
			if(ret.code==0){
				$('.teachersimg').show();
				$('#teacherphotopath').html('<input type="text"  name="coverphoto" value="' + ret.src+ '"  autocomplete="off" class="layui-input">');
	    		$('#coverimg').html('<img src="' + ret.src + '" width="80">'); 
				layer.closeAll('loading');
			}
		}
		,error: function(){
			layer.msg('服务异常');
			layer.closeAll('loading');
		}
	});
	var editIndex = layedit.build('content', {  
	          height: 150
	          ,tool:['strong' ,'italic' ,'underline' ,'del'  ,'|'  ,'left' ,'center' ,'right' ,'link' ,'face']	
	});

	  form.on('submit(campuslife)', function(data){			 
		  var rid=$('#campusliferid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Campuslife/add','admin/Campuslife/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Campuslife/edit','admin/Campuslife/index');
		  }	  	    
	    return false;
	  });
});