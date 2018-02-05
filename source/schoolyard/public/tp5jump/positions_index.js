//职务信息index
layui.use(['laypage', 'layer'], function(){
	  var laypage = layui.laypage
	  ,layer = layui.layer;
	  laypage.render({
	     elem: 'pagelist'
	    ,count:document.getElementById('countid').value
	    ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
	    ,limit:10
	    ,jump: function(obj){	
    //	  	加载loading
	   var index1=layer.load(1);
	   var htmls='';
	   $.ajax({
			url: Root+'admin/Positions/json',
			type: "get",
			data:{"page":obj.curr,"limit":10},
			dataType: "json",			
			success: function(res){
			if(res.code==0){		
			 layer.close(index1);
			 var data=res.data;
		    $.each(data,function(i,item){	 
			  htmls+='<tr id="parent'+item.rid+'">'
		      +'<td><input type="checkbox" class="ace" value="'+item.rid+'"/><span class="lbl"></span></td>'
		      +'<td>'+Number(i+1)+'</td>'
		      +'<td>'+item.cnname+'</td>'
		      +'<td>'+item.enname+'</td>'
		      +'<td>右边查看简介</td>'
		      +'<td>'+item.remark+'</td>'
		      +'<td>'
		      +'<div class="layui-btn-group">'
		      +'<button class="layui-btn layui-btn-normal layui-btn-xs" onclick="editone('+item.rid+')">'
		      +'<i class="layui-icon">&#xe642;</i>'
		      +'</button>'
		      +'<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="delone('+item.rid+')">'
		      +'<i class="layui-icon">&#xe640;</i>'
		      +'</button>' 
		      +'<button class="layui-btn  layui-btn-xs" onclick="lookinfo('+item.rid+')">'
		      +'查看查看简介'
		      +'</button>'  
		      +'</div>'
		      +'</td>'
		      +'</tr>';
		    });
		    $('#poslist').html(htmls);
		   }		
		},
		error:function(){
	    layer.msg('服务异常');	
			
		}			
		});		
	   
	  }
	  }); 
	});
function search(){
	var str=$('#search').val();	
	layui.use(['laypage', 'layer'], function(){
		  var laypage = layui.laypage
		  ,layer = layui.layer;
		  laypage.render({
		     elem: 'pagelist'
		    ,count:1
		    ,layout: ['count', 'prev', 'page', 'next', 'limit', 'skip']
		    ,limit:10
		    ,jump: function(obj){	
	    //	  	加载loading
		   var index1=layer.load(1);
		   var htmls='';
		   $.ajax({
				url: Root+'admin/Positions/json',
				type: "get",
				data:{"page":obj.curr,"limit":10,"search":str},
				dataType: "json",			
				success: function(res){
				if(res.code==0){		
				 layer.close(index1);
				 var data=res.data;
				 console.log(data);
			    $.each(data,function(i,item){	 
				  htmls+='<tr>'
			      +'<td><input type="checkbox" class="ace" value="'+item.rid+'"/><span class="lbl"></span></td>'
			      +'<td>'+Number(i+1)+'</td>'
			      +'<td>'+item.cnname+'</td>'
			      +'<td>'+item.enname+'</td>'
			      +'<td>右边查看简介</td>'
			      +'<td>'+item.remark+'</td>'
			      +'<td>'
			      +'<div class="layui-btn-group">'
			      +'<button class="layui-btn layui-btn-normal layui-btn-xs" onclick="editone('+item.rid+')">'
			      +'<i class="layui-icon">&#xe642;</i>'
			      +'</button>'
			      +'<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="delone('+item.rid+')">'
			      +'<i class="layui-icon">&#xe640;</i>'
			      +'</button>' 
			      +'<button class="layui-btn  layui-btn-xs">'
			      +'查看简介'
			      +'</button>'  
			      +'</div>'
			      +'</td>'
			      +'</tr>';
			    });
			    $('#poslist').html(htmls);
			   }		
			},
			error:function(){
		    layer.msg('服务异常');	
				
			}			
			});		
		   
		  }
		  }); 
		});
}

//删除
function delone(id){
	var rid=id;
	layer.confirm('真的删除这条数据吗', function(index){ 
		 Ajaxalls(rid,null,2,'admin/Positions/delete','admin/Positions/index');
	// 同步删除(去掉上面'admin/Positions/index')即可同步删除不会刷新页面加上以下代码
//		 var parentid='#'+'parent'+rid;
//		 $(parentid).remove();
	 });
	
}

function editone(id){
	var rid=id;
	window.location.href="edit?rid="+rid;
	
}

function lookinfo(rid){
	$.ajax({
		url:Root+'admin/Positions/lookinfo',
		type: "get",
		data:{"rid":rid},
		dataType: "json"				
	});		
	var url=Root+'admin/Positions/lookinfo?rid='+rid;
	x_admin_show('简介',url,'700','450');	
}















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
