<?
function genSalt(){
	$chars = 'qwertyuiopasdfghjklzxcvbnm QWERTYUIOPASDFGHJKLZXCVBNM,./<>?;:!@#$%^&*)(-=+';
	$size = strlen($chars);
	$salt = '';
	for($i = 0; $i < 6; $i++){
		$salt .= $chars[rand(0, $size-1)];
	}
	return $salt;
}

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

if (isset($_POST['register'])){
	if(($_POST['login'] !== "")and($_POST['email'] !== "")and($_POST['password'] !== "")and($_POST['confirm_password'] !== "")){
	if($_POST['password'] == $_POST['confirm_password']){
		$login = $_POST['login'];
		$email = $_POST['email'];
		$salt = genSalt();
		$password = md5($_POST['password']); //md5(md5($_POST['password']) + $salt);
		mysqli_query($link, "INSERT INTO `test`.`users`(`login`,`e-mail`,`password`,`salt`) VALUES('".$login."','".$email."','".$password."','".$salt."')");
	}
	else{
		echo("Different Passwords");
	}
	}
	else{
		echo("Empty fields");
	}
	
}
?>

<div id='register'>
	<form method="POST">
		<table>
			<tr>
				<td id='tdright'> Login: </td>
				<td id='tdleft'> <input type=text id='login'> </td>
			</tr>
			
			<tr>
				<td id='tdright'> E-mail: </td>
				<td id='tdleft'> <input type=text id='email'> </td>
			</tr>
			
			<tr>
				<td id='tdright'> Password: </td>
				<td id='tdleft'> <input type=password id='password'> </td>
			</tr>
			
			<tr>
				<td id='tdright'> Confirm password: </td>
				<td id='tdleft'> <input type=password id='confirm_password'> </td>
			</tr>
			
			<tr>
				<td colspan=2 id='tdcenter'>
					<button type=submit name='register' value='submit'>
						OK
					</button>
				</td>
			</tr>
		</table>
		
	</form>
</div>