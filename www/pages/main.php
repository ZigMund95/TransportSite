<? session_start();
//$names = file('pages\table.inf');

if(isset($_GET["sort"])){ $sort = $_GET["sort"]; $tsort = $_GET["tsort"]; }
else{ $sort = ""; $tsort = 'DESC'; }

$visibleColumn = split(';', $_SESSION['visible_column']);
//print_r($visibleColumn);

$link = mysqli_connect('localhost','admin','admin','test');
$config[] = '0';
$record = mysqli_query($link, "SELECT * FROM `reisi_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};


function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($config, 'forsort');	

//echo '<p class="kepka"> sdd </p>';

echo '<table id="reisi" class="table canselect">';

echo '<tr id="greytd">';
$i = 0;
foreach($config as $key => $value){
	if($value){
		if($visibleColumn[$i] == '1'){
			echo ('<th>'.$config[$key]['value'].'<img src="images/arrow.png" id="'.$config[$key]['name'].'" name="'.$tsort.'">'.'</th>');
		}
	$i++;
	}
};
echo('</tr>');

$dateCol = array('date', 'date_pogr', 'date_vig', 'fact_date_vig', 'ttn_poluch', 'ttn_otp', 'post_date1', 'post_date2', 'post_date3', 'post_date4',
				'opl_date1', 'opl_date2', 'opl_date3', 'opl_date4');
if($_SESSION["userid"] == "3"){ $manager = ''; }
else{ $manager = ' WHERE `manager`="'.$_SESSION["userid"].'"'; };
if($sort==""){ $res = mysqli_query($link, "SELECT * FROM `reisi`".$manager); }
else{ $res = mysqli_query($link, "SELECT * FROM `reisi` ORDER BY `".$sort."` ".$tsort.$manager); };
$indexY = 1;
while($row = mysqli_fetch_assoc($res)) {
	echo '<tr>';
	$indexX = 1;
	$i = 0;
	foreach($row as $key => $value){
		if($visibleColumn[$i] == '1'){
		if($key == 'index'){ echo '<th id="greytd" posX="'.$indexX.'" posY="'.$indexY.'">'.$value.'</th>';}
		else{
			if($value != '0000-00-00' && $value != ''){
				if(in_array($key, $dateCol)){
					$s = split('-', $value);
					$value = $s[2].'-'.$s[1].'-'.$s[0];
				}
				echo('<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell">'.$value.'</td>');
			}
			else{
				echo('<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell"> - </td>');
			};
		$indexX++;
		};
		};
		$i++;
	};
	$indexY++;
};


echo('</table>');

?>

