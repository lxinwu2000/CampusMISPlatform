//职务信息
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
			  Ajaxalls(rid,data,1,'admin/Positions/edit','admin/Positions/index');
		  }	  	    
	    return false;
	  });
});

var conutid="";
function set(ids){
	conutid = ids;
}
$.ajaxSetup({async:false});
$.ajax({
    url:Root+'admin/Positions/hasids',
    type: 'POST',
    dataType: 'json',
    cache : false,
    success: function(res){
        set(res.hasids);
       }
});
layui.use(['laypage', 'layer'], function(){
	  var laypage = layui.laypage
	  ,layer = layui.layer;
	  laypage.render({
	     elem: 'pagelist'
	    ,count:conutid
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
			 console.log(data);
		    $.each(data,function(i,item){	 
			  htmls+='<tr>'
		      +'<td><input type="checkbox" class="ace" value="'+item.rid+'"/><span class="lbl"></span></td>'
		      +'<td>'+Number(i+1)+'</td>'
		      +'<td>'+item.cnname+'</td>'
		      +'<td>'+item.enname+'</td>'
		      +'<td>右边查看详细信息</td>'
		      +'<td>'+item.remark+'</td>'
		      +'<td>'
		      +'<div class="layui-btn-group">'
		      +'<button class="layui-btn layui-btn-normal layui-btn-xs">'
		      +'<i class="layui-icon">&#xe642;</i>'
		      +'</button>'
		      +'<button class="layui-btn layui-btn-danger layui-btn-xs">'
		      +'<i class="layui-icon">&#xe640;</i>'
		      +'</button>' 
		      +'<button class="layui-btn  layui-btn-xs">'
		      +'查看详细信息'
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
	var conutid="";
	function set(ids){
		conutid= ids;
	}
	$.ajaxSetup({async:false});
	$.ajax({
	    url:Root+'admin/Positions/hasids',
	    type: 'get',
	    data:{"search":str},
	    dataType: 'json',
	    cache : false,
	    success: function(res){
	        set(res.hasids);
	       }
	});
	layui.use(['laypage', 'layer'], function(){
		  var laypage = layui.laypage
		  ,layer = layui.layer;
		  laypage.render({
		     elem: 'pagelist'
		    ,count:conutid
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
			      +'<td>右边查看详细信息</td>'
			      +'<td>'+item.remark+'</td>'
			      +'<td>'
			      +'<div class="layui-btn-group">'
			      +'<button class="layui-btn layui-btn-normal layui-btn-xs">'
			      +'<i class="layui-icon">&#xe642;</i>'
			      +'</button>'
			      +'<button class="layui-btn layui-btn-danger layui-btn-xs">'
			      +'<i class="layui-icon">&#xe640;</i>'
			      +'</button>' 
			      +'<button class="layui-btn  layui-btn-xs">'
			      +'查看详细信息'
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
