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
		<link rel="stylesheet" href="pages.css" type="text/css" />
	</head>
	
<body>
<div id="shadow"> </div>
<div id="fr"> </div>
<div id="page">

<div id="header">
	<a href="/"> <img src="images/logo.png" id="logo"> </a>
	<p>
		<? echo("<input type=hidden id='inpsession' value='".$_SESSION['userid']."'>"); ?>
		<a href='login' class='login'> Вход </a>
		<a href='register'> Регистация </a>
		<a href='/' id="logout_button"> Exit </a>
		<? echo("<input type=hidden id='sessioncheck' value='".$_SESSION['userid']."'>")?>
		
	</p>
</div>

<div id="menu_line">
<div id="menu">
	<ul>
		<li>
			<a href='newrecord' class='menu'> Новый заказ </a> 
		</li>
		
		<li>
			<a href="" class='menu nothref'> Справочники </a>
			<ul>
				<li> <a href="our_firm"> Наша фирма </a> </li>
				<li> <a href="counters"> Контрагенты </a> </li>
				<li> <a href="drivers"> Водители </a> </li>
			</ul>
		</li>
		
		<li>
			<a href="dolzhniki" class='menu'> Должники </a>
		</li>
		
		<li>
			<a href="" class='menu nothref'> Реестр </a>
			<ul>
				<li> <a href=""> Счета </a> </li>
				<li> <a href=""> Счета-фактуры </a> </li>
				<li> <a href=""> Акты вып. работ </a> </li>
				<li> <a href=""> Заявки </a> </li>
			</ul>
		</li>
		
		<li>
			<a href="" class='menu nothref'> Настройки </a>
			<ul>
				<li> <a href="view" class='openfr'> Вид </a> </li>
				<li> <a href="sluzhebnie"> Служебные </a> </li>
			</ul>
		</li>
	</ul>
</div>
</div>

<div id="content">
<? 
echo('pages/'.$page.'.php');
//echo $_SESSION['visible_column'];
//include('pages/'.$page.'.php'); 
?>
</div>




<div id="footer">
<? 
echo '<';
echo $_SESSION['userid'];
echo '>';	?>
</div>

</div>


</body>
</html>