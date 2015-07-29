<?
$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

$exceptCol = array('phone1', 'phone2', 'car');
$dateCol = array('date', 'date_pogr', 'date_vig', 'fact_date_vig', 'ttn_poluch', 'ttn_otp', 'post_date1', 'post_date2', 'post_date3', 'post_date4',
				'opl_date1', 'opl_date2', 'opl_date3', 'opl_date4');

if(isset($_POST['zakazchik'])){
	echo 'yes <br>';
	$POST = $_POST;
	
	foreach($dateCol as $key => $value){
		$s = split('-', $POST[$value]);
		if($s[0] < 10){ $s[0] = '0'.$s[0]; }
		if($s[1] < 10){ $s[1] = '0'.$s[1]; }
		$POST[$value] = $s[2].'-'.$s[1].'-'.$s[0];
	}

	$index = 1;
	$keys = '';
	$values = '';
	$query1 = '';
	$query2 = '';
	$query3 = '';
	foreach($POST as $key => $value){
		$key1 = $key;
		if(!in_array($key, $exceptCol)){
			if($key == 'primech' ){ $b = ''; }else{ $b = ', '; };
			$query1 = $query1.'`'.$key.'`'.$b;
			$query2 = $query2."'".$value."'".$b;
			$query3 = $query3."`".$key."`='".$value."'".$b;
		};
	};

	if($POST['index'] != ''){ $query = "UPDATE `reisi` SET ".$query3." WHERE `index`='".$POST['index']."'"; }
	else{ $query = "INSERT INTO `reisi` (".$query1.") VALUES (".$query2.")"; };
	echo '<br>'.$query;
	
	$res = mysqli_query($link, $query);
	if($res){ echo 'ok'; }
	else{ echo '<br>'; die(mysqli_error($link)); };
};

?>
