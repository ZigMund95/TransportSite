<? session_start();
if(isset($_POST["sort"])){ $sort = $_POST["sort"]; $tsort = $_POST["tsort"]; }
else{ $sort = ""; $tsort = 'DESC'; }

if($_POST["filter"] != ''){
	$filter = '';
	foreach($_POST["filter"] as $key => $value){
		if($key == 0){ $b = ''; }else{ $b = " AND "; };
			$arr = split(";", $_POST["filter"][$key]);
			$filter = $filter.$b."(";
			for($i=0; $i < (sizeof($arr)-1); $i++){ 
				if($i == 0){ $a = ''; }else{ $a = " OR "; };
				$filter = $filter.$a.'`'.$_POST["filterC"][$key].'` LIKE "'.$arr[$i].'"'; 
			};
			$filter = $filter.")";
	}
}
else{
	$filter = '';
}
//echo $filter;
if(isset($_POST["dolg"])){
	$dolg =  "(`dolg1` <> 0 OR `dolg2` <> 0)";
}
else{
	$dolg = '';
}

$link = mysqli_connect('localhost','admin','admin','test');

$user = mysqli_query($link, "SELECT * FROM `users` WHERE `index`='".$_SESSION["userid"]."'");
$user = mysqli_fetch_assoc($user);
$permissionColumn = split(';', $user['permissioncolumns']);
$visibleColumn = split(';', $_SESSION['visible_column']);
$a = '1;';
for($i = 0; $i < strlen($user['permissioncolumns']); $i++){
	if($user['permissioncolumns'][$i] != ";"){
	$a[$i] = $user['permissioncolumns'][$i]*$_SESSION['visible_column'][$i];
	}
}

$config[] = '0';
$record = mysqli_query($link, "SELECT * FROM `reisi_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};

function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($config, 'forsort');	

$i = 0;
$indexX = 0;
$tdOut = '';
foreach($config as $key => $value){
	if($value){
		if($visibleColumn[$i] && $permissionColumn[$i]){
			if($config[$key]['name'] != 'index'){
				$tdOut = $tdOut.'<td posX="'.$indexX.'" posY="@posY@" class="cell" recid="@recid@" ><span style="width: 100%; height: 100%; display: block; margin: 0;@td_color@"><span style="@text_color@">@'.$config[$key]['name'].'@</span> </span></td>';
				$indexX++;
			}
			else{ $indexX++; }
		}
	$i++;
	}
};

echo '<div class="tableData">';
echo '<table id="reisi" class="table canselect">';
$i = 0;
$j = 0;
foreach($config as $key => $value){ if($config[$key]){ if($a[$i]){ echo '<col colname="'.$config[$key]["name"].'" posX="'.$j.'" style="border-right: '.$config[$key]["border-right"].'; border-left: '.$config[$key]["border-left"].'; background-color: '.$config[$key]["bgcolor"].';">'; $j++;} $i += 2; }};
$dateCol = array('date', 'date_pogr', 'date_vig', 'fact_date_vig', 'ttn_poluch', 'ttn_otp', 'post_date1', 'post_date2', 'post_date3', 'post_date4',
				'opl_date1', 'opl_date2', 'opl_date3', 'opl_date4', 'zarplata_vid');
				
if($_SESSION["userid"] == "3"){ $manager = ''; }
else{ $manager = ' WHERE `manager`="'.$_SESSION["userid"].'"'; };

$query = 'SELECT * FROM `reisi` ';
$where = $manager;
$order = '';
if($dolg != ''){
	if($where != ''){ $where = $where.' AND '.$dolg; }
	else{ $where = ' WHERE '.$dolg; };
};
if($filter != ''){
	if($where != ''){ $where = $where.' AND '.$filter; }
	else{ $where = ' WHERE '.$filter; };
}
if($sort != ""){ $order = " ORDER BY `".$sort."` ".$tsort; };

$res = mysqli_query($link, $query.$where.$order);
//echo $query.$where.$order;
$indexY = 1;

while($row = mysqli_fetch_assoc($res)) {
	$tdOut1 = $tdOut;
	echo '<tr>';
	$indexX = 1;
	$i = 0;
	foreach($config as $key => $value){
		if($visibleColumn[$value["position"]-1]){
		$value = $row[$key];
		if($key == 'index'){ echo '<th class="greytd" posX="'.$indexX.'" posY="'.$indexY.'">'.$value.'</th>';}
		else{
			if($value != '0000-00-00' && $value != ''){
				if(in_array($key, $dateCol)){
					$s = split('-', $value);
					$value = $s[2].'-'.$s[1].'-'.$s[0];
				}
			}
			else{
				$value = '-';
			};
			$tdOut1 = str_replace("@posY@", $indexY, $tdOut1);
			$tdOut1 = str_replace("@recid@", $row["index"], $tdOut1);
			$tdOut1 = str_replace("@".$key."@", $value, $tdOut1);
			if($row["sriv"] == "срыв!"){ $tdOut1 = str_replace("@text_color@", "color: red; text-decoration: line-through;", $tdOut1); }
			if($row["stop_opl"] != ""){ $tdOut1 = str_replace("@td_color@", "; background-color: yellow;", $tdOut1); }
		$indexX++;
		};
		};
		$i++;
	};
	//echo '<br>';
	$indexY++;
echo $tdOut1;
echo '</tr>';
};


echo('</table> </div>');

?>

