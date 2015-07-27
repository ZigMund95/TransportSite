<? 
function mb_ucwords($str) { 
$str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8"); 
return ($str); 
}

if(isset($_POST['search'])){
	$search1 = mb_ucwords($_POST['search']);
	$search2 = $_POST['search'];
	echo $search;
}
else{
	$search2 = '';
};

$link = mysqli_connect('localhost','admin','admin','test');
$config[] = '0';
$record = mysqli_query($link, "SELECT * FROM `drivers_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};

function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($config, 'forsort');

echo '<table name="driver" class="table canselect dblclick_select_driver">';

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

//$link->set_charset('cp1251_general_ci');
if($search2 == ''){ $res = mysqli_query($link, "SELECT * FROM `drivers`"); }
else{ $res = mysqli_query($link, "SELECT * FROM `drivers` WHERE `name` LIKE '%".$search1."%' OR `name` LIKE '%".$search2."%'"); };
$indexY = 1;
while($row = mysqli_fetch_assoc($res)) {

	echo '<tr id="selecttr">';
	$indexX = 1;
	$i = 0;
	foreach($row as $key => $value){		
		if($key == 'index'){ echo '<th id="greytd" posX="'.$indexX.'" posY="'.$indexY.'">'.$value.'</th>';}
		else{
			if($value != '0000-00-00'){
				$str = '<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell">'.$value.'</td>';
				if($search2 != ''){ $a = substr($search1, $str); $b = substr($search2, $str); $str = str_replace($a, "<b><u>".$a."</u></b>", $str); $str = str_replace($b, "<b><u>".$b."</u></b>", $str); };
				echo($str);
			}
			else{
				echo('<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell"> - </td>');
			};
		};
		$indexX++;
		$i++;
	};
	$indexY++;
};


echo('</table>');
?>

<a href='driver_add' class='openfr'> Добавить </a>

