<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="../../css/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="../../layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="../../css/news.css" media="all" />
<title>管理留言</title>
</head>
<body class="childrenBody">
	<blockquote class="layui-elem-quote title"><big><b>留言内容</b></big></blockquote>
	<form class="layui-form" name="comment_form" method="post" action="../comment/reply_comment.html">
    <div class="layui-form-item">
	</div>
	  	<table class="layui-table">
		    <colgroup>
                <col width="15%">
                <col width="25%">
                <col width="15%">
                <col width="15%">
                 </colgroup>
            <thead>
                 <tr>
		    <th>用户</th>
		    <th>留言内容</th>
		    <th>留言时间</th>
            <th>处理</th> 
				</tr> 
		    </thead>
		    <tbody>
<?php

	$conn=mysqli_connect("localhost","root","wenny673","yyt_info") or die("Unable to connect!");
	function showTable($conn,$table_name){ 
		$sql = "select * from $table_name WHERE status=1";
		$res = mysqli_query($conn,$sql);
		//循环取出数据  
         //如果返回的数据集行数大于0，则开始以表格的形式显示
		 	if(mysqli_num_rows($res)>0){ //mysqli_num_rows返回结果集中行的数量 
			while($row=mysqli_fetch_array($res)){//结果集中取得一行作为关联数组，或数字数组，或二者兼有 
				echo "<tr>";
					echo "<td>".$row['userName']."</td>";
					echo "<td>".$row['content']."</td>";
					echo "<td>".$row['commentTime']."</td>";
?>
			<td>
            
			<button class="layui-btn layui-btn-mini"><i class="iconfont icon-edit"></i>回复留言</button>
            </form>
			<a  href="dispose_comment.php">
					
		    </td>
<?php
				echo "</tr>";
			}
		mysqli_free_result($res); 
		}
	}
	showTable($conn,"comment");
	mysqli_close($conn);
 ?>
            </tbody>         
		</table>
	<script type="text/javascript" src="../../layui/layui.js"></script>
    <script type="text/javascript" src="../notice/noticeList.js"></script>
</body>
</html>