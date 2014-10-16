<?php
//include config
require_once('../includes/config.php');

// them dong chu thich o day
//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); } 
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Login</title>
		<link rel="stylesheet" href="../text.css">
		<link rel="stylesheet" href="../style/main.css">
	</head>
	<body>
		
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

	           <!--  <div class="header-right">
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

		<div id="login">
			<br /><br /><br /><br />

			<?php

			//process login form if submitted
			if(isset($_POST['submit'])){

				$username = trim($_POST['username']);
				$password = trim($_POST['password']);
				
				if($user->login($username,$password)){ 

					//logged in return to index page
					header('Location: index.php');
					exit;
				

				} else {
					$message = '<p class="error">Wrong username or password</p>';
				}

			}//end if submit

			if(isset($message)){ echo $message; }
			?>

			<form action="" method="post">
			<p><label>Username</label><input type="text" name="username" value=""  /></p>
			<p><label>Password</label><input type="password" name="password" value=""  /></p>
			<p><label></label><input type="submit" name="submit" value="Login"  /></p>
			</form>

		</div>
	</body>
</html>
