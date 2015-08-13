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
		<title>-</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script src="js/jquery-1.11.3.js" type="text/javascript"> </script>
		<script src="js/code.js" type="text/javascript"> </script>
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="pages.css" type="text/css" />
	</head>
	
<body>
<div id="shadow1"> </div>
<div id="fr1"> </div>

<div id="content">
<? 
echo('pages/'.$page.'.php');
//echo $_SESSION['visible_column'];
//include('main.php'); 
?>

</div>

</body>
</html>