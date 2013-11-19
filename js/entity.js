$(document).ready(function($) {
	var me = {};
	me.username = null;
	var current_talking = {};
	current_talking.username = null;
	
	var prefix = "taoliao-";
	Entity = {
			login : function(user){
				if(user.img=="")user.img="img/taochat.png";
				me.username = user.username;
				localStorage.setObject(prefix+user.username, user);
			},
			getuser: function(){
				var user = localStorage.getObject(prefix+me.username);
				if(user){
					return user.username;
				}return null;
			},
			getuserid:function(){
				var user = localStorage.getObject(prefix+me.username);
				if(user){
					return user.id;
				}return null;
			},
			getuserob: function(){
				var user = localStorage.getObject(prefix+me.username);
				if(user){
					return user;
				}return null;
			},
			gettalk: function(){
				return localStorage.getItem(prefix+me.username+"-current-talking");
				//return current_talking.username;
			},
			talk : function(name){
				localStorage.setItem(prefix+me.username+"-current-talking", name);
				//current_talking.username = name;
			},
			leavetalk: function(){
				localStorage.setItem(prefix+me.username+"-current-talking",null);
				//current_talking.username = null;
			},
			saveNotify: function(message){
				var values = new com.js.util.ArrayList();
				
				var notifys = localStroage.getObject(prefix+"taoliao-notify");
>>>>>>> c6a17b81965037177452b7f16672e719da1632ba
				if(!notifys){
					values.setData(notifys);
				}
				values.add(message);
				localStorage.setObject(prefix+"taoliao-notify", values);
				return values.getSize();
			},
			getNotify: function(){
				return localStorage.getObject(prefix+"taoliao-notify");
			},
			getNotifyById:function(i){
				var values = new com.js.util.ArrayList();
				var notifys = Entity.getNotify();
				values.setData(notifys);
				return values.get(i);
			},
			removeNotify: function(i){
				var values = new com.js.util.ArrayList();
				var notifys = Entity.getNotify();
				values.setData(notifys);
				values.removeAt(i);
				Entity.saveNotify(values);
			},
			setFriendsUpdate: function(){
				localStorage.setItem(prefix+"friends-update",true);
			},
			unsetFriendsUpdate:function(){
				localStorage.setItem(prefix+"friends-update",false);
			},
			getFriendsUpdate: function(){
				return localStorage.getItem(prefix+"friends-update");
			}
	}
});
