<?
$link = mysqli_connect('localhost','admin','admin','test');

echo '<a idcol="'.$_GET["idcol"].'" class="sortCol" tsort="ASC"> Сортировка по возрастанию </a> <br>';
echo '<a idcol="'.$_GET["idcol"].'" class="sortCol" tsort="DESC"> Сортировка по убыванию </a> <br>';
echo '<hr>';
echo '<input type=text idcol="'.$_GET["idcol"].'" id="filterInp" onkeyup="$(`th`).find(`#`+$(this).attr(`idcol`)+`input`).val($(this).val());"> <br>';
echo '<hr>';
$res = mysqli_query($link, "SELECT `".$_GET["idcol"]."` FROM `reisi`");
echo '<div>';
$arr = array();
echo '<form>';
while($res1 = mysqli_fetch_assoc($res)){
	if($res1[$_GET["idcol"]] == ''){ $res1[$_GET["idcol"]] = '-'; };
	if(!in_array($res1[$_GET["idcol"]], $arr)){
	echo '<input type=radio name="'.$_GET["idcol"].'" value="'.$res1[$_GET["idcol"]].'" onchange="$(`th`).find(`#`+$(this).attr(`name`)+`input`).val($(this).val());">'.$res1[$_GET["idcol"]].'<br>';
	$arr[] = $res1[$_GET["idcol"]];
	}	
};
echo '</form>';
echo '</div>';
echo '<button id="filterstart" idcol="'.$_GET["idcol"].'"> ОК </button>';
echo '<button id="filtercancel" idcol="'.$_GET["idcol"].'"> Отмена </button>';
?>