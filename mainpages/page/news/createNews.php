<?php
	$conn = mysqli_connect("localhost","root","wenny673","yyt_info");
	if (!$conn)
	{
		die('Could not connect: ' . mysqli_error());
	}
	$sql = "CREATE TABLE news
	(
		ID int(11) unsigned NOT NULL AUTO_INCREMENT primary key,
		newsName varchar(50) not null,
		newsAuthor varchar(50) not null,
		newsTime date not null,
		keywords text,
		newsSum text,
		content longtext
	)";
	if(mysqli_query($conn,$sql))
   {
		echo "<br>success7";
	} else {
		echo "<br>Error7: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>