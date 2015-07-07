<?
$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

if(isset($_REQUEST['zakazchik'])){
echo 'yes';
echo $_POST['zakazchik'];
}
else{
echo 'no';
};

?>
