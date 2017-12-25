<?php
	$conn = mysqli_connect("localhost","root","wenny673","yyt_info");
	if (!$conn)
	{
		die('Could not connect: ' . mysqli_error());
	}
	$sql = "CREATE TABLE comment
	(
		ID int(11) unsigned NOT NULL AUTO_INCREMENT primary key,
		status int(11) NOT NULL,
		userName varchar(50) not null,
		commentTime date not null,
		content longtext,
		manageContent longtext
	)";
	if(mysqli_query($conn,$sql))
   {
		echo "<br>success7";
	} else {
		echo "<br>Error7: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>