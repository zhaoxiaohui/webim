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

<div data-role="page" id="notify" data-theme="a">

	<div data-role="header" data-position="fixed" data-theme="a">
		<h1>消息</h1>
		<a data-role="button" data-icon="arrow-l" href="index.php#setup" data-transition="slide">返回</a>
	</div><!-- /header -->

	<div data-role="content" data-iscroll>
		<ul data-role="listview" data-inset="true" data-theme='a' id="notify-list">
		</ul>
	</div><!-- /content -->
</div><!-- /page login-->

<div data-role="popup" id="add-notify-info" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1 id="add-notify-info-header"></h1>
    </div>
    <div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
        <h3 class="ui-title" id="add-notify-info-content"></h3>
        <a href="#" data-role="button" data-inline="true" data-rel="back" data-transition="flow" data-theme="b" id="add-confirm">确定</a>
    </div>
</div>
<div data-role="popup" id="notify-info" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;" class="ui-corner-all">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1 id="notify-info-header"></h1>
    </div>
    <div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
        <h3 class="ui-title" id="add-notify-info-content"></h3>
        <a href="#" data-role="button" data-inline="true" data-rel="back" data-transition="flow" data-theme="b">确定</a>
    </div>
</div>
</body>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.mobile-1.3.1.min.js"></script>
<script src="js/iscroll.js" type="text/javascript"></script>
<script src="js/jquery.mobile.iscrollview.js" type="text/javascript"></script>


<script src="js/util/command.js" type="text/javascript"></script>
<script src="js/system.js" type="text/javascript"></script>
<script src="js/entity.js" type="text/javascript"></script>
<script src="js/notify.js" type="text/javascript"></script>
</html>