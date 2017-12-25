<?php

	$conn=mysqli_connect("localhost","root","wenny673","yyt_info") or die("Unable to connect!");
	function showTable($conn,$table_name){ 
		$sql = "select * from $table_name";
		$res = mysqli_query($conn,$sql);
		$arr = array();
		//循环取出数据   
			while($row=mysqli_fetch_array($res)){ 
				$arr[] = $row;
			}
			$str = json_encode($arr);////将数组转化为json格式的字符串
		mysqli_free_result($res); 
	}
	showTable($conn,"news");
	mysqli_close($conn);
 ?>
            </tbody>         
		</table>
</body>
</html>                           
