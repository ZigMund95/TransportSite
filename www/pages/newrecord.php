<? session_start(); ?>

<form method="POST" id="formrecord">

<table id="newrecord">
	<tr>
		<? $currdate = getdate(); $currdate = $currdate["0"]; ?>
		<td id="tdright"> Дата <div name="date" class="date_picker"></div> </td>
		<td id="tdright"> Срыв! <input type=text class="width185" name="sriv"> </td>
		<td id="tdright"> № заказа <input type=text class="width185" name="number" onkeydown="if(event.keyCode != 9){ return false; }"> </td>
		<td id="tdright"> Менеджер <input type=text class="width185" name="manager" value=<? echo $_SESSION['userid']; ?> onkeydown="if(event.keyCode != 9){ return false; }"> </td>
	</tr>
	
	<tr>
		<td id="tdright" colspan=2>
		<hr>
		Заказчик <input type=text class="width156" name="zakazchik" onkeydown="if(event.keyCode != 9){ return false; }"> <button href="counter_search" name="zakazchik" id="openfr" class="openfr width25">+</button> <br>
		код в АТИ <input type=text class="width185" name="ati1" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		маршрут <input type=text class="width185" name="marshrut"> <br>
		адрес погрузки <input type=text class="width185" name="address_pogr"> <br>
		дата погрузки <div name="date_pogr" class="date_picker"></div> <br>
		время погрузки <input type=text class="width185" name="time_pogr"> <br>
		контактное лицо <input type=text class="width185" name="contact1"> <br>
		груз <input type=text class="width185" name="cargo"> <br>
		вес груза <input type=text class="width185" name="cargo_w"> <br>
		требуемый подвижной <input type=text class="width185" name="podvizh"> <br>
		особые условия <input type=text class="width185" name="treb"> <br>
		адрес выгрузки <input type=text class="width185" name="address_vig"> <br>
		дата выгрузки <input type=date class="width185" name="date_vig" class="date_field"> <br>
		время выгрузки <input type=text class="width185" name="time_vig"> <br>
		контактное лицо <input type=text class="width185" name="contact2"> <br>
		ставка БРУТТО <input type=text class="width185" name="brutto" onkeydown="return noLetters(event.keyCode);" onkeyup="calculateNetto();"> <br>
		форма оплаты <select class="width185" name="forma1" onchange="calculateNetto();"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
		потери <input type=text class="width185" name="poteri" onkeydown="return noLetters(event.keyCode);" onkeyup="calculateNetto();">  <br>
		стака НЕТТО <input type=text class="width185"  name="netto" onkeydown="if(event.keyCode != 9){ return false; }">  <br>
		</td>

		<td id="tdright" colspan=2>
		<hr>
		Перевозчик <input type=text class="width156" id="counter"  name="perevozchik" onkeydown="if(event.keyCode != 9){ return false; }"> <button href="counter_search" name="perevozchik" id="openfr" class="openfr width25">+</button> <br>
		код в АТИ <input type=text class="width185" name="ati2" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		водитель <input type=text class="width156"  name="driver" onkeydown="if(event.keyCode != 9){ return false; }"> <button href="drivers_search" id="openfr" class="openfr width25">+</button> <br>
		Телефон 1 <input type=text class="width185"  name="phone1" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		Телефон 2 <input type=text class="width185" name="phone2" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		а/м <input type=text class="width185" name="car" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		форма оплаты <select class="width185" name="forma2" onchange="calculateNetto();"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
		срок оплаты <input type=text class="width185"  name="srok_opl"> <br>
		<br>
		<br>
		наша фирма <input type=text class="width156" name="our_firm"> <button type=submit class="width25">+</button> <br>
		<a href="" id="open_schet"> Печать заявки </a>
		<br>
		<br>
		факт дата выгрузки <input type=date class="width185" name="fact_date_vig"> <br>
		ТТН получена <input type=date class="width185" name="ttn_poluch"> <br>
		ТТН, счет отправлены <input type=date class="width185" name="ttn_otp"> <br>
		</td>
	</tr>

	<tr>
		<td id="tdright" colspan=2>
		<hr>
		поступление от заказчика <br>
		<input type=date class="width185" name="post_date1"> <input type=text class="width185" name="post_sum1" onkeydown="return noLetters(event.keyCode)"> <br>
		<input type=date class="width185" name="post_date2"> <input type=text class="width185" name="post_sum2" onkeydown="return noLetters(event.keyCode)"> <br>
		<input type=date class="width185" name="post_date3"> <input type=text class="width185" name="post_sum3" onkeydown="return noLetters(event.keyCode)"> <br>
		<input type=date class="width185" name="post_date4"> <input type=text class="width185" name="post_sum4" onkeydown="return noLetters(event.keyCode)"> <br>
		долг <input type=text class="width185" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		</td>
	
		<td id="tdright" colspan=2>
		<hr>
		оплачено перевозчику <br>
		<input type=date class="width185" name="opl_date1"> <input type=text class="width185" name="opl_sum1" onkeydown="return noLetters(event.keyCode)"> <br>
		<input type=date class="width185" name="opl_date2"> <input type=text class="width185" name="opl_sum2" onkeydown="return noLetters(event.keyCode)"> <br>
		<input type=date class="width185" name="opl_date3"> <input type=text class="width185" name="opl_sum3" onkeydown="return noLetters(event.keyCode)"> <br>
		<input type=date class="width185" name="opl_date4"> <input type=text class="width185" name="opl_sum4" onkeydown="return noLetters(event.keyCode)"> <br>
		долг <input type=text class="width185" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		</td>
	</tr>
	
	<tr>
		<td colspan=4 id="tdright">
		<hr>
			наш остаток <input type=text class="width185" name="ostat" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
			Примечания <input type=text class="width400" name="primech"> <br>
			<button type=submit class="width156" name="ok">OK</button>
		</td>
	</tr>
</table>
</form>

<? 
if(isset($_GET['index'])){ 
$GET = $_GET;

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

$record = mysqli_query($link, 'SELECT * FROM `reisi` WHERE `index`='.$GET['index']);
$record1 = mysqli_fetch_assoc($record);
print('<script> loadRecordPage(('.json_encode($record1).')) </script>'); 
} 
?>
<script> setDateFields(); </script>
