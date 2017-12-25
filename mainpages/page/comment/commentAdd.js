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
 	var editIndex = layedit.build('comment_content');
 	var addCommentArray = [],addComment;
 	form.on("submit(addComment)",function(data){
 		//是否添加过信息
	 	if(window.sessionStorage.getItem("addComment")){
	 		addCommentArray = JSON.parse(window.sessionStorage.getItem("addComment"));
	 	}
	 	//显示、审核状态
 		var isShow = data.field.show=="on" ? "checked" : "",
 		addComment = '{"newsName":"'+$(".newsName").val()+'",';  //文章名称
 		addComment += '"newsId":"'+new Date().getTime()+'",';	 //文章id
 		//addNews += '"newsLook":"'+$(".newsLook option").eq($(".newsLook").val()).text()+'",'; //开放浏览
 		addComment += '"newsTime":"'+$(".newsTime").val()+'",'; //发布时间
 		addCommentArray.unshift(JSON.parse(addComment));
 		window.sessionStorage.setItem("addComment",JSON.stringify(addCommentArray));
 		//弹出loading
 		var index = top.layer.msg('留言提交中，请稍候',{icon: 16,time:false,shade:0.8});
        setTimeout(function(){
            top.layer.close(index);
			top.layer.msg("留言添加成功！");
 			layer.closeAll("iframe");
	 		//刷新父页面
	 		parent.location.reload();
        },2000);
 		return false;
 	})
	
})
