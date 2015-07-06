<?/*
$pageinf = file('../pages/newrecord.inf');
?>

<div id='newrecord'>

<form method='POST'>
		<table>
		<?
		for($i=1;$i<=intval($pageinf[0]);$i++){ 
			$str = $pageinf[$i];
			$name1 = substr($str,0,strpos($str, ';'));
			$str = substr($str,strpos($str, ';')+1);
			$type1 = substr($str,0,strpos($str, ';'));
			$str = substr($str,strpos($str, ';')+1);
			$name2 = substr($str,0,strpos($str, ';'));
			$str = substr($str,strpos($str, ';')+1);
			$type2 = substr($str,0);
		$output ="<tr>
				<td id='tdright' class='td1'>".$name1."</td>
				<td id='tdleft' class='td2'> ".$type1." </td>
				<td id='tdright' class='td1'>".$name2."</td>
				<td id='tdleft' class='td2'>".$type2."</td>
			</tr>
			";
		$output = str_replace('Edit', '<input type=text name="login"> ', $output);
		$output = str_replace('Combo', '<input type=text name="login"> 
					<button type=submit name="plus">+</button>', $output);
		$output = str_replace('Date', '<input type=date name="login"> ', $output);
		echo($output);
		} ?>
			
			<tr>
				<td colspan=3> </td>
				<td id='tdcenter'>
					<button type=submit name='login_button' value='submit'>
						OK
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>*/
?>

<form method="POST">
<p class="column1">
	Заказчик <input type=text class="width156" id="counter"> <button type=submit id="countersform" class="width25">+</button> <br>
	код в АТИ <input type=text class="width185"> <br>
	маршрут <input type=text class="width185"> <br>
	адрес погрузки <input type=text class="width185"> <br>
	дата погрузки <input type=date class="width185"> <br>
	время погрузки <input type=text class="width185"> <br>
	контактное лицо <input type=text class="width185"> <br>
	груз <input type=text class="width185"> <br>
	вес груза <input type=text class="width185"> <br>
	требуемый подвижной <input type=text class="width185"> <br>
	особые условия <input type=text class="width185"> <br>
	адрес выгрузки <input type=text class="width185"> <br>
	дата выгрузки <input type=text class="width185"> <br>
	время прибытия <input type=text class="width185"> <br>
	контактное лицо <input type=text class="width185"> <br>
	ставка БРУТТО <input type=text class="width185"> <br>
	форма оплаты <select class="width185"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
	потери <input type=text class="width185">  <br>
	стака НЕТТО <input type=text class="width185">  <br>
</p>

<p class="column2">
код в АТИ <input type=text class="width185"> <br>
водитель <input type=text class="width156"> <button type=submit class="width25">+</button> <br>
Телефон 1 <input type=text class="width185"> <br>
Телефон 2 <input type=text class="width185"> <br>
а/м <input type=text class="width185"> <br>
форма оплаты <select class="width185"> <option> ? </option>  <option> нал </option>  <option> безнал </option>  <option> с НДС </option> </select> <br>
срок оплаты <input type=text class="width185"> <br>
наша фирма <input type=text class="width156"> <button type=submit class="width25">+</button> <br>
</p>

</form>