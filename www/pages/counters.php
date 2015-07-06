
Поиск: <input type=text id='search'>
<? $link_counters = mysqli_connect("localhost", "admin", "admin", "test");

echo '<div id="counters"> <table>';

$record = mysqli_query($link_counters, "SELECT * FROM `counters`");
$index = 1;
while($record1 = mysqli_fetch_assoc($record)){
$str = '<tr>
			<td id="0x'.$index.'"> $1 </td>
			<td id="1x'.$index.'"> $2 </td>
		</tr>';
$index++;
$str = str_replace('$1', $record1['index'], $str);
$str = str_replace('$2', $record1['name'], $str);

echo $str;
}
?>

	</table>
</div>