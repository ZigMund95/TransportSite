<?
$names = file('pages\table.inf');

$linkreisi = mysqli_connect('localhost','admin','admin','test');

if(isset($_REQUEST["number"])){
	$num = $_REQUEST["number"];
	mysqli_query($linkreisi, "INSERT INTO `test`.`reisi` (`number`, `date`, `manager`) VALUES ('".$num."', '2015-06-15', '1')");
}

echo('<table id="reisi"> 
		<tr id="greytd">');
for($i=0;$i<29;$i++){ echo('<th>'.$names[$i].'</th>'); }
echo('</tr>');
		
$res = mysqli_query($linkreisi, "SELECT * FROM `reisi`");
$index = 1;
while($row = mysqli_fetch_assoc($res)) {
    //выводим как нам надо
	$row['index'] = $index;
	$index++;
	$table = '
	<tr id="selecttr">
		<th id="greytd"> Index </th>
		<td id="1x'.($index-1).'" class="cell"> Number </td>
		<td id="2x'.($index-1).'" class="cell"> Sriv </td>
		<td id="3x'.($index-1).'" class="cell"> Date </td>
		<td id="4x'.($index-1).'" class="cell"> Manager </td>
	</tr>';
	$replace = array('Index', 'Number', 'Sriv', 'Date', 'Manager');
	$rowname = array('index', 'number', 'sriv', 'date', 'manager');
	for($i=0; $i < 5; $i++){ $table = str_replace($replace[$i], $row[$rowname[$i]], $table); }
	echo($table);
	}


echo('</table>');
?>
<form>
	<input type=text id="number">
	<button type=submit id="add">
		ok
	</button>
</form>

