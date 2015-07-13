<? 

if(isset($_GET['search'])){
	echo($_GET['search']);
	$search = $_GET['search'];
}
else{
	$search = '';
};

?>




<?
//$visibleColumn = split(';', $_SESSION['visible_column']);
//print_r($visibleColumn);

$link = mysqli_connect('localhost','admin','admin','test');
$config[] = '0';
$record = mysqli_query($link, "SELECT * FROM `drivers_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};


echo '<table id="drivers" class="canselect">';

echo '<tr id="greytd">';
$i = 0;
foreach($config as $key => $value){
	if($value){
		//if($visibleColumn[$i] == '1'){
			echo ('<th>'.$config[$key]['value'].'</th>');
		//}
	$i++;
	}
};
echo('</tr>');

//mb_internal_encoding('UTF-8'); 		

if($search == ''){ $res = mysqli_query($link, "SELECT * FROM `drivers`"); }
else{ $res = mysqli_query($link, "SELECT * FROM `drivers` WHERE `name` LIKE '%".$search."%' "); };
$indexY = 1;
while($row = mysqli_fetch_assoc($res)) {
	//echo('<tr> <td>'.$row['name'].'-'.$search.'</td> </tr>');
	/*if(($row['name'] != '')&($search != '')){
	if((mb_stripos(' '.$row['name'], $search) == false)){ break; };
	
	};*/
	echo '<tr id="selecttr">';
	//echo '<td>'.$row["primech"].'</td>';
	$indexX = 1;
	$i = 0;
	foreach($row as $key => $value){
		//if($visibleColumn[$i] == '1'){
		
		if($key == 'index'){ echo '<th id="greytd">'.$value.'</th>';}
		else{
			if($value != '0000-00-00'){
				echo('<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell">'.$value.'</td>');
			}
			else{
				echo('<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell"> - </td>');
			};
		$indexX++;
		};
		//};
		$i++;
	};
	$indexY++;
};


echo('</table>');
?>

<a href='driver_	add' class='openfr'> Добавить </a>

