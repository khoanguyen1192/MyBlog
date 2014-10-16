<?php //include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <title>Admin - Add Post</title>
	  <link rel="stylesheet" href="../text.css">
	  <link rel="stylesheet" href="../style/main.css">
	  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	  <script>
	          tinymce.init({
	              selector: "textarea",
	              plugins: [
	                  "advlist autolink lists link image charmap print preview anchor",
	                  "searchreplace visualblocks code fullscreen",
	                  "insertdatetime media table contextmenu paste"
	              ],
	              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	          });
	  </script>
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
			<p><a href="./">Blog Admin Index</a></p>

			<h2>Add Post</h2>

			<?php

			//if form has been submitted process it
			if(isset($_POST['submit'])){

				$_POST = array_map( 'stripslashes', $_POST );

				//collect form data
				extract($_POST);

				//very basic validation
				if($postTitle ==''){
					$error[] = 'Please enter the title.';
				}

				if($postDesc ==''){
					$error[] = 'Please enter the description.';
				}

				if($postCont ==''){
					$error[] = 'Please enter the content.';
				}

				if(!isset($error)){

					try {

						//insert into database
						$stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postDesc,postCont,postDate) VALUES (:postTitle, :postDesc, :postCont, :postDate)') ;
						$stmt->execute(array(
							':postTitle' => $postTitle,
							':postDesc' => $postDesc,
							':postCont' => $postCont,
							':postDate' => date('Y-m-d H:i:s')
						));

						//redirect to index page
						header('Location: index.php?action=added');
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

				<p><label>Title</label><br />
				<input type='text' name='postTitle' value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'></p>

				<p><label>Description</label><br />
				<textarea name='postDesc' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea></p>

				<p><label>Content</label><br />
				<textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea></p>

				<p><input type='submit' name='submit' value='Submit'></p>

			</form>

		</div>
	</body>
</html>


