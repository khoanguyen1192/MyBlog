<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Add User</title>
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

<div class="wrap-main">
	<br /><br /><br /><br />
	<?php include('menu.php');?>
	<p><a href="users.php">User Admin Index</a></p>

	<h2>Add User</h2>

	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($username ==''){
			$error[] = 'Please enter the username.';
		}

		if($password ==''){
			$error[] = 'Please enter the password.';
		}

		if($passwordConfirm ==''){
			$error[] = 'Please confirm the password.';
		}

		if($password != $passwordConfirm){
			$error[] = 'Passwords do not match.';
		}

		if($email ==''){
			$error[] = 'Please enter the email address.';
		}

		if(!isset($error)){

			$hashedpassword = $user->create_hash($password);

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_members (username,password,email) VALUES (:username, :password, :email)') ;
				$stmt->execute(array(
					':username' => $username,
					':password' => $hashedpassword,
					':email' => $email
				));

				//redirect to index page
				header('Location: users.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	//check for any errors
	if(isset($error)){
		foreach($error as $error){
			echo '<p class="error">'.$error.'</p>';
		}
	}
	?>

	<form action='' method='post'>

		<p><label>Username</label><br />
		<input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>

		<p><label>Password</label><br />
		<input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

		<p><label>Confirm Password</label><br />
		<input type='password' name='passwordConfirm' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>

		<p><label>Email</label><br />
		<input type='text' name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>
		
		<p><input type='submit' name='submit' value='Add User'></p>

	</form>

</div>
