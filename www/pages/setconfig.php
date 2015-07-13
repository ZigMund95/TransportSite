<?

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');
//mysqli_query($link, "INSERT INTO `drivers`(`name`) VALUES ('asd')");

$record = mysqli_query($link, "SELECT * FROM `drivers` LIMIT 1");
$index = 1;
$names[] = '0';
if($record1 = mysqli_fetch_assoc($record)){
	foreach($record1 as $key => $value){
		$names[] = $key;
		$indexs[] = $index;
		$index++;
		
	};

$values = array("", "Индекс", "Ф.И.О.", "Телефон 1", "Телефон 1", "Серия/номер паспорта", "Выдан паспорт", "Дата выдачи", "Прописка", "№ вод. удост.", 
				"Тягач", "№ а/м", "Тип прицепа", "Объем прицепа", "№ прицепа", "Информация");
$query = '';
for($i=1;$i<16;$i++){
	if($names[$i] == 'information'){ $b = ''; } else{ $b = ','; };
	$query = $query."('".$names[$i]."', ".$i.", '".$values[$i]."')".$b;
};

echo ("INSERT INTO `drivers_config`(`name`, `position`, `value`) VALUES".$query);

mysqli_query($link, "INSERT INTO `drivers_config`(`name`, `position`, `value`) VALUES".$query);
};

/*$query = '';
for($i=1;$i<52;$i++){
	$query = $query.'1;';
};
$s = split(';', $query);
print_r($s);
//mysqli_query($link, "UPDATE `users` SET `visiblecolumns`='".$query."'");*/
?>