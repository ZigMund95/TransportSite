<? session_start();

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');


$record = mysqli_query($link, "SELECT * FROM `reisi_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};
function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($config, 'forsort');	

if(isset($_POST['hidden'])){
	$POST = $_POST;
	$record = mysqli_query($link, "SELECT * FROM `reisi` LIMIT 1");
	$record1 = mysqli_fetch_assoc($record);
	$query = '';
	foreach($config as $key => $value){
		if(isset($POST[$key])){ $query = $query.'1;'; } else{ $query = $query.'0;'; };
	}
	mysqli_query($link, "UPDATE `users` SET `visiblecolumns`='".$query."' WHERE `index`='".$_SESSION['userid']."'");
	$_SESSION['visible_column'] = $query;
	$count = 0;
	$str = $query;
	for($i=0;$i <= strlen($str);$i++){
		if($str[$i] == '1'){ $count += 1; };
	}
	$_SESSION['count_column'] = $count;
};

//echo($_SESSION['visible_column'].' '.$_SESSION['count_column']);
$visibleColumn = split(';', $_SESSION['visible_column']);

$i = 0;
$j = 0;
echo '<form method=POST id="viewform"> <table id="viewtable"> <tr> <td>';
echo '<input type=hidden name="hidden" value="yep">';
foreach($config as $key => $value){
	if($config[$key]['value'] != '1'){
	if($visibleColumn[$i]=='1'){ $b = 'checked'; }else{ $b = ''; };
	echo('<input type=checkbox name="'.$key.'" value="'.$key.'" '.$b.'> '.$config[$key]['value'].' <br>');
	if(($j+1)%10 == 0){ echo '</td> <td>';};
	$j++;
	}
	
	$i++;
	
};
echo '</td> </tr> </table>';
?>

<button id='setvision'> OK </button>
<button id='checkall'> Выделить все </button>
</form>