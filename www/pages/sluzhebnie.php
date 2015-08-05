<? $link = mysqli_connect("localhost", "admin", "admin", "test") ?>

<?
if(isset($_POST["login"])){
	$res = mysqli_query($link, "SELECT * FROM `users` WHERE `login`='".$_POST['login']."' AND `password`='".md5($_POST['old_pass'])."'" );
	mysqli_query($link, "UPDATE `users` SET `password`='".md5($_POST['new_pass'])."' WHERE `login`='".$_POST['login']."' AND `password`='".md5($_POST['old_pass'])."'" );
	if(mysqli_fetch_assoc($res)){ echo 'Изменен пароль для пользователя <b>'.$_POST['login'].'</b>'; }
	else{ die('notfind'); };
}

if(isset($_GET["indexCounter"])){
	
	if(isset($_GET["indexC"])){ mysqli_query($link, "UPDATE `sluzhebnaya` SET `indexCounter`='".$_GET["indexCounter"]."' WHERE `index`='".$_GET["indexC"]."'"); }
	else{ mysqli_query($link, "INSERT INTO `sluzhebnaya` (`indexCounter`) VALUES ('".$_GET["indexCounter"]."')"); };
}
?>

<div id="sluzhebnaya">
перевозчики, для которых экспедиция установлена в размере 5% <span class="bir"> 5% </span>

<table class="table1">
<col> <col> <col>
<?
$res = mysqli_query($link, "SELECT * FROM `sluzhebnaya`");
$i = 1;
while($res1 = mysqli_fetch_assoc($res)){
$counter = mysqli_query($link, "SELECT `firm` FROM `counters` WHERE `index`=".$res1["indexCounter"]);
$counter1 = mysqli_fetch_assoc($counter);
echo '<tr posY="'.$res1["index"].'"	>';
echo '<td class="tdright">'.$i.'</td>';
echo '<td>'.$counter1["firm"].'</td>';
echo '<td> <button href="counter_search" rule="select_sluzhebnaya" butN="'.$res1["index"].'" class="openfr"> Изменить </button> </td>';
echo '</tr>';
$i++;
$j = $res1["index"]+1;
};
echo '<tr posY="'.$j.'">';
echo '<td class="tdright"></td>';
echo '<td></td>';
echo '<td> <button href="counter_search" rule="select_sluzhebnaya" butN="'.$j.'" class="openfr"> Добавить </button> </td>';
echo '</tr>';
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


</div>