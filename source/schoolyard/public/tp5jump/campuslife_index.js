//校园生活index
layui.use('table', function(){
  var table = layui.table;
 
  table.render({    //表格渲染 
     elem: '#positionstable'
    ,url:Root+'admin/Campuslife/json'
    ,height: 'full-150'   
    ,cellMinWidth: 80 
    ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
     layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局      
     ,limit: 10//默认 值
     ,curr: 1 //设定初始在第 1 页
     ,groups: 5 //只显示 1 个连续页码
     ,first: true //不显示首页false
     ,last: true //不显示尾页false
      
    }    
    ,cols: [[
	   {type:'numbers',title:'记录号',width:80}
	  ,{type:'checkbox'}
      ,{field:'rid', width:80, title: 'ID', sort: true,align:'center',unresize: true}
	  ,{field:'author', width:100, title: '作者',align:'center'}
      ,{field:'title', width:80, title: '标题',align:'center'}
      ,{field:'summary', width:150, title: '摘要',align:'center'}
      ,{field:'keywords', width:150, title: '关键字',align:'center'}
      ,{field:'contents', width:150, title: '内容',align:'center'}
      ,{field:'coverphoto', width:150, title: '封面图片',align:'center'}
      ,{field:'remark', minWidth:150, title: '备注',align:'center'}    
      ,{field:'right',width:260, title: '操作',toolbar:"#barDemob"}
    ]] 
    ,id: 'table_b'//重载表格唯一id
  });
  table.on('checkbox(Idtableb)', function(obj){		 
	 /*  console.log(obj); */
  });
  table.on('tool(Idtableb)', function(obj){
	    var rid =obj.data.rid;
	    //删除
	   if(obj.event === 'del'){
	      layer.confirm('真的删除这条数据么', function(index){	    		    	
	    	 Ajaxalls(rid,null,2,'admin/Campuslife/delete');
//	    	 obj.del();
	    	
	      });
	    } 
	 //编辑
	   else if(obj.event === 'edit'){
		   window.location.href="edit?rid="+rid;	    	
	    		    	
	    }
	   else if(obj.event ==='achievement'){
	    	 $.ajax({
		 			url : Root+"admin/Campuslife/json",
		 			type : "get",
		 			data:{"rid":rid,"operation":1},
		 			dataType: "json",
		 			success: function(data){
		 				if(data.state==1){
		 					layer.open({
		 						  type: 1,
		 						  title:data.cnname+'的事迹',
		 						  skin: 'layui-layer-demo',
		 						  closeBtn: 1,
		 						  shadeClose: true,
		 						  shade: 0.4,
		 						  area: ['700px', '450px'], 						 
		 						  content: '<div style="margin:15px;">'+data.achievement+'</div>'
		 						});				  				
		 				}else{
		 				layer.msg(data.msg, {icon: 5});
		 				}
		 			},
		 		});	
		    }
	   else if(obj.event ==='lintroduce'){
	    	 $.ajax({
		 			url : Root+"admin/Campuslife/json",
		 			type : "get",
		 			data:{"rid":rid,"operation":2},
		 			dataType: "json",
		 			success: function(data){
		 				if(data.state==1){
		 					layer.open({
		 						  type: 1,
		 						  title:data.cnname+'的简介',
		 						  skin: 'layui-layer-demo',
		 						  closeBtn: 1,
		 						  shadeClose: true,
		 						  shade: 0.4,
		 						  area: ['700px', '450px'], 						 
		 						  content: '<div style="margin:15px;">'+data.introduce+'</div>'
		 						});				  				
		 				}else{
		 				layer.msg(data.msg, {icon: 5});
		 				}
		 			},
		 		});	
		    }
	  });
  var $ = layui.$, active = {
		    reload: function(){
		      var demoReload = $('#demoReload');
		      table.reload('table_b', {
		        page: {
		          curr: 1 
		        }
		      //关键词搜索
		        ,where: {
		          key:demoReload.val()         
		        }
		      });
		    }
  //批量获取要删除的id
         ,getCheckid:function(){
        	 var checkStatus = table.checkStatus('table_b')
             ,data = checkStatus.data;
        	 var checkedid=new Array();
        	 for(i=0;i<data.length;i++){
        		 checkedid[i]=data[i].rid;
        	 }       	         	        	        	        	         	         	        	         	        	 
        	 if(checkedid.length=='0'){
        		 layer.msg('你没有选择要删除的数据',{icon:5});
        	 }else{
        		 //ajax从数据库删除
        		 layer.confirm('真的删除这些数据吗', function(index){       		    	
        		    	 $.ajax({
        		 			url : Root+"admin/Campuslife/delete",
        		 			type : "post",
        		 			data:{"checkedid":checkedid},
        		 			dataType: "json",
        		 			success: function(data){
        		 				if(data.state==1){
        		 					layer.msg(data.msg, {icon: 6});
        		 					//同步删除表格的数据
        		 					 for(i=0;i<checkedid.length;i++){        		 
        		 		        		 $('td[data-field=rid]').each(function(){
        		 		        			    if($(this).text()==checkedid[i]){
        		 		        			    	 var index_id = $(this).parent('tr').attr('data-index');
        		 		                             $('tr[data-index=' + index_id + ']').remove();
        		 		        			    }
        		 		        	     });               		             						                       			         		 
        		 		        	 }
        		 				     layer.close(index);				  				
        		 				}else{
        		 				layer.msg(data.msg, {icon: 5});
        		 				}
        		 			},
        		 		});	      
        		      });
        	 }        	
           
       }
 };	 
  $('.demoTableb .layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });
    
});

