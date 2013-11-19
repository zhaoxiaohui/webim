<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>淘聊</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" media="screen" href="css/jquery.mobile-1.3.1.min.css" />
<link rel="stylesheet" media="screen" href="css/jqm-icon-pack-2.0-original.css" />
<link href="css/jquery.mobile.iscrollview.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/jquery.mobile.iscrollview-pull.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="screen" href="css/main.css" />



<meta name="apple-mobile-web-app-capable" content="yes" />
<meta property="og:type" content="website"/>

<link rel="icon" sizes="57x57" href="img/taochat.ico">
</head>
<body>
<div data-role="page" id="login" data-theme="a">

	<div data-role="header" data-position="fixed" data-theme="a">
		<h1>淘聊</h1>
		<a data-role="button" class="ui-btn-right" data-icon="arrow-r" href="new.php" data-ajax="false" data-transition="slide">注册</a>
	</div><!-- /header -->

	<div data-role="content">
		<img class="logo" src="img/taochat.png" alt="firebird!" height="120px" width="120px">
		<form class="login_form">
	        <div class="input-group">
	          <div class="input-row">
	            <label>账户</label>
	            <input type="email" class="login email" placeholder="邮箱" value="">
	          </div>
	          <div class="input-row">
	            <label>密码</label>
	            <input type="password" class="password" placeholder="密码" value="">
	          </div>
	        </div>
      	</form>
      	<div data-role="button" id="btn-login">猛戳一下</div>
	</div><!-- /content -->

</div><!-- /page login-->



<div data-role="page" id="friends" class="friends" data-theme="a">
	<div data-role="content" class="jqm-content jqm-fullwidth" data-iscroll="">
		<ul data-role="listview" data-iscroll="" data-autodividers="true"  data-inset="true" class="friend-list" data-dividertheme="a" data-filter="true" data-filter-theme="d" data-filter-placeholder="搜索好友...">
			<!-- 通过JS加载 -->
		</ul>
	</div>

	
	<div data-role="footer" data-id="bottom-bar" data-position="fixed" data-theme="a">
		<div data-role="navbar">
			<ul>
				<li><a href="#friends" data-prefetch="true" data-icon="chat" data-transition="slide" class="ui-btn-active ui-state-persist">淘友</a></li>
				<li><a href="#goods"  data-prefetch="true" data-icon="search" data-transition="slide">淘搜</a></li>
				<li><a href="#recommend" data-icon="star" data-prefetch="true" data-transition="slide">推荐</a></li>
				<li><a href="#setup" data-prefetch="true" data-icon="person" data-transition="slide">我</a></li>
			</ul>
		</div><!-- /navbar -->
	</div><!-- /footer -->
</div>

<div data-role="page" id="goods" class="goods" data-theme="a">
	<div data-role="content" class="jqm-content jqm-fullwidth" data-iscroll="">
		<div class="iscroll-pulldown">
          <span class="iscroll-pull-icon"></span><span class="iscroll-pull-label" data-iscroll-loading-text="正在努力加载..." data-iscroll-pulled-text="放手加载...">下拉刷新</span>
        </div>
		<ul data-role="listview" class="goods-list" data-split-icon="gear" data-split-theme="d" data-inset="false">
			<!-- 通过JS加载 -->
		</ul>
	</div>
	<div data-role="footer" data-id="bottom-bar" data-position="fixed" data-theme="a">
		<div data-role="navbar">
			<ul>
				<li><a href="#friends" data-prefetch="true" data-icon="chat" data-transition="slide">淘友</a></li>
				<li><a href="#goods"  data-prefetch="true" data-icon="search" data-transition="slide" class="ui-btn-active ui-state-persist">淘搜</a></li>
				<li><a href="#recommend" data-icon="star" data-prefetch="true" data-transition="slide">推荐</a></li>
				<li><a href="#setup" data-prefetch="true" data-icon="person" data-transition="slide">我</a></li>
			</ul>
		</div><!-- /navbar -->
	</div><!-- /footer -->
</div>

<div data-role="page" class="recommend" id="recommend" data-theme="a">
	<div data-role="content" class="jqm-content jqm-fullwidth" data-iscroll="">
		<ul data-role="listview" class="recommend-list" data-theme="d" data-filter="true" data-filter-theme="d" data-filter-placeholder="检索...">
			<!-- 通过JS加载 -->
			<li></li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
			<li>xxxxx</li>
		</ul>
	</div>
	<div data-role="footer" data-id="bottom-bar" data-position="fixed" data-theme="a">
		<div data-role="navbar">
			<ul>
				<li><a href="#friends" data-prefetch="true" data-icon="chat" data-transition="slide">淘友</a></li>
				<li><a href="#goods"  data-prefetch="true" data-icon="search" data-transition="slide">淘搜</a></li>
				<li><a href="#recommend" data-icon="star" data-prefetch="true" data-transition="slide" class="ui-btn-active ui-state-persist">推荐</a></li>
				<li><a href="#setup" data-prefetch="true" data-icon="person" data-transition="slide">我</a></li>
			</ul>
		</div><!-- /navbar -->
	</div><!-- /footer -->
</div>

<div data-role="page" id="setup" data-theme="a">
	<div data-role="content" class="jqm-content jqm-fullwidth" data-iscroll="">
			<ul data-role="listview" data-inset="true" data-theme='a' id="setup-me-list">
				<li><a href="#"><img src="#" id="me-img" class="head-image"/></a></li>
				<li><a href="#" id="me-watch">我的的关注</a></li>
				<li><a href="changepass.php">更改密码</a></li>
				<li class="ui-li-has-count" id="notification"><a href="#notify">消息</a><span class='ui-li-count ui-btn-up-b ui-btn-corner-all unread-notify unread'></span></li>
			</ul>
			<form>
			    <fieldset data-role="collapsible" data-theme="a" data-content-theme="a">
			        <legend>个性化标签</legend>
			        <ul data-role="listview" data-inset="true" id="me-label">
			        </ul>			        
			        <a href="#add-label" id="me-add-label" data-role="button" data-icon="plus" data-shadow="false" data-theme="a">添加标签</a>
			    </fieldset>
			</form>
			<form>
			    <fieldset data-role="collapsible" data-theme="a" data-content-theme="a">
			        <legend>设置</legend>
			        <fieldset class="ui-grid-a">
						<div class="ui-block-a" style="width:48%"><div class="ui-bar ui-bar-a">仅接收好友推荐</div></div>
						<select class="ui-blcok-b" name="recommend-toggle" id="recommend-toggle" data-role="slider">
    										<option value="off">Off</option>
   												 	<option value="on">On</option>
						</select>	
					</fieldset>
					 <fieldset class="ui-grid-a">
						<div class="ui-block-a" style="width:48%"><div class="ui-bar ui-bar-a">接收添加好友推荐</div></div>
						<select class="ui-blcok-b" name="addfriend-toggle" id="addfriend-toggle" data-role="slider" >
    										<option value="off">Off</option>
   												 	<option value="on">On</option>
						</select>	
					</fieldset>					
			    </fieldset>
			</form>
			<ul data-role="listview" data-inset="true" data-theme='a'>
				<li><a href="about.php">关于</a>
				<li><a href="#">退出当前账号</a>
			</ul>
			
	</div>
	<div data-role="footer" data-id="bottom-bar" data-position="fixed" data-theme="a">
		<div data-role="navbar">
			<ul>
				<li><a href="#friends" data-prefetch="true" data-icon="chat" data-transition="slide">淘友</a></li>
				<li><a href="#goods"  data-prefetch="true" data-icon="search" data-transition="slide">淘搜</a></li>
				<li><a href="#recommend" data-icon="star" data-prefetch="true" data-transition="slide">推荐</a></li>
				<li><a href="#setup" data-prefetch="true" data-icon="person" data-transition="slide" class="ui-btn-active ui-state-persist">我</a></li>
			</ul>
		</div><!-- /navbar -->
	</div><!-- /footer -->
</div>

<div data-role="page" id="conversation" data-theme="a" data-iscroll>
	<div data-role="header" data-position="fixed" data-theme="a">
		<h1 class="contact-name"></h1>
		<a data-role="button" data-transition="slide" data-icon="arrow-l" href="#friends">返回</a>
	</div><!-- /header -->
	<div data-role="content" data-iscroll>
		<div data-role="content" id="message-container">
		</div><!-- /content -->
	</div>
	<div class="sendmessage_form" data-role="footer" data-position="fixed" data-theme="a">
		<table style="width:100%"><tr>
			<td>
			<input type="text" class="message ui-input-text" name="message" id="message" placeholder="写入消息...."/>
			</td>
			<td>
			<input id="sendmessage" type="button" value="发送"/>
			<td>
			</tr></table>
	</div>
</div>

<div data-role="page" id="friend-information" data-theme='e'>
	<div data-role="header" data-position="fixed" data-theme='e'>
		<h1 class="information-name"></h1>
		<a data-role="button" data-transition="slide" data-icon="arrow-l" href="#friends">返回</a>
	</div><!-- /header -->
	<div data-role="content" data-iscroll="">
			<ul data-role="listview" data-inset="true" data-theme='e'>
				<li data-role="list-divider" data-theme="a">头像</li>
				<li><a href="#"><img id="information-img" src="#" />
				</a></li>
			</ul>
			<ul data-role="listview" data-inset="true" data-theme="a">
				<li><a id="information-watch" href="#">他/她的关注</a>
			</ul>
			<div data-role="collapsible" data-theme="a" data-content-theme="a" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
    			<h4>个性化标签</h4>
    			<ul data-role="listview" data-inset="false" id="information-label"/>
    			</ul>
			</div>
		</div>
</div>

<div data-role="page" id="notify" data-theme="a">

	<div data-role="header" data-position="fixed" data-theme="a">
		<h1>消息</h1>
		<a data-role="button" data-icon="arrow-l" href="#setup" data-transition="slide">返回</a>
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

</doby>

<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.mobile-1.3.1.min.js"></script>
<script src="js/iscroll.js" type="text/javascript"></script>
<script src="js/jquery.mobile.iscrollview.js" type="text/javascript"></script>
<script src="js/jquery-pull.js" type="text/javascript"></script>

<script src="js/sha256.js"></script>
<script src="js/util/command.js"></script>
<script src="js/system.js"></script>
<script src="js/settings.js"></script>
<script src="js/entity.js"></script>
<script src="js/jquery.json-2.2.min.js"></script>
<script src="js/fancywebsocket.js"></script>
<script src="js/socket.js"></script>
<script src="js/friends.js"></script>
<script src="js/imcontrol.js"></script>
<script src="js/notify.js" type="text/javascript"></script>
</html>
