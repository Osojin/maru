
<?php

	$conn = mysqli_connect("localhost", "root", "123456", "maru", "3307");
	echo "adsssd";
	if (!$conn) {
		die('연결 실패: ' . mysqli_error());
	}
	$result = mysqli_query($conn, "SELECT * FROM blog_news");
	
	
	while($row = mysqli_fetch_array($result)){
		echo $row['head'];
	}

?>
