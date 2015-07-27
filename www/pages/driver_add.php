<div id='driveradd'>
<form method="POST" id="formdriver">
		<hr>
		<input type=hidden name="index">
		Фамилия <input type=text class="width185" id="name1" class="name"> <br>
		Имя <input type=text class="width185" id="name2" class="name"> <br>
		Отчество <input type=text class="width185" id="name3" class="name"> <br>
				<input type=hidden id="name" name="name"> <br>
		Телефон 1 <input type=text class="width185" name="phone1"> <br>
		Телефон 2 <input type=text class="width185" name="phone2"> <br>
		Серия/номер паспорта <input type=text class="width185" name="sn_pasport"> <br>
		Выдан паспорт <input type=text class="width185" name="vidan_pasport"> <br>
		Дата выдачи <input type=date class="width185" name="vidan_date"> <br>
		Прописка <input type=text class="width185" name="home"> <br>
		<hr>
		№ вод. удост. <input type=text class="width185" name="n_driver"> <br>
		Тягач <input type=text class="width185" name="car"> <br>
		№ а/м <input type=text class="width185" name="n_car"> <br>
		Тип прицепа <input type=text class="width185" name="type_pricep"> <br>
		Объём, м3 <input type=text class="width185" name="volume_pricep"> <br>
		№ прицепа <input type=text class="width185" name="n_pricep"> <br>
		<hr>
		Доп.информация <input type=text class="width185" name="information"> <br>
		
		<button id="driveraddbutton"> Добавить </button>
</form>
</div>

<? 
if(isset($_GET['index'])){ 
$GET = $_GET;

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

$record = mysqli_query($link, 'SELECT * FROM `drivers` WHERE `index`='.$GET['index']);
$record1 = mysqli_fetch_assoc($record);
print('<script> loadRecordPage(('.json_encode($record1).')) </script>'); 
} 
?>
