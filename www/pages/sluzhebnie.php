<? $link = mysqli_connect("localhost", "admin", "admin", "test") ?>

<?
if(isset($_POST["login"])){
	$res = mysqli_query($link, "SELECT * FROM `users` WHERE `login`='".$_POST['login']."' AND `password`='".md5($_POST['old_pass'])."'" );
	mysqli_query($link, "UPDATE `users` SET `password`='".md5($_POST['new_pass'])."' WHERE `login`='".$_POST['login']."' AND `password`='".md5($_POST['old_pass'])."'" );
	if(mysqli_fetch_assoc($res)){ echo 'Изменен пароль для пользователя <b>'.$_POST['login'].'</b>'; }
	else{ die('notfind'); };
}
?>

<div id="sluzhebnaya">
перевозчики, для которых экспедиция установлена в размере 5% <span class="bir"> 5% </span>
<table class="table1 tdcenter">

<?
for($i=1;$i<11;$i++){
echo '<tr>';
echo '<td>'.$i.'</td>';
echo '<td>  </td>';
echo '</tr>';
}
?>

</table>
<hr>
<b> алгоритм расчета ставки-нетто в карточке заказа </b> <br>
1. если форма оплаты "удобная" то: <br>
ставка-нетто = ставка-брутто минус потери <br>
2. если форма оплаты "перечисление без НДС" то: <br>
ставка-нетто = ставка-брутто минус 2% от ставки-брутто минус потери <span class="bir"> 2% </span> <br>
3. если форма оплаты "перечисление с НДС" то: <br>
ставка-нетто = ставка-брутто минус 6% от ставки-брутто минус потери <span class="bir"> 6% </span> <br>
<hr>
<div id="sluzhebnie">
<br>
<table class='canselect'>
<?

$record = mysqli_query($link, "SELECT `index`,`login` FROM `users`");
$indexY = 1;
while($record1 = mysqli_fetch_assoc($record)){
	$indexX = 0;
	echo "<tr>";
	foreach($record1 as $value){
		echo "<td id='".$indexX."x".$indexY."' posX='".$indexX."' posY='".$indexY."'>".$value."</td>";
		$indexX++;
	};
	echo "</tr>";
	$indexY++;
};

?>
</table>

</div>

<div id="change_pass">
<form type="POST" id="change_pass_form">
	Логин: <input type=text name="login"> <br>
	Старый пароль: <input type=text name="old_pass"> <br>
	Новый пароль: <input type=password name="new_pass"> <br>
	Подтвердите новый пароль: <input type=password name="confirm_new_pass"> <br>
	<button name="change_pass_send_button">
		OK
	</button>
</form>
</div>

</div>