<? session_start();

if (!isset($_GET['page'])){
	$page = 'main';
}
else{
	$page = $_GET['page'];
}
/*
$username = "";
if(isset($_SESSION['userid'])){
	$link = mysqli_connect('localhost', 'admin', 'admin', 'test');
	$userid = $_SESSION['userid'];
	$record = mysqli_query($link, "SELECT * FROM `users` WHERE `index`='".$userid."'");
	$record1 = mysqli_fetch_assoc($record);
	$username = $record1['login'];
}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<head>
		<title>test</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script src="js/jquery-1.11.3.js" type="text/javascript"> </script>
		<script src="js/code.js" type="text/javascript"> </script>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	
<body>
<div id="shadow"> </div>
<div id="fr"> </div>
<div id="page">

<div id="header">
	<a href="/"> <img src="images/logo.png" id="logo"> </a>
	<p>
		<? echo("<input type=hidden id='inpsession' value='".$_SESSION['userid']."'>"); ?>
		<a href='#login' class='login'> Вход </a>
		<a href='#register'> Регистация </a>
		<a href='\' id="logout_button"> Exit </a>
		<? //include('pages/login.php');
		/*
		if(isset($_SESSION['userid'])){
			echo('logined as '.$record1['login'].'<br>');
		?>
		<form method='POST'>
			<a href='' id="logout_button"> Exit </a>
			<button type=submit name='logout_button' value='submit'>
				Exit
			</button>
		</form>
		<?}
		else{
			echo("<a href='#login' class='login'> Вход </a>
					<a href='#register'> Регистация </a>");
		}*/?>
		

	
	</p>
</div>

<div id="menu_line">
<div id="menu">
	<ul>
		<li>
			<a href='#newrecord' class='menu' title="Новый заказ"> Новый заказ </a> 
		</li>
		
		<li>
			<a href="" class='menu' title="Справочники"> Справочники </a>
			<ul>
				<li> <a href=""> 1 </a> </li>
				<li> <a href=""> 2 </a> </li>
				<li> <a href=""> 3 </a> </li>
			</ul>
		</li>
		
		<li>
			<a href="" class='menu' title="Должники"> Должники </a>
		</li>
		
		<li>
			<a href="" class='menu' title="Реестр"> Реестр </a>
			<ul>
				<li> <a href=""> 1 </a> </li>
				<li> <a href=""> 2 </a> </li>
				<li> <a href=""> 3 </a> </li>
				<li> <a href=""> 4 </a> </li>
			</ul>
		</li>
		
		<li>
			<a href="" class='menu' title="Настройки"> Настройки </a>
			<ul>
				<li> <a href=""> 1 </a> </li>
				<li> <a href=""> 2 </a> </li>
			</ul>
		</li>
	</ul>
</div>
</div>

<div id="content">
<? 
echo('pages/'.$page.'.php');
include('pages/'.$page.'.php'); 
?>
</div>




<div id="footer">
<? 
echo '<';
echo $_SESSION['userid'];
echo '>';	?>
<p> В этом блоке можно разместить копирайт и счетчики </p>
</div>

</div>


</body>
</html>