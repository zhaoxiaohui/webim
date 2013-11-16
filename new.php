<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>淘聊</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" media="screen" href="css/jquery.mobile-1.3.1.min.css" />
<link rel="stylesheet" media="screen" href="css/jqm-icon-pack-2.0-original.css" />
<link href="css/jquery.mobile.iscrollview.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="screen" href="css/main.css" />

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta property="og:type" content="website"/>

</head>
<body>

<div data-role="page" id="register" data-theme="a">

	<div data-role="header" data-position="fixed" data-theme="a">
		<h1>注册</h1>
		<a data-role="button" data-icon="arrow-l" href="index.php" data-transition="slide">返回</a>
	</div><!-- /header -->

	<div data-role="content" data-iscroll>
		
		
	        <fieldset data-role="fieldcontain"> 
				<label for="username">头像</label>
				<fieldset class="ui-grid-a">
					<div class="ui-block-a">
						<img id="head_image_preview" class="head-image" src="#"/>
					</div>
					<div class="ui-block-b">
						<input type="file" id="head_image_file" name="head_image_file" accept="image/*"/>
                    	
					</div>
				</fieldset>
			</fieldset>
			
			<form class="register_form" data-ajax="false" enctype="multipart/form-data" id="register_form">
		        <fieldset data-role="fieldcontain"> 
					<label for="username">用户名</label>
					<input type="text" name="username" id="username" class="required email" placeholder="邮箱..."/>
				</fieldset>
	
				<fieldset data-role="fieldcontain"> 
					<label for="password">密码</label>
					<input type="password" name="password" id="password" class="required" placeholder="最小6位 最高25位" minlength="6" maxlength="25"/>
				</fieldset>
	
				<fieldset data-role="fieldcontain"> 
					<label for="password2">密码确认</label>
					<input type="password" name="password2" id="password2" class="required passmatch" placeholder="最小6位 最高25位" minlength="6" maxlength="25">
				</fieldset>
	
				<fieldset data-role="fieldcontain"> 
					<label for="personal-label">标签</label>
					<input type="text" name="personal-label" id="personal-label" class="required" placeholder="多个用空格隔开"/>
				</fieldset>
	        </form>
	        <div data-role="button" id="btn-register">注册</div>
	</div><!-- /content -->
</div><!-- /page login-->

</body>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.mobile-1.3.1.min.js"></script>
<script src="js/iscroll.js" type="text/javascript"></script>
<script src="js/jquery.mobile.iscrollview.js" type="text/javascript"></script>

<!-- jQuery File Upload Dependencies -->
<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>

<script src="js/jquery-validate.js" type="text/javascript"></script>
<script src="js/util/command.js" type="text/javascript"></script>
<script src="js/system.js" type="text/javascript"></script>
<script src="js/register.js" type="text/javascript"></script>
</html>