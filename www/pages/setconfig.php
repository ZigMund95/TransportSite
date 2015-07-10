<?

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');
/*
$record = mysqli_query($link, "SELECT * FROM `reisi` LIMIT 1");
$index = 1;
$names[] = '0';
if($record1 = mysqli_fetch_assoc($record)){
	foreach($record1 as $key => $value){
		$names[] = $key;
		$indexs[] = $index;
		$index++;
		
	};

$values = array("0", "Индекс", "Дата", "Срыв!", "№ заявки", "Менеджер", "Заказчик", "код в АТИ", "Маршрут", "Адрес погрузки", "Дата погрузки", "Время погрузки",
				"Контактное лицо", "Груз", "Вес груза", "Подвижной", "Особые условия", "Адрес выгрузки", "Дата выгрузки", "Время выгрузки", "Контактное лицо",
				"ставка БРУТТО", "форма оплаты", "Потери", "ставка НЕТТО", "Перевозчик", "код в АТИ", "форма оплаты",	 "Водитель", "Срок оплаты", "Наша фирма", "Факт. дата. выг",
				"ТТН получена", "ТТН, счет отп.", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "1", "Наш остаток", "Примечания");
$query = '';
for($i=1;$i<52;$i++){
	if($names[$i] == 'primech'){ $b = ''; } else{ $b = ','; };
	$query = $query."('".$names[$i]."', ".$i.", '".$values[$i]."')".$b;
};

echo ("INSERT INTO `reisi_config`(`name`, `position`, `value`) VALUES".$query);

mysqli_query($link, "INSERT INTO `reisi_config`(`name`, `position`, `value`) VALUES".$query);
};
*/
$query = '';
for($i=1;$i<52;$i++){
	$query = $query.'1;';
};
$s = split(';', $query);
print_r($s);
//mysqli_query($link, "UPDATE `users` SET `visiblecolumns`='".$query."'");
?>