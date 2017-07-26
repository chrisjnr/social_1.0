<?php
include 'classes/DB.php';
 include('./classes/Login.php');


if (isset($_POST['login'])) {
		$username=$_POST['username'];
		$password=$_POST['password'];	


	if (DB::query('SELECT username FROM users WHERE username=:username'
				, array(':username'=>$username))){
		if (password_verify($password,DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
				$cstrong=TRUE;
				$token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
				
				$user_id=DB::query('SELECT id FROM users WHERE username=:username',array('username'=>$username))[0]['id'];
				DB::query('INSERT INTO login_tokens VALUES(\'\', :token,:user_id)', array(':token'=>sha1($token),'user_id'=>$user_id));
					setcookie("SNID",$token,time()+60*60*24*7,'/',NULL,NULL,TRUE);
					setcookie("SNID_",1,time()+60*60*24*3,'/',NULL,NULL,TRUE);
				echo "welcome ";
				
		} else {
				echo "incorrect password!!";
			}
			
					
	} else {
					echo "user does not exist";
				}


} 
?>


<h1>Login</h1>
<form action="login.php" method="post">
	<p><input type="text" name="username" value="" placeholder="Username"></p>
	<p><input type="password" name="password" value="" placeholder="Password"></p>
	
	<p><input type="submit" name="login" value="login"></p>


</form>