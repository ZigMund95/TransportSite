<? session_start(); 
$link = mysqli_connect("localhost", "admin", "admin", "test");
?>

<form method="POST" id="formrecord" onkeydown=" if(event.keyCode == 13) { $(`input:focus ~ input:first`).focus(); return false; }">
<table id="newrecord">
	<tr>
		<input type=hidden name="index">
		<? $currdate = getdate(); $currdate = $currdate["0"]; ?>
		<td class="tdright"> Дата <div name="date" class="date_picker"></div> </td>
		<td class="tdright"> <input type=checkbox id="sriv" onchange="if(this.checked){ $(`[name=sriv]`).val(`срыв!`); $(`[name=sriv]`).attr(`type`, `hidden`); }else{ $(`[name=sriv]`).val(``); $(`[name=sriv]`).attr(`type`, `text`); }"> Срыв! <input type=text class="width185" name="sriv"> </td>
		<?
		$res = mysqli_query($link, "SELECT * FROM `reisi` WHERE `manager`=".$_SESSION['userid']);
		while($res1 = mysqli_fetch_assoc($res)){ $res2 = $res1; };
		$dateNow = time(); $dateNow = getdate($dateNow);
		echo
		$dateStart = mktime(12,0,0,1,1,2015); $dateStart = getdate($dateStart);
		$dayNow = $dateNow["yday"] - $dateStart["yday"] + 605;		
		$numLast = $res2["number"][0].$res2["number"][1].$res2["number"][2];
		if($numLast == $dayNow){ $count = $res2["number"][3]+1; }
		else{ $count = 1; };
		if($count > 9){ $dayNow += 1; $count = 1; };
		$num = $dayNow.$count.$_SESSION['userid'];
		echo '<td class="tdright"> № заказа <input type=text class="width185" name="number" onkeydown="if(event.keyCode != 9){ return false; }" value="'.$num.'"> </td>';
		?>
		<td class="tdright"> Менеджер <input type=text class="width185" name="manager" value=<? echo $_SESSION['userid']; ?> onkeydown="if(event.keyCode != 9){ return false; }"> </td>
	</tr>
	
	<tr>
		<td class="tdright" colspan=2>
		<hr>
		Заказчик <input type=text class="width156" name="zakazchik" onkeydown="if(event.keyCode != 9){ return false; }"> <button href="counter_search" rule="select" name="zakazchik" id="openfr" class="openfr width25">+</button> <br>
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
		дата выгрузки <div name="date_vig" class="date_picker"></div> <br>
		время выгрузки <input type=text class="width185" name="time_vig"> <br>
		контактное лицо <input type=text class="width185" name="contact2"> <br>
		ставка БРУТТО <input type=text class="width185" name="brutto" onkeydown="return noLetters(event.keyCode);" onkeyup="calculateNetto();"> <br>
		форма оплаты <select class="width185" name="forma1" onchange="calculateNetto();"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
		потери <input type=text class="width185" name="poteri" onkeydown="return noLetters(event.keyCode);" onkeyup="calculateNetto();">  <br>
		стака НЕТТО <input type=text class="width185"  name="netto" onkeydown="if(event.keyCode != 9 && event.keyCode != 13){ return false; }">  <br>
		</td>

		<td class="tdright" colspan=2>
		<hr>
		<?
		$res = mysqli_query($link, "SELECT `indexCounter` FROM `sluzhebnaya`");
		$sluz = '';
		while($res1 = mysqli_fetch_assoc($res)){
			$sluz = $sluz.$res1["indexCounter"].';';
		}
		echo "<input type=hidden id='sluz' value='".$sluz."'>";
		
		$file = file("percents.inf");
		echo "<input type=hidden name='percent1' value='".$file[0]."'>";
		echo "<input type=hidden name='percent2' value='".$file[1]."'>";
		?>
		Перевозчик <input type=text class="width156" id="counter"  name="perevozchik" onkeydown="if(event.keyCode != 9){ return false; }"> <button href="counter_search" rule="select" name="perevozchik" id="openfr" class="openfr width25">+</button> <br>
		код в АТИ <input type=text class="width185" name="ati2" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		водитель <input type=text class="width156"  name="driver" onkeydown="if(event.keyCode != 9){ return false; }"> <button href="drivers_search" rule="select" id="openfr" class="openfr width25">+</button> <br>
		Телефон 1 <input type=text class="width185"  name="phone1" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		Телефон 2 <input type=text class="width185" name="phone2" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		а/м <input type=text class="width185" name="car" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		ставка <input type=text class="width185" name="stavka" onkeyup="calculateNetto()"> <br>
		форма оплаты <select class="width185" name="forma2" onchange="calculateNetto();"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
		срок оплаты <input type=text class="width185"  name="srok_opl"> <br>
		<br>
		<br>
		наша фирма <input type=text class="width156" name="our_firm"> <button class="width25">+</button> <br>
		<a href="" id="open_zayavka"> Печать заявки </a>
		<br>
		<br>
		факт дата выгрузки <div name="fact_date_vig" class="date_picker"></div> <br>
		ТТН получена <div name="ttn_poluch" class="date_picker"></div> <br>
		ТТН, счет отправлены <div name="ttn_otp" class="date_picker"></div> <br>
		TTH вручена <div name="ttn_vruch" class="date_picker"></div> <br>
		<br>
		Стоп-оплата <input type=text name="stop_opl"> <br>
		</td>
	</tr>

	<tr>
		<td class="tdright" colspan=2>
		<hr>
		поступление от заказчика <br>
		<div name="post_date1" class="date_picker"></div> 
		<input type=text class="width130" name="post_sum1" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="post_firm1" <! onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="post_firm1" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="post_firm1" checked>
		<br>
		<div name="post_date2" class="date_picker"></div> 
		<input type=text class="width130" name="post_sum2" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="post_firm2" <! onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="post_firm2" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="post_firm2" checked>
		<br>
		<div name="post_date3" class="date_picker"></div> 
		<input type=text class="width130" name="post_sum3" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="post_firm3" onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="post_firm3" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="post_firm3" checked>
		<br>
		<div name="post_date4" class="date_picker"></div> 
		<input type=text class="width130" name="post_sum4" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="post_firm4" onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="post_firm4" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="post_firm4" checked>
		<br>
		долг <input type=text name="dolg1" class="width185" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		</td>
	
		<td class="tdright" colspan=2>
		<hr>
		оплачено перевозчику <br>
		<div name="opl_date1" class="date_picker"></div> 
		<input type=text class="width130" name="opl_sum1" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="opl_firm1" onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="opl_firm1" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="opl_firm1" checked>
		<br>
		<div name="opl_date2" class="date_picker"></div> 
		<input type=text class="width130" name="opl_sum2" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="opl_firm2" onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="opl_firm2" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="opl_firm2" checked>
		<br>
		<div name="opl_date3" class="date_picker"></div> 
		<input type=text class="width130" name="opl_sum3" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="opl_firm3" onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="opl_firm3" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="opl_firm3" checked>
		<br>
		<div name="opl_date4" class="date_picker"></div> 
		<input type=text class="width130" name="opl_sum4" onkeydown="return noLetters(event.keyCode)" onkeyup="calculateDolg();"> 
		<input type=text class="width156" id="counter"  name="opl_firm4" onkeydown="if(event.keyCode != 9){ if($(`#`+$(this).attr(`name`))[0].checked){ return false; }}"> <button href="counter_search" rule="select" name="opl_firm4" id="openfr" class="openfr width25">+</button> 
		<! <input type=checkbox id="opl_firm4" checked>
		<br>
		долг <input type=text name="dolg2" class="width185" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
		</td>
	</tr>
	
	<tr>
		<td colspan=4 class="tdright">
		<hr>
			наш остаток <input type=text class="width185" name="ostat" onkeydown="if(event.keyCode != 9){ return false; }"> <br>
			Примечания <input type=text class="width400" name="primech"> <br>
			<button type=submit id="sendrecord" class="width156" name="ok">OK</button>
		</td>
	</tr>
</table>
</form>

<script> setDateFields(); </script>

<? 
if(isset($_GET['index'])){ 
$GET = $_GET;

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');
$record = mysqli_query($link, 'SELECT * FROM `reisi` WHERE `index`='.$GET['index']);
$record1 = mysqli_fetch_assoc($record);

$dateCol = array('date', 'date_pogr', 'date_vig');
foreach($dateCol as $key => $value){
					$s = split('-', $record1[$value]);
					$record1[$value] = $s[2].'-'.$s[1].'-'.$s[0];
				}

print('<script> loadRecordPage(('.json_encode($record1).')) </script>'); 
} 
?>

