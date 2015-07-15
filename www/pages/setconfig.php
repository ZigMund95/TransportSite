<?

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');
mysqli_query($link, "INSERT INTO `counters`(`zakazchik`) VALUES ('asd')");


$record = mysqli_query($link, "SELECT * FROM `counters` LIMIT 1");
$index = 1;
$names[] = '0';
if($record1 = mysqli_fetch_assoc($record)){
	foreach($record1 as $key => $value){
		$names[] = $key;
		$indexs[] = $index;
		$index++;
		
	};

$values = array("", "Индекс", "Фирма", "код в АТИ", "ИНН", "КПП", "ОГРН", "Расч. счет", "Банк", "БИК", 
				"Кор. счет", "Руководитель", "Ф.И.О.", "Сателит 1", "Сателит 2", "Сателит 3",
				"Юр. адрес", "Почтовый адрес", "Имя", "Телефон", "Моб. телефон", "ICQ", "Имя", "Телефон", "Моб. телефон", "ICQ",
				"Имя", "Телефон", "Моб. телефон", "ICQ", "Факс", "Доп. информация");
$query = '';
for($i=1;$i<32;$i++){
	if($names[$i] == 'information'){ $b = ''; } else{ $b = ','; };
	$query = $query."('".$names[$i]."', ".$i.", '".$values[$i]."')".$b;
};

echo ("INSERT INTO `drivers_config`(`name`, `position`, `value`) VALUES".$query);

$res = mysqli_query($link, "INSERT INTO `counters_config`(`name`, `position`, `value`) VALUES".$query);
if($res){
echo '<br> yes';
}
else{
die(mysqli_error($link));
};
};

/*$query = '';
for($i=1;$i<52;$i++){
	$query = $query.'1;';
};
$s = split(';', $query);
print_r($s);
//mysqli_query($link, "UPDATE `users` SET `visiblecolumns`='".$query."'");*/
?>