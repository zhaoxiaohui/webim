$(document).ready(function($) {
var ws;
var selfDisconnect = false;
Socket = {
		init : function(user,pass){
			ws = new FancyWebSocket('ws://219.142.86.69:9300');

			//Let the user know we're connected
			ws.bind('open', function() {
				console.log( "Connected." );
				CommandHandler.registerHandler({
					type:"login",
					run:function(data){
						Entity.login(data.playboard);
						if(data.playboard.username){
							$.mobile.changePage($("#friends"), {
								transition: "slide",
								changeHash: "false"
							});
							$.mobile.hidePageLoadingMsg();
							//Friends.load(msg);
						}else{
							$.mobile.toast("用户名密码无效,请重新登录",1000);
							selfDisconnect = true;
							ws.disconnect();
							$.mobile.hidePageLoadingMsg();
							$.mobile.changePage($("#login"), {
								changeHash: "false"
							});
						}
					}
				}); 
				var message = {};
				message.type = "login";
				message.playboard = {};
				message.playboard.username = user;
				message.playboard.password = pass;
				//console.log(JSON.stringify(message));
				Socket.send(JSON.stringify(message));
			});

			//OH NOES! Disconnection occurred.
			ws.bind('close', function( data ) {
				$.mobile.hidePageLoadingMsg();
				if(!selfDisconnect){
					$.mobile.toast("连接服务器错误...",3000);
				}
				else selfDisconnect = false;
				$.mobile.changePage($("#login"),{
					transition: "slide",
					changeHash: "false"
				});
			});

			//Log any messages sent from server
			ws.bind('message', function(playboard) {
				console.log(JSON.parse(playboard));
				CommandHandler.execute(JSON.parse(playboard));
			});

			ws.connect();
		},
		
		
		sendMessage : function(to, message){
			/**
			var date = new Date().Format("yyyy-MM-dd hh:mm:ss");
			// now = date.getFullYear()+"-"+(date.getMonth())+1+"-"+date.getDate()+"T"+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
			var msg_data = new Object();
			msg_data["text"] = message;
			msg_data["date"] = date;
			msg_data["direction"] = "out";
			messages[to].inbox.push(msg_data);
			*/
		},
		
		send : function(message){
			ws.send("message", message);
		},
		close: function(){
			selfDisconnect = true;
			ws.disconnect();
		}
}
});