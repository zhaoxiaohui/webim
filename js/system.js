Storage.prototype.setObject = function(key, value) {
    this.setItem(key, JSON.stringify(value));
}

Storage.prototype.getObject = function(key) {
    var value = this.getItem(key);
    return value && JSON.parse(value);
}
Date.prototype.Format = function (fmt) { 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

$(document).ready(function($) {
	
	var handlers=new com.js.util.HashMap();
	
	//命令处理器
	CommandHandler = {
			//注册处理器
			registerHandler:function(handler){
				handlers.put(handler.type,handler);
			},
			//执行处理器
			execute : function(data){
				handlers.get(data.type).run(data);
			},
			
			error : function(){
				$.mobile.changePage($("#login"), {
					transition: "slide",
					changeHash: "false"
				});
			}
	}
});
(function( $, window, undefined ) {
    $.extend($.mobile, {
        toast: function(msg,delay){
        	$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h3>"+msg+"</h3></div>")
        	.css({ display: "block", 
        		opacity: 0.90, 
        		position: "fixed",
        		padding: "7px",
        		"text-align": "center",
        		width: "270px",
        		left: ($(window).width() - 284)/2,
        		top: $(window).height()/2 })
        	.appendTo( $.mobile.pageContainer ).delay( delay )
        	.fadeOut( 400, function(){
        		$(this).remove();
        	});
        },
        showLoading : function(message){
            $.mobile.loadingMessageTextVisible = true; 
            $.mobile.loadingMessage = message;
            $.mobile.showPageLoadingMsg();
        }
    });
})( jQuery, this );