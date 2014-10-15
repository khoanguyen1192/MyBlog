<?php

	require('includes/config.php');

	//chuan bi mot cau lenh SQL duoc thuc thi
	$data = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
	// //thuc thi mot cau lenh SQL chuan bi 
	$data->execute(array(':postID' => $_GET['id']));
	// // Lay ket qua tu 1 tuyen bo chuan bi vao cac bien rang buoc
	$row = $data->fetch();


	// neu postID rong hoac khong co trong CSDL, khong co ket qua nao duoc tra ve, chuyen huong nguoi dung sang trang index
	if ($row['postID'] == '') {
		header('Location: ./');
		exit;
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <title>BLOG - Bao Khoa - <?php echo $row['postTitle'];?></title>
	    <link rel="stylesheet" href="style/normalize.css">
	    <link rel="stylesheet" href="style/main.css">
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="wrapper">
			<h1>BLOG</h1>
			<hr />
			<p><a href="./">Blog Index</a></p>

			<?php
				// Hien thi hoan chinh bai viet duoc chon 
				echo '<div>';
					echo '<h1>'.$row['postTitle'].'</h1>';
					echo '<p>Posted on'.date('jS M Y', strtotime($row['postDate'])).'</p>';
					echo '<p>'.$row['postCont'].'</p>';
				echo '</div>'; 
			?>

		</div>
	</body>
</html>