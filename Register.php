<?php

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
    <body style="background: url(back.jpg); background-size: cover; background-position: center">
	<div id="home">

<div class="box">

	<h2>WELCOME! Register Here</h2><br>
	<form action="register.php" method="post">

        
		<div class="inputBox">
			<input type="text" name="firstname" autocomplete="off" required="">
			<label>First Name</label>
		</div>

		
		<div class="inputBox">
			<input type="text" name="lastname" autocomplete="off" required="">
			<label>Last Name</label>
		</div>



		<div class="inputBox">
			<input type="text" name="username" autocomplete="off" required="">
			<label>Username</label>
		</div>
		
        

		<div class="inputBox">
			<input type="password" name="password" required="">
			<label>Type a Password</label>
		</div>

		
		<div class="inputBox">
			<input type="password" name="confirmpassword" required="">
			<label>Confirm Password</label>
		</div>

        <p style="color:#fff; font-size:16px"> Date of Birth :   <input style="font-size:16px" type="date" name="bday" class="form" value="" required> <i class="fa fa-calendar"> </i></p>

        <p style="color:#fff; font-size:16px">
			Gender :
			<input type="radio" name="gender" value="male" required="">Male
			<input type="radio" name="gender" value="female" required="">Female
			<input type="radio" name="gender" value="other" required="">Other
		</p>
 
        <p style="color:#fff; font-size:16px">		
		Account Type:
			<input type="radio" name="type" value="admin" required>Administrator
			<input type="radio" name="type" value="user">User
        </p>
		<br>
		<center><input type="submit" name="submit_btn" value="Create Account"></center>
	</form>
 
	<a href="index.php"><form action="register.php" method="post" >
		<span style="color: blue; font-size: 10px"></span><br>
		<a href="index.php"><center><input style="background-color:rgb(236, 51, 51);" name="back" type="submit" class="back" value="Back To Login"></center></a>
	</form></a>

	<?php
	
	if(isset($_POST['back'])){
		header('location: index.php');
	}

	if(isset($_POST['submit_btn']))
	{
		$firstname=$_POST['firstname'];
	    $lastname=$_POST['lastname'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$confirmpassword=$_POST['confirmpassword'];
		$dob=$_POST['bday'];
		$gender=$_POST['gender'];
		$type=$_POST['type'];


		if($password==$confirmpassword)
		{
			$query = "select * from user WHERE username = '$username'";
			$query_run = mysqli_query($con, $query);

			if(mysqli_num_rows($query_run)>0)
			{
				echo '<script type="text/javascript">alert("Username already exists..... Please select another username")</script>';
			}
			else{
				$query = "insert into user values('', '$firstname', '$lastname','$username', '$password', '$dob', '$gender', '$type')";
				$query_run = mysqli_query($con, $query);
				if($query_run){
					echo '<script type="text/javascript">alert("Congratulations........ You are Successfully Registered")</script>';
				}
				else{
					echo '<script type="text/javascript">alert("There is an error.. Please Try Again")</script>';
				}

			}
		}
		else{
			echo '<script type="text/javascript">alert("Passwords Do Not MATCH...")</script>';
		}
	}
	
	?>
</div>
</div>
            
    </body> 
    </head>
</html>