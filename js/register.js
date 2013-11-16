$(document).ready(function(){
	$.mobile.ajaxEnabled = false;
	$.validator.addMethod("passmatch", function(value) {
		return value == $("#password").val();
	}, '两次密码不一致');
	$("#head_image_file").bind("change",function(evt){
		 
		 var files = evt.target.files; // FileList object
		 // Only process image files.
		 if(files.length >0){
			 head_file = files[0];
			 if (!head_file.type.match('image.*')) {
				 $.mobile.toast("不是有效的图片文件...",1000);
			 }else{
				 var reader = new FileReader();

				 // Closure to capture the file information.
				 reader.onload = (function(theFile) {
				    return function(e) {
				    	// Render thumbnail.
				    	$("#head_image_preview").attr("src",e.target.result);
				    };
				})(head_file);
				 // Read in the image file as a data URL.
				 reader.readAsDataURL(head_file);
			 }
		 }
	});
	$("#register_form").validate({

		errorPlacement: function(error, element) {
			if (element.attr("name") === "personal_label") {
				error.insertAfter($("#personal_label").parent());
			} else {
				error.insertAfter(element);
			}
		}
	
	});
	$('#head_image_file').fileupload({
		url : "server/register.php",
        dataType: 'json',
        add: function (e, data) {
        	$("#btn-register").unbind("click");
        	$("#btn-register").bind("click",function(){
        		data.formData = $("#register_form").serializeArray();
        		data.submit();
        	});
        },
        submit : function (e, data) {
            return $("#register_form").valid();
        },
        always: function (e, data) {
        	handleResult(JSON.parse(data.jqXHR.responseText));
        }
    });
	$("#btn-register").bind("click",function(){
		if($("#register_form").valid()){
			var jqxhr = $.ajax({
				type:"POST",
				url: "server/register.php",
				data: $("#register_form").serializeArray(),
				dataType: "json"
			}).complete(function(data){
				handleResult(JSON.parse(data.responseText));
				
			});
		}
	});
	function handleResult(res){
		if(res.status === 'success'){
			$.mobile.toast("注册成功,即将返回登录界面",2000);
			setTimeout("$.mobile.changePage('index.php')", 2020);
		}else if(res.status === 'exist'){
			$.mobile.toast("邮箱已经被注册，请更换一个",2000);
		}else{
			$.mobile.toast("遇到未知错误，请重试",2000);
		}
	}
	
});
jQuery.extend(jQuery.validator.messages, {
	  required: "必选字段",
	  remote: "请修正该字段",
	  email: "请输入正确格式的电子邮件",
	  url: "请输入合法的网址",
	  date: "请输入合法的日期",
	  dateISO: "请输入合法的日期 (ISO).",
	  number: "请输入合法的数字",
	  digits: "只能输入整数",
	  creditcard: "请输入合法的信用卡号",
	  equalTo: "请再次输入相同的值",
	  accept: "请输入拥有合法后缀名的字符串",
	  maxlength: jQuery.validator.format("请输入一个 长度最多是 {0} 的字符串"),
	  minlength: jQuery.validator.format("请输入一个 长度最少是 {0} 的字符串"),
	  rangelength: jQuery.validator.format("请输入 一个长度介于 {0} 和 {1} 之间的字符串"),
	  range: jQuery.validator.format("请输入一个介于 {0} 和 {1} 之间的值"),
	  max: jQuery.validator.format("请输入一个最大为{0} 的值"),
	  min: jQuery.validator.format("请输入一个最小为{0} 的值")
	});