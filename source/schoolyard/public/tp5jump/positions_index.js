//职务信息index

//教师信息index
layui.use('table', function(){
  var table = layui.table;
 
  table.render({    //表格渲染 
     elem: '#positionstable'
    ,url:Root+'admin/Positions/json'
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
      ,{field:'cnname', width:150, title: '中文名',align:'center'}
      ,{field:'enname', width:150, title: '英文名',align:'center'}    
      ,{field:'remark', minWidth:80, title: '备注',align:'center'}    
      ,{field:'right',width:250, title: '操作',toolbar:"#barDemob"}
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
	    	 Ajaxalls(rid,null,2,'admin/Positions/delete');
	    	 obj.del();
	      });
	    } 
	 //编辑
	   else if(obj.event === 'edit'){
		   window.location.href="edit?rid="+rid;	    	
	    		    	
	    }else if(obj.event ==='lookintro'){
	    	 $.ajax({
		 			url : Root+"admin/Positions/json",
		 			type : "get",
		 			data:{"rid":rid},
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
		 						  content: '<p style="margin:10px;">'+data.introduce+'</p>'
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
		      var demoReload = $('#demoReloadb');
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
        		 			url : Root+"admin/Positions/delete",
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





























//layui.use(['laypage', 'layer'], function(){
//	  var laypage = layui.laypage
//	  ,layer = layui.layer;
//	  laypage.render({
//	     elem: 'pagelist'
//	    ,count:document.getElementById('countid').value
//	    ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
//	    ,limit:10
//	    ,jump: function(obj){	
//    //	  	加载loading
//	   var index1=layer.load(1);
//	   var htmls='';
//	   $.ajax({
//			url: Root+'admin/Positions/json',
//			type: "get",
//			data:{"page":obj.curr,"limit":10},
//			dataType: "json",			
//			success: function(res){
//			if(res.code==0){		
//			 layer.close(index1);
//			 var data=res.data;
//		    $.each(data,function(i,item){	 
//			  htmls+='<tr id="parent'+item.rid+'">'
//		      +'<td><input type="checkbox" class="ace" value="'+item.rid+'"/><span class="lbl"></span></td>'
//		      +'<td>'+Number(i+1)+'</td>'
//		      +'<td>'+item.cnname+'</td>'
//		      +'<td>'+item.enname+'</td>'
//		      +'<td>右边查看简介</td>'
//		      +'<td>'+item.remark+'</td>'
//		      +'<td>'
//		      +'<div class="layui-btn-group">'
//		      +'<button class="layui-btn layui-btn-normal layui-btn-xs" onclick="editone('+item.rid+')">'
//		      +'<i class="layui-icon">&#xe642;</i>'
//		      +'</button>'
//		      +'<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="delone('+item.rid+')">'
//		      +'<i class="layui-icon">&#xe640;</i>'
//		      +'</button>' 
//		      +'<button class="layui-btn  layui-btn-xs" onclick="lookinfo('+item.rid+')">'
//		      +'查看查看简介'
//		      +'</button>'  
//		      +'</div>'
//		      +'</td>'
//		      +'</tr>';
//		    });
//		    $('#poslist').html(htmls);
//		   }		
//		},
//		error:function(){
//	    layer.msg('服务异常');	
//			
//		}			
//		});		
//	   
//	  }
//	  }); 
//	});
//function search(){
//	var str=$('#search').val();	
//	layui.use(['laypage', 'layer'], function(){
//		  var laypage = layui.laypage
//		  ,layer = layui.layer;
//		  laypage.render({
//		     elem: 'pagelist'
//		    ,count:1
//		    ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
//		    ,limit:10
//		    ,jump: function(obj){	
//	    //	  	加载loading
//		   var index1=layer.load(1);
//		   var htmls='';
//		   $.ajax({
//				url: Root+'admin/Positions/json',
//				type: "get",
//				data:{"page":obj.curr,"limit":10,"search":str},
//				dataType: "json",			
//				success: function(res){
//				if(res.code==0){		
//				 layer.close(index1);
//				 var data=res.data;
//				 console.log(data);
//			    $.each(data,function(i,item){	 
//				  htmls+='<tr>'
//			      +'<td><input type="checkbox" class="ace" value="'+item.rid+'"/><span class="lbl"></span></td>'
//			      +'<td>'+Number(i+1)+'</td>'
//			      +'<td>'+item.cnname+'</td>'
//			      +'<td>'+item.enname+'</td>'
//			      +'<td>右边查看简介</td>'
//			      +'<td>'+item.remark+'</td>'
//			      +'<td>'
//			      +'<div class="layui-btn-group">'
//			      +'<button class="layui-btn layui-btn-normal layui-btn-xs" onclick="editone('+item.rid+')">'
//			      +'<i class="layui-icon">&#xe642;</i>'
//			      +'</button>'
//			      +'<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="delone('+item.rid+')">'
//			      +'<i class="layui-icon">&#xe640;</i>'
//			      +'</button>' 
//			      +'<button class="layui-btn  layui-btn-xs">'
//			      +'查看简介'
//			      +'</button>'  
//			      +'</div>'
//			      +'</td>'
//			      +'</tr>';
//			    });
//			    $('#poslist').html(htmls);
//			   }		
//			},
//			error:function(){
//		    layer.msg('服务异常');	
//				
//			}			
//			});		
//		   
//		  }
//		  }); 
//		});
//}
//
////删除
//function delone(id){
//	var rid=id;
//	layer.confirm('真的删除这条数据吗', function(index){ 
//		 Ajaxalls(rid,null,2,'admin/Positions/delete','admin/Positions/index');
//	// 同步删除(去掉上面'admin/Positions/index')即可同步删除不会刷新页面加上以下代码
////		 var parentid='#'+'parent'+rid;
////		 $(parentid).remove();
//	 });
//	
//}
//
//function editone(id){
//	var rid=id;
//	window.location.href="edit?rid="+rid;
//	
//}
//
//function lookinfo(rid){
//	$.ajax({
//		url:Root+'admin/Positions/lookinfo',
//		type: "get",
//		data:{"rid":rid},
//		dataType: "json"				
//	});		
//	var url=Root+'admin/Positions/lookinfo?rid='+rid;
//	x_admin_show('简介',url,'700','450');	
//}















//var conutid="";
//function set(ids){
//	conutid= ids;
//}
//$.ajaxSetup({async:false});
//$.ajax({
//    url:Root+'admin/Positions/hasids',
//    type: 'get',
//    data:{"search":str},
//    dataType: 'json',
//    cache : false,
//    success: function(res){
//        set(res.hasids);
//       }
//});
