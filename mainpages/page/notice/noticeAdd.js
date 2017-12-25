layui.config({
	base : "js/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;

	//创建一个编辑器
 	var editIndex = layedit.build('notice_content');
 	var addNoticeArray = [],addNotice;
 	form.on("submit(addNotice)",function(data){
 		//是否添加过信息
	 	if(window.sessionStorage.getItem("addNotice")){
	 		addNoticeArray = JSON.parse(window.sessionStorage.getItem("addNotice"));
	 	}
	 	//显示、审核状态
 		var isShow = data.field.show=="on" ? "checked" : "",
 			noticeStatus = data.field.shenhe=="on" ? "审核通过" : "待审核";

 		addNotice = '{"noticeName":"'+$(".noticeName").val()+'",';  //公告名称
 		addNotice += '"noticeId":"'+new Date().getTime()+'",';	 //公告id
 		//addNews += '"newsLook":"'+$(".newsLook option").eq($(".newsLook").val()).text()+'",'; //开放浏览
 		addNotice += '"noticeTime":"'+$(".noticeTime").val()+'",'; //发布时间
 		//addNotice += '"noticeAuthor":"'+$(".noticeAuthor").val()+'",'; //文章作者
 		/*addNews += '"isShow":"'+ isShow +'",';  //是否展示
 		addNews += '"newsStatus":"'+ newsStatus +'"}'; //审核状态*/
 		addNoticeArray.unshift(JSON.parse(addNotice));
 		window.sessionStorage.setItem("addNotice",JSON.stringify(addNoticeArray));
 		//弹出loading
 		var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        setTimeout(function(){
            top.layer.close(index);
			top.layer.msg("公告添加成功！");
 			layer.closeAll("iframe");
	 		//刷新父页面
	 		parent.location.reload();
        },2000);
 		return false;
 	})
	
})
