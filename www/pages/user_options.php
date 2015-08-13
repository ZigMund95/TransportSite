<? session_start(); 

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');
$record = mysqli_query($link, "SELECT * FROM `reisi_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};
function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($config, 'forsort');	

if(isset($_POST['hidden'])){
	$record = mysqli_query($link, "SELECT * FROM `reisi` LIMIT 1");
	$record1 = mysqli_fetch_assoc($record);
	$query = '';
	foreach($config as $key => $value){
		if(isset($_POST[$key])){ $query = $query.'1;'; } else{ $query = $query.'0;'; };
	}
	mysqli_query($link, "UPDATE `users` SET `permissioncolumns`='".$query."', `canopencard`=".$_POST['canopencard']." WHERE `login`='".$_POST['login']."'");
};

echo '<div id="change_pass">';
echo '<form type="POST" id="change_pass_form">';
echo 'Логин: <input type=text name="login" value="'.$_POST["login"].'"> <br>';
echo 'Старый пароль: <input type=password name="old_pass"> <br>';
echo 'Новый пароль: <input type=password name="new_pass"> <br>';
echo 'Подтвердите новый пароль: <input type=password name="confirm_new_pass"> <br>';
echo '<button name="change_pass_send_button"> OK </button>';
echo '</form>';
echo '</div>';


$user = mysqli_query($link, "SELECT * FROM `users` WHERE `login`='".$_POST["login"]."'");
$user = mysqli_fetch_assoc($user);

$a = "";
if($user["canopencard"]){ $a = "checked"; };
echo 'Открытие карточки заказа по двойному щелчку по ячейке в таблице: <input type=checkbox name="canopencard" '.$a.'>';

$visibleColumn = split(';', $_SESSION['visible_column']);
$permissionColumn = split(';', $user['permissioncolumns']);
$i = 0;
$j = 0;
echo '<form method=POST id="permissionform"> <table id="viewtable"> <tr> <td>';
echo '<input type=hidden name="hidden" value="yep">';
foreach($config as $key => $value){
	//if($config[$key]['value'] != '1'){
		if($permissionColumn[$i]){ $b = 'checked'; }else{ $b = ''; };
			echo('<input type=checkbox name="'.$key.'" value="'.$key.'" '.$b.'> '.$config[$key]['value'].' <br>');
			if(($j+1)%10 == 0){ echo '</td> <td>';};
			$j++;
		
	//};
	$i++;
	
};
echo '</td> </tr> </table>';


echo '<button id="setpermission" login="'.$_POST["login"].'"> OK </button>';
echo '<button id="checkall"> Выделить все </button>';
echo '</form>';
?>