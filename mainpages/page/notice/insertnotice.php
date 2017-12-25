<?php
	session_start(); 
	$name=$_REQUEST["noticeName"];
	$time=$_REQUEST["noticeTime"];
	$keywords=$_REQUEST["keywords"];
	$content=$_REQUEST["content"];
	
	$conn=mysqli_connect("localhost","root","wenny673","yyt_info"); 
	// 检查连接 
	if (!$conn) 
	{ 
    	die("连接错误: " . mysqli_connect_error()); 
	}
	$sql="INSERT INTO notice (noticeName,noticeTime,keywords,content) VALUES('{$name}','{$time}','{$keywords}','{$content}')";
   	if(mysqli_query($conn,$sql)){
?>
		<script type="text/javascript"> 
    		alert("提交成功"); 
    		window.location.href="noticeAdd.html"; 
 		</script>
<?php
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close ( $conn ); 
?>