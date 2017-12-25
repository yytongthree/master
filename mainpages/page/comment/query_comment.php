<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="../../css/font_eolqem241z66flxr.css" media="all" />
	<link rel="stylesheet" href="../../layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="../../css/news.css" media="all" />
<title>无标题文档</title>
</head>
<body class="childrenBody">
	<blockquote class="layui-elem-quote title"><big><b>留言回复信息</b></big></blockquote>
    <form class="layui-form">
    <div class="layui-form-item">
	</div>
	  	<table class="layui-table">
		    <colgroup>
                <col width="25%">
                 </colgroup>
            <thead>
                 <tr>
		    <th>回信</th>
                    
		</tr> 
		    </thead>
		    <tbody>
<?php

	$conn=mysqli_connect("localhost","root","wenny673","yyt_info") or die("Unable to connect!");
	function showTable($conn,$table_name){ 
		$sql = "select * from $table_name WHERE status=1";
		$res = mysqli_query($conn,$sql);
		//循环取出数据
		if(mysqli_num_rows($res)>0){  
         //如果返回的数据集行数大于0，则开始以表格的形式显示   
			while($row=mysqli_fetch_array($res)){ 
				echo "<tr>";
					echo "<td>".$row['manageContent']."</td>";
				echo "</tr>";
			}
		mysqli_free_result($res); 
		}
	}
	showTable($conn,"news");
	mysqli_close($conn);
 ?>
            </tbody>         
		</table>
        </form>
        <script type="text/javascript" src="../../layui/layui.js"></script>
	<script type="text/javascript" src="../news/newsList.js"></script>
</body>
</html>