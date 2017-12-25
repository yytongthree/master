<?php    session_start(); ?>
<html> 
<head> 
<meta charset="UTF-8"> 
  <title>删除新闻</title> 
</head> 
<body> 
 <?php
	$checkbox=$_REQUEST["checkbox"];
  
    $conn=mysqli_connect("localhost","root","wenny673","yyt_info"); 
	// 检查连接 
	if (!$conn) 
	{ 
    	die("连接错误: " . mysqli_connect_error()); 
	} 

mysqli_query($conn,"DELETE FROM news WHERE ID='{$checkbox}'");
echo "<script language=javascript>alert('删除已成功！')</script>"; 
mysqli_close($conn);
?>