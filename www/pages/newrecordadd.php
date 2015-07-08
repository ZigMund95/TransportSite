<?
$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

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

if(isset($_POST['zakazchik'])){
echo 'yes <br>';
$POST = $_POST;
$index = 1;
$keys = '';
$values = '';
foreach($POST as $key => $value){
if($visibleColumn[$key]){
if($key == 'date' ){ $char = ''; }else{ $char = ' ,'; };
$keys = $keys.$char.'`'.$key.'`';
if($value == ''){ $s = '0'; }else{ $s = $value; };
$values = $values.$char."'".$s."'";
};
};
echo("INSERT INTO `reisi` (".$keys.") VALUES(".$values.")");
mysqli_query($link, "INSERT INTO `reisi` (".$keys.") VALUES(".$values.")");
}
else{
echo 'no';
};

?>
