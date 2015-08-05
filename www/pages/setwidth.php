<? session_start();

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

if(isset($_GET["widths"])){
	//echo "UPDATE `users` SET `widthcolumns`=".$_GET["widths"]." WHERE `index`=".$_SESSION["userid"];
	mysqli_query($link, "UPDATE `users` SET `widthcolumns`='".$_GET["widths"]."' WHERE `index`=".$_SESSION["userid"]);
	$_SESSION['width_column'] = $_GET["widths"];
	echo $_SESSION['width_column'].'<br>';
}

?>