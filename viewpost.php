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
<!-- Them chu thich -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <title>BLOG - Bao Khoa - <?php echo $row['postTitle'];?></title>
	    <link rel="stylesheet" href="text.css">
	    <link rel="stylesheet" href="style/main.css">
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>
		<div id="wrapper">

			<div class="header">
				<div class="header_content">
					<h1 class="logo">
						<a href="index.php" title="Trangchu">Trang chu</a>
					</h1>
					
					<ul class="menu-bar">
			            
			            <li>
			                <a href="http://linkhay.com/photo/list" title="Ảnh">Comic</a>
			            </li>
			            
			            <li class="line">|</li>
			            
			            <li>
			                <a href="http://linkhay.com/tin-moi" title="Cập nhật hoạt động bạn bè">
			                	<span class="number-new" id="new-link-counter" style="display: none">0</span>Tin mới
			                </a>
			            </li>
			            
			            <li class="line">|</li>
			            
			            <li>
			                <a href="http://linkhay.com/feed" title="Cập nhật hoạt động bạn bè">Bạn bè 360</a>
			            </li> 
			            
			            <li style="margin: -6px 0 0 33px">
			                <div style="">
			                    <a class="submit link-nologin mrk-login" href="javascript: void(0)" title="Gửi tin">Gửi tin</a>
			                </div>
			            </li>
			            
			            <li style="margin: -6px 0 0 6px">
			                <div style="">
			                    <a class="submit anhhot link-nologin mrk-login" href="javascript: void(0)" title="Gửi ảnh">Gửi ảnh</a>
			                </div>
			            </li> 
		    
		            </ul>

		            <!-- <div class="header-right">
		            	<ul class="menu-login">
		                    <li class="header-right-main"> 
		                    	<?php if (isset($_SESSION['username'])) : ?>
		                    		<strong>Xin chao '<?php echo $_SESSION['username']?>'!  </strong><a href="login.php?action=logout"><strong>Dang xuat</strong></a>
		                    	<?php else : ?>
		                        	<a class="login" href="Admin/login.php"><strong>Đăng nhập</strong></a> hoặc <a class="register" href="register.php"><strong>Đăng ký</strong></a>
		                       	<?php endif; ?>
		                    </li>
		                </ul>
		            </div> -->
				</div>
			</div>
			<div class="wrap-main">
				
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

		</div>
	</body>
</html>