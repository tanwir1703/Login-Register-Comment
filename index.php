<?php

session_start();
require 'config.php';

?>

<!DOCTYPE html>
<html>
<head>
<title> Login Page </title>
<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet"> 
	<meta charset="utf-8">
    </head>
	<body style="background: url(back.jpg); background-size: cover; background-position: center">
		<div id="home">

	<div class="box">

	    <h2>Login</h2>
		<form action="index.php" method="post">

		    <div class="inputBox">
			    <input type="text" name="username" autocomplete="off" required="">
				<label>Username</label>
			</div>
            
            <div class="inputBox">
			    <input type="password" name="password" required="">
				<label>Password</label>
			</div>

			<p style="color:#fff; font-size:16px">		
		Account Type:
			<input type="radio" name="type" value="admin" required>Administrator
			<input type="radio" name="type" value="user">User
        </p>
		<br>

			<center>
			<input style="background-color:#2df83e" type="submit" name="login" value="Sign IN">
</center>
		</form>

        <form action="register.php" >
			<span style="color: blue; font-size: 10px"></span><br>
			<center>
			<input name="submit_btn" type="submit" class="register" value="New User? Create Account">
</center>
		</form>

		<?php
		
		if(isset($_POST['login']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$type = $_POST['type'];
			$query = "select * from user WHERE userename='$username' AND password='$password' AND account='$type'";
			$query_run = mysqli_query($con, $query);

			if(mysqli_num_rows($query_run)>0)
			{
				$row= mysqli_fetch_assoc($query_run) ;

				$_SESSION['firstname'] = $row['firstname'];
				header('location: Logout.php');
			}

			else{
				echo '<script type="text/javascript">alert("Invalid Credentials.....")</script>';
			}
		}
		
		?>
	</div>
</div>
</body>
</html>

    