<?PHP 
	include '../lib/session.php';
	Session::checkLogin();
?>
<?PHP include '../config/config.php';?>
<?PHP include '../lib/Database.php';?>
<?PHP include '../helpers/format.php';?>
<?PHP
$db=new Database();
$fm=new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD']=='POST'){
			$username=$fm->validation($_POST['username']);
			$password=$fm->validation(md5($_POST['password']));
			
			$username=mysqli_real_escape_string($db->link,$username);
			$password=mysqli_real_escape_string($db->link,$password);
			
			$query="select * from tbl_user where username='$username' and password='$password'";
			$result=$db->select($query);
			if($result!=false){
				//$value=mysqli_fetch_array($result);
				$value=$result->fetch_assoc();
				
					Session::set("login",true);
					Session::set("username",$value['username']);
					Session::set("userId",$value['id']);
					Session::set("userRole",$value['role']);
					header("Location:index.php");
			}else{
				echo "<span style='color:red;font-size:18px;'>Username or Password Not Matched</>";
			}
			}
		?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		
		<div class="button">
			<a href="forgetpass.php">Forgot Password</a>
		</div>
		
		<div class="button">
			<a href="#">User login</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>