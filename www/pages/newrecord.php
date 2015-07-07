

<form method="POST" id="formrecord">

<table id="newrecordpage">
	<tr>
		<td id="tdright"> Дата <input type=text class="width185" name=""> </td>
		<td id="tdright"> Срыв! <input type=text class="width185" name=""> </td>
		<td id="tdright"> № заказа <input type=text class="width185" name=""> </td>
		<td id="tdright"> Менеджер <input type=text class="width185" name=""> </td>
	</tr>
	
	<tr>
		<td id="tdright" colspan=2>
		Заказчик <input type=text class="width156" name="zakazchik"> <button type=submit id="countersform" class="width25">+</button> <br>
		код в АТИ <input type=text class="width185" name="ati1"> <br>
		маршрут <input type=text class="width185" name="marshrut"> <br>
		адрес погрузки <input type=text class="width185" name="address_pogr"> <br>
		дата погрузки <input type=date class="width185" name="date_pogr"> <br>
		время погрузки <input type=text class="width185" name="time_pogr"> <br>
		контактное лицо <input type=text class="width185" name="contact1"> <br>
		груз <input type=text class="width185" name="cargo"> <br>
		вес груза <input type=text class="width185" name="cargo_w"> <br>
		требуемый подвижной <input type=text class="width185" name="podvizh"> <br>
		особые условия <input type=text class="width185" name="treb"> <br>
		адрес выгрузки <input type=text class="width185" name="address_vig"> <br>
		дата выгрузки <input type=text class="width185" name="date_vig"> <br>
		время выгрузки <input type=text class="width185" name="time_vig"> <br>
		контактное лицо <input type=text class="width185" name="contact2"> <br>
		ставка БРУТТО <input type=text class="width185" name="brutto"> <br>
		форма оплаты <select class="width185"  name="forma1"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
		потери <input type=text class="width185" name="poteri">  <br>
		стака НЕТТО <input type=text class="width185"  name="netto">  <br>
		</td>

		<td id="tdright" colspan=2>
		Перевозчик <input type=text class="width156" id="counter"  name="perevozchik"> <button type=submit id="countersform" class="width25">+</button> <br>
		код в АТИ <input type=text class="width185" name="ati2"> <br>
		водитель <input type=text class="width156"  name="driver"> <button type=submit class="width25">+</button> <br>
		Телефон 1 <input type=text class="width185"  name="phone1"> <br>
		Телефон 2 <input type=text class="width185" name="phone2"> <br>
		а/м <input type=text class="width185" name="car"> <br>
		форма оплаты <select class="width185"  name="form2"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
		срок оплаты <input type=text class="width185"  name="srok_opl"> <br>
		<br>
		<br>
		наша фирма <input type=text class="width156" name="our_firm"> <button type=submit class="width25">+</button> <br>
		<br>
		<br>
		факт дата выгрузки <input type=date class="width185" name="fact_date_vig"> <br>
		ТТН получена <input type=date class="width185" name="ttn_poluch"> <br>
		ТТН, счет отправлены <input type=date class="width185" name="ttn_otp"> <br>
		</td>
	</tr>

	<tr>
		<td id="tdright" colspan=2>
		поступление от заказчика <br>
		<input type=date class="width185" name="post_date1"> <input type=text class="width185" name="post_sum1"> <br>
		<input type=date class="width185" name="post_date2"> <input type=text class="width185" name="post_sum2"> <br>
		<input type=date class="width185" name="post_date3"> <input type=text class="width185" name="post_sum3"> <br>
		<input type=date class="width185" name="post_date4"> <input type=text class="width185" name="post_sum4"> <br>
		долг <input type=text class="width185"> <br>
		</td>
	
		<td id="tdright" colspan=2>
		оплачено перевозчику <br>
		<input type=date class="width185" name="opl_date1"> <input type=text class="width185" name="opl_sum1"> <br>
		<input type=date class="width185" name="opl_date2"> <input type=text class="width185" name="opl_sum2"> <br>
		<input type=date class="width185" name="opl_date3"> <input type=text class="width185" name="opl_sum3"> <br>
		<input type=date class="width185" name="opl_date4"> <input type=text class="width185" name="opl_sum4"> <br>
		долг <input type=text class="width185"> <br>
		</td>
	</tr>
	
	<tr>
		<td colspan=4 id="tdright">
			наш остаток <input type=text class="width185" name="ostat"> <br>
			Примечания <input type=text class="width400" name="primech"> <br>
			<button type=submit class="width156" name="ok">OK</button>
		</td>
	</tr>
</table>
</form>