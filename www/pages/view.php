<? session_start();

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

if(isset($_POST['hidden'])){
	$POST = $_POST;
	$record = mysqli_query($link, "SELECT * FROM `reisi` LIMIT 1");
	$record1 = mysqli_fetch_assoc($record);
	$query = '';
	foreach($record1 as $key => $value){
		if(isset($POST[$key])){ $query = $query.'1;'; } else{ $query = $query.'0;'; };
	}
	mysqli_query($link, "UPDATE `users` SET `visiblecolumns`='".$query."'");
	$_SESSION['visible_column'] = $query;
};


//echo $_SESSION['visible_column'];
$visibleColumn = split(';', $_SESSION['visible_column']);
//print_r($visibleColumn);

$config[] = '0';
$record = mysqli_query($link, "SELECT * FROM `reisi_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};

$record = mysqli_query($link, "SELECT * FROM `reisi` LIMIT 1");
$record1 = mysqli_fetch_assoc($record);
$i = 0;
echo '<form method=POST id="viewform"> <table id="viewtable"> <tr> <td>';
echo '<input type=hidden name="hidden" value="yep">';
foreach($record1 as $key => $value){
	if($visibleColumn[$i]=='1'){ $b = 'checked'; }else{ $b = ''; };
	echo('<input type=checkbox name="'.$key.'" value="'.$key.'" '.$b.'> '.$config[$key]['value'].' <br>');
	if(($i+1)%10 == 0){ echo '</td> <td>';};
	$i++;
};
echo '</td> </tr> </table>';
?>

<button id='setvision'> OK </button>
<button id='checkall'> Выделить все </button>

</form>