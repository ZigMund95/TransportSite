<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<head>
		<title>test</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<script src="../js/jquery-1.11.3.js" type="text/javascript"> </script>
		<script src="../js/code.js" type="text/javascript"> </script>
		<link rel="stylesheet" href="../style.css" type="text/css" />
		<link rel="stylesheet" href="../pages.css" type="text/css" />
	</head>
<body>
<?

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

$config = mysqli_query($link, "SELECT * FROM `reisi_config`");
$reisi = mysqli_query($link, "SELECT * FROM `reisi` LIMIT 1");
$reisi = mysqli_fetch_assoc($reisi);

while($config1 = mysqli_fetch_assoc($config)){
	$reisi_config[$config1["name"]] = $config1;
}

function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($reisi_config, 'forsort');	

echo '<span id="formoved"> </span>';
echo '<table id="config" count="'.count($reisi_config).'">';
foreach($reisi_config as $key => $value){
	echo '<tr pos="'.$reisi_config[$key]["position"].'">';
	echo '<td>'.$key.'</td>';
	echo '<td> <input type=text value="'.$reisi_config[$key]["value"].'"> </td>';
	echo '<td> <input type=text value="'.$reisi_config[$key]["position"].'"> </td>';
	echo '<td> <button id="tdup" pos="'.$reisi_config[$key]["position"].'"> /\ </button> <button id="tddown" pos="'.$reisi_config[$key]["position"].'"> \/ </button> </td>';
	echo '</tr>';
}
?>

</body>
</html>