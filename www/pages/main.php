<?
$names = file('pages\table.inf');
$visibleColumn = array ('index' => true, 
						'date' => true,
'sriv' => true,
'number' => true,
'manager' => true,
'zakazchik' => true,
'ati1' => true,
'marshrut' => true,
'address_pogr' => true,
'date_pogr' => true,
'time_pogr' => true,
'contact1' => true,
'cargo' => true,
'cargo_w' => true,
'podvizh' => true,
'treb' => true,
'address_vig' => true,
'date_vig' => true,
'time_vig' => true,
'contact2' => true,
'brutto' => true,
'forma1' => true,
'poteri' => true,
'netto' => true,
'perevozchik' => true,
'ati2' => true,
'form2' => true,
'srok_opl' => true,
'our_firm' => true,
'fact_date_vig' => true,
'ttn_poluch' => true,
'ttn_otp' => true,
'post_date1' => true,
'post_sum1' => true,
'post_date2' => true,
'post_sum2' => true,
'post_date3' => true,
'post_sum3' => true,
'post_date4' => true,
'post_sum4' => true,
'opl_date1' => true,
'opl_sum1' => true,
'opl_date2' => true,
'opl_sum2' => true,
'opl_date3' => true,
'opl_sum3' => true,
'opl_date4' => true,
'opl_sum4' => true,
'ostat' => true,
'primech' => true);

$linkreisi = mysqli_connect('localhost','admin','admin','test');

echo '<table id="reisi">';

echo '<tr id="greytd">';
foreach($visibleColumn as $key => $value){
	if($value){
		echo ('<th>'.$key.'</th>');
	}
};
echo('</tr>');
		
$res = mysqli_query($linkreisi, "SELECT * FROM `reisi`");
$indexY = 1;
while($row = mysqli_fetch_assoc($res)) {
	echo '<tr id="selecttr">';
	//echo '<td>'.$row["primech"].'</td>';
	$indexX = 1;
	foreach($row as $key => $value){
		if($visibleColumn[$key]){
		if($key == 'index'){ echo '<th id="greytd">'.$value.'</th>';}
		else{
			if($value != '0000-00-00'){
				echo('<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell">'.$value.'</td>');
			}
			else{
				echo('<td posX="'.$indexX.'" posY="'.$indexY.'" class="cell"> Emptydate </td>');
			};
		$indexX++;
		};
		};
	};
	$indexY++;
};


echo('</table>');
?>
