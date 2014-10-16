<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>BLOG - Bao Khoa - Trang chu</title>
		<link rel="stylesheet" href="text.css">
    	<link rel="stylesheet" href="style/main.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>

	<body>	
	<!-- khoanguyen da them chu thich o day -->
		<div id="wraper">
		<!-- thu lai lan nua -->
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
				<?php
					
					try {

						$data = $db -> query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');

						while($row = $data -> fetch()){
							echo '<div>';
								echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
								echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
								echo '<p>'.$row['postDesc'].'</p>';
								echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';
							echo '</div>';
						}

					}	

					//Tra ve thong bao loi
					catch(PDOException $e) {

						echo $e -> getMessage(); 

					}
				?>

			</div>
		</div>
		
	</body>
</html>