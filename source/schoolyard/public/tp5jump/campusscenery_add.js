//校园风光add、edit
layui.use(['form','upload','layedit'], function(){
	var form = layui.form,
		layedit=layui.layedit,
		upload=layui.upload;
	var	uploadInst=upload.render({
		elem: '#imgpath'
		,url: Root+'admin/Campusscenery/add'
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

	  form.on('submit(campusscenery)', function(data){			 
		  var rid=$('#campussceneryrid').val()
		      ,data=JSON.stringify(data.field);
		  if(rid==''){
			  Ajaxalls(null,data,n,'admin/Campusscenery/add','admin/Campusscenery/index');
		  }else{
			  Ajaxalls(rid,data,1,'admin/Campusscenery/edit','admin/Campusscenery/index');
		  }	  	    
	    return false;
	  });
});