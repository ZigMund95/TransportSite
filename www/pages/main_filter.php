<? session_start();
if(isset($_GET["sort"])){ $sort = $_GET["sort"]; $tsort = $_GET["tsort"]; }
else{ $sort = ""; $tsort = 'DESC'; }

if($_GET["filter"] != ''){
	//print_r($_GET["filter"]);
	//print_r($_GET["filterC"]);
	$filter = '';
	foreach($_GET["filter"] as $key => $value){
		if($key == 0){ $b = ''; }else{ $b = " AND "; };
		if(($_GET["filterC"][$key] == "forma1" || $_GET["filterC"][$key] == "forma2") && $_GET["filter"][$key] == '?'){
			$filter = $filter.$b.'`'.$_GET["filterC"][$key].'` LIKE "%"';
		}
		else{
			$filter = $filter.$b.'`'.$_GET["filterC"][$key].'` LIKE "%'.$_GET["filter"][$key].'%"';
		}
	}
}
else{
	$filter = '';
}

if(isset($_GET["dolg"])){
	$dolg =  "(`dolg1` <> 0 OR `dolg2` <> 0)";
}
else{
	$dolg = '';
}

$visibleColumn = split(';', $_SESSION['visible_column']);

$link = mysqli_connect('localhost','admin','admin','test');

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
		if($visibleColumn[$i] == '1'){
			if($config[$key]['name'] != 'index'){
				$tdOut = $tdOut.'<td posX="'.$indexX.'" posY="@posY@" class="cell">@'.$config[$key]['name'].'@</td>';
				$indexX++;
			}
			else{ $indexX++; }
		}
	$i++;
	}
};

echo '<div class="tableData">';
echo '<table id="reisi" class="table canselect">';
for($i=0;$i<38;$i++){ echo '<col> '; };
$dateCol = array('date', 'date_pogr', 'date_vig', 'fact_date_vig', 'ttn_poluch', 'ttn_otp', 'post_date1', 'post_date2', 'post_date3', 'post_date4',
				'opl_date1', 'opl_date2', 'opl_date3', 'opl_date4');
				
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
//echo $query.$where.$order;

$res = mysqli_query($link, $query.$where.$order);
$indexY = 1;
while($row = mysqli_fetch_assoc($res)) {
	$tdOut1 = $tdOut;
	echo '<tr>';
	$indexX = 1;
	$i = 0;
	foreach($row as $key => $value){
		if($visibleColumn[$i] == '1'){
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
			$tdOut1 = str_replace("@".$key."@", $value, $tdOut1);
		$indexX++;
		};
		};
		$i++;
	};
	$indexY++;
echo $tdOut1;
echo '</tr>';
};


echo('</table> </div>');

?>

