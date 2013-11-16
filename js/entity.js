$(document).ready(function($) {
	var me = {};
	me.username = null;
	var current_talking = {};
	current_talking.username = null;
	
	Entity = {
			login : function(user){
				if(user.img=="")user.img="img/taochat.png";
				me.username = user.username;
				localStorage.setObject(user.username, user);
			},
			getuser: function(){
				var user = localStorage.getObject(me.username);
				if(user){
					return user.username;
				}return null;
			},
			getuserid:function(){
				var user = localStorage.getObject(me.username);
				if(user){
					return user.id;
				}return null;
			},
			gettalk: function(){
				return localStorage.getItem(me.username+"-current-talking");
				//return current_talking.username;
			},
			talk : function(name){
				localStorage.setItem(me.username+"-current-talking", name);
				//current_talking.username = name;
			},
			leavetalk: function(){
				localStorage.setItem(me.username+"-current-talking",null);
				//current_talking.username = null;
			}
	}
});