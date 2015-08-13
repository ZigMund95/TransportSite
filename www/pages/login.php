<? session_start();
$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

if(isset($_POST["login_send"])){
	$login = $_POST["login_send"];
	$password = md5($_POST["password_send"]);
	$record = mysqli_query($link, "SELECT * FROM `users` WHERE `login`='".$login."' AND `password`='".$password."'");
		if($record){
			if($record1 = mysqli_fetch_assoc($record)){
				echo("YES");
				$_SESSION['userid'] = $record1['index'];
				$_SESSION['visible_column'] = $record1['visiblecolumns'];
				$count = 0;
				$str = $record1['visiblecolumns'];
				for($i=0;$i <= strlen($str);$i++){
					if($str[$i] == '1'){ $count += 1; };
				}
				$_SESSION['count_column'] = $count;
				$_SESSION['width_column'] = $record1['widthcolumns'];
				$_SESSION['permission_column'] = $record1['permissioncolumns'];
				$_SESSION['can_open_card'] = $record1['canopencard'];
			}
			else{
				echo("NO");
			}
		}
		mysqli_free_result($record);
};
/*
if (isset($_POST['login_button'])){
	if(($_POST['login'] == "")or($_POST['password'] == "")){
		echo('Empty fields');
	}
	else{
		$login = $_POST['login'];
		$password = md5($_POST['password']);
		$record = mysqli_query($link, "SELECT * FROM `users` WHERE `login`='".$login."' AND `password`='".$password."'");
		if($record){
			if($record1 = mysqli_fetch_assoc($record)){
				echo("YES");
				$_SESSION['userid'] = $record1['index'];
			}
			else{
				echo("NO");
			}
		}
		mysqli_free_result($record);
	}
}*/

if (isset($_POST['event'])){
	unset($_SESSION['userid']);
	unset($_SESSION['visible_column']);
}
?>


<div id='login'>
<?

if(isset($_SESSION['userid'])){
	$userid = $_SESSION['userid'];
	$record = mysqli_query($link, "SELECT * FROM `users` WHERE `index`='".$userid."'");
	$record1 = mysqli_fetch_assoc($record);
	echo('logined as '.$record1['login'].'<br>');	
?>
	<form method='POST'>
		<button type=submit name='logout_button' id='logout_button' value='submit'>
			Exit
		</button>
	</form>
<?
}
else{
	?>
	<form method='POST'>
		<table>
			<tr>
				<td class='tdright'> Login: </td>
				<td class='tdleft'> <input type=text name='login'> </td>
			</tr>
			
			<tr>
				<td class='tdright' class='redfield'> Password: </td>
				<td class='tdleft'> <input type=password name='password'> </td>
			<tr>
			
			<tr>
				<td colspan=2 class='tdcenter'>
					<button type=submit name='login_button' id="login_button" value='submit'>
						OK
					</button>
				</td>
			</tr>
		</table>
	</form>
<? } ?>

</div>
