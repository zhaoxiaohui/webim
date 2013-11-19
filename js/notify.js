$(document).on("pageshow","#notify",function(event){
	var notifys = Entity.getNotify();
	$("#notify-list").empty();
	if(notifys){
		$.each(notifys, function(i, one){
			//one = JSON.parse(one);
			var info = "";
			var span = "<span />";
			if(!one.read)
				span= "<span class='ui-li-count ui-btn-up-b ui-btn-corner-all unread"+i+" unread'>"+1+"</span>";
			var classes = "notify-"+i;
			if(one.type == "addfriend"){
				info = '<div data-role="collapsible"><h4>好友添加申请...</h4><p>'+one.playboard.nickname+' 已经添加您为好友</p>';
			}else{
				info = '<div data-role="collapsible"><h4>添加状态提醒...</h4><p>添加 '+one.playboard.nickname+' 失败</p>';
			}
            var li = $("<li>").addClass(classes).html(info).append(span);
			$("#notify-list").append(li);
			
			$('.notify-'+i).unbind("click");
			$('.notify-'+i).bind("click",function(e){
				/*if(one.type == "addfriend"){
					//$("#add-notify-info-header").html("添加好友");
					//$("#add-notify-info-content").html(one.playboard.nickname + " 已经添加添加您为好友");
					//$.mobile.changePage("#add-notify-info", { role: "dialog" } );
					$("#add-notify-info").popup();
					$("#add-notify-info").popup("open");
				}else{
					$("#notify-info-header").html("添加好友-状态");
					$("#notify-info-content").html("添加 "+one.playboard.nickname + one.playboard.confirm==true?" 成功":" 失败");
					$("#notify-info").popup();
					$("#notify-info").popup("open");// { role: "dialog" } );
				}*/
				if(!one.read){
					$('.unread'+i).remove();
					one.read = true;
					Entity.saveAll(notifys);
				}
			});
		});
		$("#notify-list").listview();
		$("#notify-list").listview('refresh');
	}
});
