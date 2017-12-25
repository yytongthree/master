<?php
	session_start(); 
	$time=$_REQUEST["commentTime"];
	$content=$_REQUEST["content"];
	
	$conn=mysqli_connect("localhost","root","wenny673","yyt_info"); 
	// 检查连接 
	if (!$conn) 
	{ 
    	die("连接错误: " . mysqli_connect_error()); 
	}
	$sql="INSERT INTO comment (userName,status,commentTime,content) VALUES('{$_SESSION['username']}','1','{$time}','{$content}')";
   	if(mysqli_query($conn,$sql)){
?>
		<script type="text/javascript"> 
    		alert("提交成功"); 
    		window.location.href="commentAdd.html"; 
 		</script>
<?php
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close ( $conn ); 
?>