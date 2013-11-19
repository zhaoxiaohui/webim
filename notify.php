<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>淘聊</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

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


</html>