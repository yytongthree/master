layui.config({
	base : "js/"
}).use(['form','layer','jquery','laypage'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		$ = layui.jquery;

	//加载页面数据
	var noticeData = '';
	$.get("../../json/noticeList.json", function(data){
		var newArray = [];
			 //正常加载信息
			noticeData = data;
			if(window.sessionStorage.getItem("addNotice")){
				var addNotice = window.sessionStorage.getItem("addNotice");
				noticeData = JSON.parse(addNotice).concat(noticeData);
			}
			//执行加载数据的方法
			noticeList();
	})

	//查询
	$(".search_btn").click(function(){
		var newArray = [];
		if($(".search_input").val() != ''){
			var index = layer.msg('查询中，请稍候',{icon: 16,time:false,shade:0.8});
            setTimeout(function(){
            	$.ajax({
					url : "../../json/noticeList.json",
					type : "get",
					dataType : "json",
					success : function(data){
						if(window.sessionStorage.getItem("addNotice")){
							var addNotice = window.sessionStorage.getItem("addNotice");
							noticeData = JSON.parse(addNotice).concat(data);
						}else{
							noticeData = data;
						}
						for(var i=0;i<noticeData.length;i++){
							var noticeStr = noticeData[i];
							var selectStr = $(".search_input").val();
		            		function changeStr(data){
		            			var dataStr = '';
		            			var showNum = data.split(eval("/"+selectStr+"/ig")).length - 1;
		            			if(showNum > 1){
									for (var j=0;j<showNum;j++) {
		            					dataStr += data.split(eval("/"+selectStr+"/ig"))[j] + "<i style='color:#03c339;font-weight:bold;'>" + selectStr + "</i>";
		            				}
		            				dataStr += data.split(eval("/"+selectStr+"/ig"))[showNum];
		            				return dataStr;
		            			}else{
		            				dataStr = data.split(eval("/"+selectStr+"/ig"))[0] + "<i style='color:#03c339;font-weight:bold;'>" + selectStr + "</i>" + data.split(eval("/"+selectStr+"/ig"))[1];
		            				return dataStr;
		            			}
		            		}
		            		//公告标题
		            		if(noticeStr.noticeName.indexOf(selectStr) > -1){
			            		noticeStr["noticeName"] = changeStr(noticeStr.noticeName);
		            		}
		            		//发布时间
		            		if(noticeStr.noticeTime.indexOf(selectStr) > -1){
			            		noticeStr["noticeTime"] = changeStr(noticeStr.noticeTime);
		            		}
		            		if(noticeStr.noticeName.indexOf(selectStr)>-1 || noticeStr.noticeStatus.indexOf(selectStr)>-1 || noticeStr.noticeLook.indexOf(selectStr)>-1 || noticeStr.noticeTime.indexOf(selectStr)>-1){
		            			newArray.push(noticeStr);
		            		}
		            	}
		            	noticeData = newArray;
		            	noticeist(noticeData);
					}
				})
            	
                layer.close(index);
            },2000);
		}else{
			layer.msg("请输入需要查询的内容");
		}
	})

	//全选
	form.on('checkbox(allChoose)', function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		child.each(function(index, item){
			item.checked = data.elem.checked;
		});
		form.render('checkbox');
	});

	//通过判断公告是否全部选中来确定全选按钮是否选中
	form.on("checkbox(choose)",function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
		if(childChecked.length == child.length){
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
		}else{
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
		}
		form.render('checkbox');
	})

	function noticeList(that){
		//渲染数据
		function renderDate(data,curr){
			var dataHtml = '';
			if(!that){
				currData = noticeData.concat().splice(curr*nums-nums, nums);
			}else{
				currData = that.concat().splice(curr*nums-nums, nums);
			}
			if(currData.length != 0){
				for(var i=0;i<currData.length;i++){
					dataHtml += '<tr>'
			    	+'<td><input type="checkbox" name="checked" lay-skin="primary" lay-filter="choose"></td>'
			    	+'<td align="left">'+currData[i].noticeName+'</td>';
			    	dataHtml += '<td>'+currData[i].noticeTime+'</td>'
			    	+'</tr>';
				}
			}else{
				dataHtml = '<tr><td colspan="8">暂无数据</td></tr>';
			}
		    return dataHtml;
		}

		//分页
		var nums = 13; //每页出现的数据量
		if(that){
			noticeData = that;
		}
		laypage({
			cont : "page",
			pages : Math.ceil(noticeData.length/nums),
			jump : function(obj){
				$(".notice_content").html(renderDate(noticeData,obj.curr));
				$('.notice_list thead input[type="checkbox"]').prop("checked",false);
		    	form.render();
			}
		})
	}
})
