<?
$link = mysql_connect('localhost', 'root', '');
mysql_select_db('test');
mysql_set_charset('utf8');
if (isset($_POST['submit'])){
	$InputM = $_POST['login'];
	mysql_query("INSERT INTO `users` ('login') VALUES ($InputM)", $link);
	echo($InputM);
}

?>