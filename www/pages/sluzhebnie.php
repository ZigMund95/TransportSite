<? $link = mysqli_connect("localhost", "admin", "admin", "test") ?>
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
<form>
	Старый пароль: <input type=text name="old_pass"> <br>
	Новый пароль: <input type=password name="new_pass"> <br>
	Подтвердите новый пароль: <input type=password name="confirm_new_pass"> <br>
	<button name="change_pass_button">
		OK
	</button>
</form>
</div>