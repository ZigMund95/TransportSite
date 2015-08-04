<? session_start();
if(isset($_GET["sort"])){ $sort = $_GET["sort"]; $tsort = $_GET["tsort"]; }
else{ $sort = ""; $tsort = 'DESC'; }

$visibleColumn = split(';', $_SESSION['visible_column']);

$link = mysqli_connect('localhost','admin','admin','test');

$config[] = '0';
$record = mysqli_query($link, "SELECT * FROM `reisi_config`");
while($record1 = mysqli_fetch_assoc($record)){
	$config[$record1['name']] = $record1;
};

function forsort($a, $b){ if($a['position'] > $b['position']){ return 1; }else{ return -1; }; };
uasort($config, 'forsort');	

echo '<div>';
echo '<table class="table fixed">';
for($i=0;$i<38;$i++){ echo '<col posX="'.$i.'"> '; };
echo '<tr class="greytd">';
$i = 0;
$indexX = 0;
$tdOut = '';
foreach($config as $key => $value){
	if($value){
		if($visibleColumn[$i] == '1'){
			echo ('<th posX="'.$indexX.'">'.$config[$key]['value'].' 
					<img src="images/arrow.png" id="'.$config[$key]['name'].'" name="'.$tsort.'" class="sortCol">'.'
					<img src="images/arrow.png" id="'.$config[$key]['name'].'" name="'.$tsort.'" class="filterCol">'.'
					<div id="'.$config[$key]['name'].'" class="filterDiv"></div>
					</th>');
			if($config[$key]['name'] != 'index'){
				$tdOut = $tdOut.'<td posX="'.$indexX.'" posY="@posY@" class="cell">@'.$config[$key]['name'].'@</td>';
				$indexX++;
			}
			else{ $indexX++; }
		}
	$i++;
	}
};
echo '</tr>';
echo '</table>';

echo '<div class="tableData">';
echo '<table id="reisi" class="table canselect">';
for($i=0;$i<38;$i++){ echo '<col> '; };
$dateCol = array('date', 'date_pogr', 'date_vig', 'fact_date_vig', 'ttn_poluch', 'ttn_otp', 'post_date1', 'post_date2', 'post_date3', 'post_date4',
				'opl_date1', 'opl_date2', 'opl_date3', 'opl_date4');
if($_SESSION["userid"] == "3"){ $manager = ''; }
else{ $manager = ' WHERE `manager`="'.$_SESSION["userid"].'"'; };
if($sort==""){ $res = mysqli_query($link, "SELECT * FROM `reisi`".$manager); }
else{ $res = mysqli_query($link, "SELECT * FROM `reisi` ORDER BY `".$sort."` ".$tsort.$manager); };
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


echo('</table> </div> </div>');

?>

