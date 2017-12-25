<?php session_start();?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
</head>

<body>

<?php
	$ID=$_REQUEST["checkbox"];
	$conn=mysqli_connect("localhost","root","wenny673","yyt_info") or die("Unable to connect!");
		$sql = "select * from news WHERE ID='{$ID}'" ;
		$res = mysqli_query($conn,$sql) or die("Error in query: $sql. ".mysqli_error());
		//循环取出数据
		if(mysqli_num_rows($res)>0){  
         //如果返回的数据集行数大于0，则开始以表格的形式显示   
			while($row=mysqli_fetch_array($res)){ 
				echo "<tr>";
?>
<td style="text-align:center;"> 
<?php
    echo $row['newsName'];
    echo "<br />";
?>
</td>
<tr>
<td style="text-align:center;"> 
<?php
    echo $row['newsAuthor'];
    echo "<br />"; 
?>
</td>
</tr>
<?php
    echo "<tr><td>".$row['content']."</td></tr>";

			}
		mysqli_free_result($res); 

	}
	mysqli_close($conn);
 ?>

            </tbody>       

</body>
</html>