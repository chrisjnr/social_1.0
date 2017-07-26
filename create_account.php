<?php

include 'classes/DB.php';
if(isset($_POST['create_account'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	if(!DB::query('SELECT username FROM users WHERE username=:username',
		array(':username'=>$username))){

		

			if(strlen($username)>=3 && strlen($username)<=32){
				if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
					if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
						if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
						
						DB::query('INSERT INTO users VALUES(\'\',:username,:password,:email)',array(':username'=>$username,':password'=>password_hash($password,PASSWORD_BCRYPT),':email'=>$email));
						echo "Success";

						} else {
							echo "email already exists ";
						}
						
					} else {
						echo "invalid email";
					}
					
					
				}else{
					echo "invalid username";
				}
				

			}else{
				echo "Username too short";
			}
		}else{
				echo "User alredy exists";
			}

	}
?>


<h1>Register</h1>
<form action="create_account.php" method="post">
	<p><input type="text" name="username" value="" placeholder="Username"></p>
	<p><input type="password" name="password" value="" placeholder="Password"></p>
	<p><input type="email" name="email" value="" placeholder="Email"></p>
	<p><input type="submit" name="create_account" value="Create Account"></p>


</form>