<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\phpStudy\WWW\schoolyard/application/admin\view\organizeinfo\info.html";i:1517374381;s:61:"D:\phpStudy\WWW\schoolyard/application/admin\view\layout.html";i:1517305185;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>校园信息后台管理系统</title>
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <!-- page specific plugin styles -->
        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/css/fonts.googleapis.com.css" />
        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/css/ace-rtl.min.css" />
        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo config('public.static'); ?>/ace1.4/assets/css/ace-ie.min.css" />
        <![endif]-->
        <!-- inline styles related to this page -->
        <!-- ace settings handler -->
        <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/ace-extra.min.js"></script>
        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
        <!--[if lte IE 8]>
        <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/html5shiv.min.js"></script>
        <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default          ace-save-state">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header pull-left">
                    <a href="<?php echo url('index/index'); ?>" class="navbar-brand">
                        <small>
                            <i class="fa fa-ra"></i>
                                                                                    校园信息后台管理系统
                        </small>
                       
                        
                    </a>
                </div>
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">                  
                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                
                                <span class="user-info">
                                    <small>欢迎您</small>
                                    <?php echo session('user_name'); ?>
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="<?php echo url('admin/public_edit_info'); ?>">
                                        <i class="ace-icon fa fa-user"></i>
                                        个人设置
                                    </a>
                                </li>

                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo url('login/logout'); ?>">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        退出
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

            <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
                <script type="text/javascript">
                    try {
                        ace.settings.loadState('sidebar')
                    } catch (e) {
                    }
                </script>
                <?php echo action('Menu/index','','widget'); ?>
                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>

            <div class="main-content">
                <div class="main-content-inner">
                    <link rel="stylesheet" href="<?php echo config('public.tp5jump'); ?>/layui/css/layui.css" />
<link rel="stylesheet" href="<?php echo config('public.tp5jump'); ?>/common.css" />
<div class="page-content">
    <div class="col-sm-6 pull-right">
        <span class="btn btn-sm btn-primary pull-right" onclick="javascript:window.history.back();">
            返回上一页
            <i class="icon-reply icon-only"></i>
        </span>
    </div>
    <div class="page-header">
        <h1>
            <?php echo model('menu')->getParentNname(); ?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?php echo input('id')?'编辑':'新增'; ?>
            </small>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
     <div class="layui-form-item">
		    <label class="layui-form-label" style="width:110px;">上传logo:</label>
		    <div class="layui-input-block">
		      <button type="button" class="layui-btn" id="logo">
                <i class="layui-icon">&#xe67c;</i>上传图片
              </button>
		    </div>
		  </div>
		  
    <div class="layui-form-item showImg">
		<label class="layui-form-label">缩略图:</label>
		<div class="layui-input-block">					
				<div id="showImg">
				</div>					
			</div>
	</div>		  
    
    <form class="layui-form layui-form-labelsave" action="">    
    <div class="layui-col-xs12 layui-col-md6 layui-col-lg6" style="display:none;">
		  <div class="layui-form-item">
		    <label class="layui-form-label">logo:</label>
		    <div class="layui-input-block" id="logopath">		      
		    </div>
		  </div>
    </div>	
       
    <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">中文名:</label>
		    <div class="layui-input-block">
		      <input type="text" name="cnname" value="" lay-verify="required" placeholder="请输入中文机构名称" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
    <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">英文名:</label>
		    <div class="layui-input-block">
		      <input type="text" name="enname" value=""  lay-verify="required" placeholder="请输入英文机构名称" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
     <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">电话:</label>
		    <div class="layui-input-block">
		      <input type="text" name="phone" value=""  lay-verify="mobile" placeholder="请输入机构电话" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
    <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">邮编:</label>
		    <div class="layui-input-block">
		      <input type="text" name="postcode" value=""  lay-verify="required" placeholder="请输入英文机构名称" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
     <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">地址:</label>
		    <div class="layui-input-block">
		      <input type="text" name="address" value=""  lay-verify="required" placeholder="请输入地址" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
      <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">法人:</label>
		    <div class="layui-input-block">
		      <input type="text" name="Legalrepresentative" value=""  lay-verify="required" placeholder="请输入法人" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
     <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">网址:</label>
		    <div class="layui-input-block">
		      <input type="text" name="website" value=""  lay-verify="required" placeholder="请输入网址" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
     <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">邮箱:</label>
		    <div class="layui-input-block">
		      <input type="text" name="email" value=""  lay-verify="email" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
		    </div>
		  </div>
    </div>	
    
    
      <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">校训：</label>
    <div class="layui-input-block">
      <textarea name="schoolmotto" placeholder="请输入校训" class="layui-textarea"></textarea>
    </div>
  </div>
    </div>	
    
    
      <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">经营理念:</label>		    
		       <div class="layui-input-block">
			      <textarea name="businessphilosophy" placeholder="请输入经营理念" class="layui-textarea"></textarea>
			    </div>		    
		  </div>
    </div>	
    
      <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">服务宗旨:</label>		   
		     <div class="layui-input-block">
			    <textarea name="servicepurpose"   placeholder="请输入服务宗旨" class="layui-textarea"></textarea>
			  </div>			  	
		  </div>
    </div>	
    
      <div class="layui-col-xs12 layui-col-md6 layui-col-lg6">
		  <div class="layui-form-item">
		    <label class="layui-form-label">备注:</label>		    
		     <div class="layui-input-block">
			    <textarea name="remark" placeholder="请输入备注" class="layui-textarea"></textarea>
			  </div>			    
		  </div>
    </div>	
     
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="organizeinfo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>   
    </div><!-- /.row -->
</div><!-- /.page-content -->
 <script src="<?php echo config('public.tp5jump'); ?>/layui/layui.js"></script>
 <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/jquery-2.1.4.min.js"></script> 
  <script src="<?php echo config('public.tp5jump'); ?>/common.js"></script> 
 <script src="<?php echo config('public.tp5jump'); ?>/organizinfo.js"></script> 



                </div>              
            </div><!-- /.main-content -->
            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            <span class="blue bolder"><a href="#" target="_blank">SchoolyardAdmin</a></span>
                             &copy; v.1
                        </span>

                        &nbsp; &nbsp;
                        <span class="action-buttons">
                            <a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/jquery-2.1.4.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
                    if ('ontouchstart' in document.documentElement)
                        document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/bootstrap.min.js"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/excanvas.min.js"></script>
        <![endif]-->
    
        <!-- ace scripts -->
        <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/ace-elements.min.js"></script>
        <script src="<?php echo config('public.static'); ?>/ace1.4/assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->    
        <script src="<?php echo config('public.static'); ?>/layer/layer.js"></script>
        <!--artDialog end-->       
        <script>
                    var u = $(".active").parent('ul');
                    
                    var uc = u.attr("class");//
                   
                    if (uc == 'submenu') {
                       u.parent().attr("class", "open active");
                       if(u.parent().parent().attr('class')=='submenu'){
                           u.parent().parent().parent().attr("class","open active");
                       }
                    }
                                      
                    //弹出确认操作
                    function alert_del(url, title) {                    	
                    	layer.confirm(title, {
                    		  btn: ['重要','取消'] //按钮
                    		}, function(){
                    			 return window.location.href = url;
                    		});
                      
                    }                    
        </script>
    </body>
</html>
