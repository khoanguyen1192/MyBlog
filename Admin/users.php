<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['deluser'])){ 

	//if user id is 1 ignore
	if($_GET['deluser'] !='1'){

		$stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
		$stmt->execute(array(':memberID' => $_GET['deluser']));

		header('Location: users.php?action=deleted');
		exit;

	}
} 

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="../text.css">
  <link rel="stylesheet" href="../style/main.css">
  <script language="JavaScript" type="text/javascript">
  function deluser(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'users.php?deluser=' + id;
	  }
  }
  </script>
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

			<?php 
			//show message from add / edit page
			if(isset($_GET['action'])){ 
				echo '<h3>User '.$_GET['action'].'.</h3>'; 
			} 
			?>

			<table>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			<?php
				try {

					$stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
					while($row = $stmt->fetch()){
						
						echo '<tr>';
						echo '<td>'.$row['username'].'</td>';
						echo '<td>'.$row['email'].'</td>';
						?>

						<td>
							<a href="edit-user.php?id=<?php echo $row['memberID'];?>">Edit</a> 
							<?php if($row['memberID'] != 1){?>
								| <a href="javascript:deluser('<?php echo $row['memberID'];?>','<?php echo $row['username'];?>')">Delete</a>
							<?php } ?>
						</td>
						
						<?php 
						echo '</tr>';

					}

				} catch(PDOException $e) {
				    echo $e->getMessage();
				}
			?>
			</table>

			<p><a href='add-user.php'>Add User</a></p>
		</div>

	</div>

</body>
</html>
