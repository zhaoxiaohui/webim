/**
 * 页面绑定区
 */
$(document).on( "pageinit", "#friends", function( event ) {
	
	//注册事件
	CommandHandler.registerHandler({
		type:"getfriends",
		run : function(data){
			if(data.playboard.length > 0){
				$.each(data.playboard, function(i,user){
					Friends.add(user, user.id);
                    //Friends.load();
                    //var message = {};
                    //message.type = "conversations";
                    //message.playboard = {};
                    //message.playboard.id = Entity.getuserid();
                    //Socket.send(JSON.stringify(message));
				});
                Friends.load();                
                var message = {};
                message.type = "conversations";
                message.playboard = {};
                message.playboard.id = Entity.getuserid();
                Socket.send(JSON.stringify(message));
			}
			//Friends.load();
			//var message = {};
			//message.type = "conversations";
			//message.playboard = {};
			//message.playboard.id = Entity.getuserid();
			//Socket.send(JSON.stringify(message));
		}
	});
	
	
	CommandHandler.registerHandler({
		type:"conversations",
		run: function(data){
			if(data.playboard.length > 0){
				$.each(data.playboard, function(i, oneuser){
					$.each(oneuser.msg, function(i, one){
						Friends.addMessage(oneuser.from,one,oneuser.date[i],"in");
						Friends.addUnRead(oneuser.from);
						
					});
					Friends.setUnRead(oneuser.from);
				});
            }
			var message = {};
			message.type = "getnotifys";
			message.playboard = {};
			message.playboard.id = Entity.getuserid();
			Socket.send(JSON.stringify(message));
		}
	});
	
	
	var message = {};
	message.type = "getfriends";
	message.playboard = {};
	message.playboard.id = Entity.getuserid();
	  
	Socket.send(JSON.stringify(message));
 
});
$(document).on("pagehide","#conversation",function(event){
	Entity.leavetalk();
});

$(document).on("pageshow","#conversation",function(event){
	Friends.loadMessages(Entity.gettalk());
});
$(document).on("pageshow","#friend-information",function(event){
	if(typeof(Storage)!=="undefined") {
		var curuser = localStorage.getItem("user-information");
		if(curuser){
			curuser = JSON.parse(curuser);
			$(".information-name").empty();
			$(".information-name").append(curuser.nickname);
			$("#information-img").attr("src", curuser.img);
			$("#information-watch").attr("href","information.php?id="+curuser.id);
			$("#information-label").empty();
			if(curuser.label){
				var labels = curuser.labels.split(" ");
				$.each(labels,function(i,one){
					var li = $("<li>").html(one);
					$("#information-label").append(li);
				});
				$("#information-label").listview();
				$("#information-label").listview("refresh");
			}
		}
	}else{
		$.mobile.toast("您的设备不支持html本地存储，抱歉...",2000);
	}
});	 
$(document).on("pageinit","#setup",function(event){
	if(typeof(Storage)!=="undefined") {
		var user = Entity.getuserob();
		if(user){
			//user = JSON.parse(user);
			$("#me-img").attr("src", user.img);
			$("#me-watch").attr("href","information.php?id="+user.id);
			if(user.labels){
				var labels = user.labels.split(" ");
				$("#me-label").empty();
				$.each(labels,function(i,one){
					var li = $("<li>").html(one);
					$("#me-label").append(li);
				});
				$("#me-label").listview();
				$("#me-label").listview("refresh");
			}
		}
	}else{
		$.mobile.toast("您的设备不支持html本地存储，抱歉...",2000);
	}
});

$(document).ready(function(){
	
	Login.login();
	//var t = JSON.stringify(msg);
	
	
	Conversion.bindSendMessage();
	Conversion.bindNotifyMessage();

});

Login = {
		login : function(){
			$("#btn-login").bind("click",function(e){
				
				var user = $(".login").val();
				var pass = $(".password").val();
				if(user == (undefined|"") || pass == (undefined|"")){
					$.mobile.hidePageLoadingMsg();
					$.mobile.toast("请输入用户名和密码", 1000);
					$.mobile.changePage($("#login"), {
						transition: "slide",
						changeHash: "false"
					});
				}else{
					Socket.init(user,pass);
					$.mobile.showLoading("正在使劲...");
				}
				e.preventDefault();
				return false;
			});
		}
}



Conversion = {
		bindSendMessage : function(){
			$("#sendmessage").bind("click",function(e){
				//var to = $('h1.contact-name').html();
				var msg = encodeURIComponent($("#message").val());
				var date = new Date().Format("hh:mm:ss");
				Friends.addMessage(Entity.gettalk(),msg,date,"out");
				
				var message = {};
				message.type = "conversation";
				message.playboard = {};
				message.playboard.from = Entity.getuserid();
				message.playboard.to = Entity.gettalk();
				message.playboard.date = date;
				message.playboard.msg = msg;
				Socket.send(JSON.stringify(message));
				window.setTimeout(function(){
					Friends.appendMessage(Entity.gettalk());
					$("#message").val('');
				},500);
				e.preventDefault();
				return false;
			});
			
			CommandHandler.registerHandler({
				type:"conversation",
				run : function(data){
					Friends.addMessage(data.playboard.from,data.playboard.msg,data.playboard.date,"in");
					
					if(Settings.isVibrate())
						navigator.vibrate(500);
					//console.log("talk:"+Entity.gettalk());
					//console.log("from:"+data.playboard.from);
					if(Entity.gettalk()==null || Entity.gettalk() != data.playboard.from)
					{
						Friends.addUnRead(data.playboard.from);
						Friends.setUnRead(data.playboard.from);
					}
					else
						Friends.appendMessage(data.playboard.from);
				}
			});
		},
		
		bindNotifyMessage: function(){
			CommandHandler.registerHandler({
				type:"addfriend",
				run: function(data){
					if(data){
						var num = Entity.saveNotify(data);
						//设置未读
						//var unread = "<span class='ui-li-count ui-btn-up-b ui-btn-corner-all unread-notify unread'>"+num+"</span>";
						$(".unread-notify").html(unread);
						$("#setup-me-list").listview("refresh");
						Friends.addAfterSearch(data.playboard.from);
					}
				}
			});
			CommandHandler.registerHandler({
				type:"addfriend-confirm",
				run: function(data){
					if(data){
						var num = Entity.saveNotify(data);
						//设置未读
						//var unread = "<span class='ui-li-count ui-btn-up-b ui-btn-corner-all unread-notify unread'>"+num+"</span>";
						$(".unread-notify").html(num);
						$("#setup-me-list").listview("refresh");
						if(data.playboard.confirm){
							Friends.addAfterSearch(data.playboard.id);
						}
					}
				}
			});
			CommandHandler.registerHandler({
				type:"getnotifys",
				run: function(data){
					var num = 0;
					if(data.playboard.length > 0){
						$.each(data.playboard, function(i,notify){
							num = Entity.saveNotify(data);
						});
					}
					$(".unread-notify").html(num);
					//$("#setup-me-list").listview("refresh");
				}
			});
			$("#notification").unbind("click");
			$("#notification").bind("click",function(ev){
				$(".unread-notify").html("0");
				$("#setup-me-list").listview("refresh");
			});
		}
}



