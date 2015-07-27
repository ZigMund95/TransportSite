<?
$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

$exceptCol = array('phone1', 'phone2', 'car');

if(isset($_POST['zakazchik'])){
echo 'yes <br>';
$POST = $_POST;
$index = 1;
$keys = '';
$values = '';
foreach($POST as $key => $value){
$key1 = $key;
if(!in_array($key, $exceptCol)){
if($key == 'date' ){ $char = ''; }else{ $char = ' ,'; };
$keys = $keys.$char.'`'.$key.'`';
$s = $value;
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
