<?
function mb_ucwords($str) { 
$str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8"); 
return ($str); 
}

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

if(isset($_POST['firm'])){
	$POST = $_POST;
	//$POST['firm'] = mb_ucwords($POST['firm']);
	$query1 = '';
	$query2 = '';
	foreach($POST as $key => $value){
		if($key == 'information'){ $b = ''; }else{ $b = ', '; };
		$query1 = $query1."`".$key."`".$b;
		$query2 = $query2."'".$value."'".$b;
		$query3 = $query3."`".$key."`='".$value."'".$b;
	};
	
	if($POST['index'] != ''){ $query = "UPDATE `counters` SET ".$query3." WHERE `index`='".$POST['index']."'"; }
	else{ $query = "INSERT INTO `counters` (".$query1.") VALUES (".$query2.")"; };
	echo '<br>'.$query;
	$res = mysqli_query($link, $query);
	if($res){ echo 'ok'; }
	else{ echo '<br>'; die(mysqli_error($link)); };
};

?>