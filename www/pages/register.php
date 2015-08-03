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
//mysqli_query($link, "INSERT INTO `test`.`users`(`login`) VALUES('asd')");

if (isset($_POST['register'])){
	if(($_POST['login'] !== "")and($_POST['email'] !== "")and($_POST['password'] !== "")and($_POST['confirm_password'] !== "")){
	if($_POST['password'] == $_POST['confirm_password']){
		$login = $_POST['login'];
		$email = $_POST['email'];
		$salt = genSalt();
		$password = md5($_POST['password']); //md5(md5($_POST['password']) + $salt);
		//echo ' '.$login.' '.$email.' '.$password.' '.$salt;
		mysqli_query($link, "INSERT INTO `test`.`users`(`login`,`email`,`password`,`salt`) VALUES('".$login."','".$email."','".$password."','".$salt."')");
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
				<td class='tdright'> Login: </td>
				<td class='tdleft'> <input type=text name='login'> </td>
			</tr>
			
			<tr>
				<td class='tdright'> E-mail: </td>
				<td class='tdleft'> <input type=text name='email'> </td>
			</tr>
			
			<tr>
				<td class='tdright'> Password: </td>
				<td class='tdleft'> <input type=password name='password'> </td>
			</tr>
			
			<tr>
				<td class='tdright'> Confirm password: </td>
				<td class='tdleft'> <input type=password name='confirm_password'> </td>
			</tr>
			
			<tr>
				<td colspan=2 class='tdcenter'>
					<button type=submit name='register' value='submit'>
						OK
					</button>
				</td>
			</tr>
		</table>
		
	</form>
</div>