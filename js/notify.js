$(document).on("pageshow","#notify",function(event){
	var notifys = Entity.getNotify();
	if(notifys){
		$.each(notifys, function(i, one){
			var info = "";
			var span = "<span class='ui-li-count ui-btn-up-b ui-btn-corner-all unread"+i+" unread'>"+1+"</span>";
			var classes = "notify-"+i;
			if(one.playboard.type == "addfriend"){
				info = "好友添加申请...";
			}else{
				info = "添加状态提醒...";
			}
            var li = $("<li>").addClass(classes).html(info).append(span);
			$("#notify-list").append(li);
			
			$('.notify-'+i).unbind("click");
			$('.notify-'+i).bind("click",function(e){
				if(one.playboard.type=="addfriend"){
					$("#add-notify-info-header").html("添加好友");
					$("#add-notify-info-content").html(one.playboard.nickname + "已经添加添加您为好友");
					$.mobile.changePage( "#add-notify-info", { role: "dialog" } );
				}else{
					$("#notify-info-header").html("添加好友-状态");
					$("#notify-info-content").html("添加 "+one.playboard.nickname + one.playboard.confirm==true?" 成功":" 失败");
					$.mobile.changePage( "#notify-info", { role: "dialog" } );
				}
				$('.unread'+i).remove();
				Entity.removeNotify(i);
			});
		});
		$("#notify-list").listview();
		$("#notify-list").listview('refresh');
	}
});
