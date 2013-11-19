$(document).ready(function($) {
var messages = {};
var friends = {};
Friends = {
		load : function(){
			$(".friend-list").empty();
			$.each(friends, function(i, one) {
				Friends.insertListView(one);
			});
			Friends.refreshListView();
		},
		insertListView: function(one){
			if(one){
				if(one.img=="")
					one.img = "img/taochat.png";
				var userinfo = "<a href='#'><img class='ui-li-thumb head-image-little' src='" + one.img+"'/>";
				userinfo += "<h2>"+one.nickname+"</h2>";
				userinfo += "<P>";
				if(one.labels){
					var labels = one.labels.split(" ");
					if(labels)
						$.each(labels, function(i, l)
						{
							userinfo += l +"   ";
						});
				}
				userinfo +="</p></a>"
				//var contact = "<div class='ui-btn-inner ui-li'><div class='ui-btn-text'>"+userinfo+"</div><span class='ui-icon ui-icon-arrow-r ui-icon-shadow'> </span></div>";
				//var classes = "ui-li-has-arrow ui-li-has-count ui-btn-up-c "+one.id
				var classes = "ui-li-has-count " + one.id;
				//var classes = one.name;
				var li = $("<li>").addClass(classes).html(userinfo);
				$(".friend-list").append(li);
				if(messages[one.id] == undefined)
				{
					messages[one.id] = [];
					messages[one.id].unread = 0;
					messages[one.id].inbox = [];
					
				}
				Friends.setUnRead(one.id);
				
				//绑定单击事件
				$("."+one.id).unbind("click");
				$("."+one.id).bind("click",function(e){
						// console.log("click: "+i);
						Friends.setContactName(one.nickname);
						Friends.removeUnRead(one.id);
						Entity.talk(one.id);
						$.mobile.changePage($("#conversation"), {
							transition: "slide",
							changeHash: "false"
						});
						e.preventDefault();
					return false;
				});
				
				//绑定长按事件
				$("."+one.id).unbind("taphold");
				$("."+one.id).bind("taphold", function(event){
					if(typeof(Storage)!=="undefined") {
					    localStorage.setItem("user-information",JSON.stringify(one));;
					}
					$.mobile.changePage($("#friend-information"), {
						transition: "slide",
						changeHash: "false"
					});
					event.preventDefault();
					return false;
				});
			}
		},
		refreshListView: function(){
			$(".friend-list").listview();
            $(".friend-list").listview("refresh");    
		},
		setContactName : function(user){
			//var upper_user = user.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			//	return letter.toUpperCase();
			//});
			$(".contact-name").empty();
			$(".contact-name").append(user);
		},
		
		loadMessages : function(name){
			if(name != null){
				$("#message-container").empty();
				var x = messages[name].inbox;
	
				$(x,this).each(function(i){
					if (x[i].direction=="out") {
						var classes = "bubbledRight";
					}else{
						var classes = "bubbledLeft";
					}
					//var msg = "<a href='#' data-role='button' data-theme='e' data-inline='true'>"+decodeURIComponent(x[i].msg)+"</a>";
					//var span = $("<span>").addClass("dt").html(" ("+x[i].date+")");
					var div = $("<div>").addClass(classes).html(decodeURIComponent(x[i].msg));//.append(span);
					//$(".message").scale9Grid({top:30, bottom:30, left:30, right:30});
					$("#message-container").append(div); 

				});
				$("#message-container").collapsibleset(); 
			}

		},
		
		appendMessage : function(name){
			
			if(messages[name].inbox.length > 0){
				var x = messages[name].inbox[messages[name].inbox.length-1];
				if (x.direction=="out") {
					var classes = "bubbledRight";
				}else{
					var classes = "bubbledLeft";
				}
				//var span = $("<span>").addClass("dt").html(" ("+x.date+")");
				//var msg = "<a href='#' data-role='button' data-theme='e' data-inline='true' style='text-align:left'>"+decodeURIComponent(x.msg)+"</a>";
				var div = $("<div>").addClass(classes).html(decodeURIComponent(x.msg));//.append(span);
				//$(".message").scale9Grid({top:30, bottom:30, left:30, right:30});
				//$("#message-container").append("<div class='bubble'>asdf</div>"); 
				$("#message-container").append(div); 
				$("#message-container").collapsibleset();
				//var t = $("#message-container");
			}
		},
		removeUnRead : function(name){
			if(messages[name].unread !=0 ){
				messages[name].unread = 0;
				$(".unread"+name).remove();
			}
		}
		,
		addUnRead : function(name){
			messages[name].unread++;
		},
		setUnRead : function(name){
			if(messages[name].unread > 0){
				var unread = "<span class='ui-li-count ui-btn-up-b ui-btn-corner-all unread"+name+" unread'>"+messages[name].unread+"</span>";
				$("."+name).append(unread);
			}
		},
		addMessage : function(to,msg,date,dir){
			//var date = new Date().Format("yyyy-MM-dd hh:mm:ss");
			// now = date.getFullYear()+"-"+(date.getMonth())+1+"-"+date.getDate()+"T"+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
			var msg_data = new Object();
			msg_data["msg"] = msg;
			msg_data["date"] = date;
			msg_data["direction"] = dir;
			messages[to].inbox.push(msg_data);
		},
		add : function(user, id){
			friends[id] = user;
		},
		get : function(id){
			return friends[id];
		},
		addAfterSearch: function(id){
			var message = {};
			message.type = "search-user";
			message.playboard = {};
			message.playboard.id = id;
			Socket.send(JSON.stringify(message));
			
			CommandHandler.registerHandler({
				type: "search-user",
				run: function(data){
					if(data.playboard.length > 0)
						Friends.insertListView(data.playboard);
				}
			});
		}
}
});