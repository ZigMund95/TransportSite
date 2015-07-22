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

echo $search1.' '.$search2;
$link = mysqli_connect('localhost','admin','admin','test');
$config[] = '0';
$record = mysqli_query($link, "SELECT * FROM `counters_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};

function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($config, 'forsort');

echo '<table name="counter" class="table canselect dblclick_select_counter">';

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

if($search2 == ''){ $res = mysqli_query($link, "SELECT * FROM `counters`"); }
else{ $res = mysqli_query($link, "SELECT * FROM `counters` WHERE `firm` LIKE '%".$search1."%' OR `firm` LIKE '%".$search2."%' "); };
$indexY = 1;
while($row = mysqli_fetch_assoc($res)) {

	echo '<tr id="selecttr">';
	$indexX = 1;
	$i = 0;
	foreach($row as $key => $value){		
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
		$i++;
	};
	$indexY++;
};


echo('</table>');
?>

<a href='counter_add' class='openfr'> Добавить </a>

