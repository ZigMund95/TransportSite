<?
$link = mysqli_connect('localhost','admin','admin','test');
//echo $_POST["idcol"];
echo '<a idcol="'.$_POST["idcol"].'" class="sortCol" tsort="ASC"> Сортировка по возрастанию </a> <br>';
echo '<a idcol="'.$_POST["idcol"].'" class="sortCol" tsort="DESC"> Сортировка по убыванию </a> <br>';
echo '<hr>';
echo '<input type=text idcol="'.$_POST["idcol"].'" id="filterInp" onkeyup=" filterFr($(this)); "> <br>';
echo '<hr>';
echo '<div>';
include("filter_list.php");
/*
$arr = array();
echo '<form>';
while($res1 = mysqli_fetch_assoc($res)){
	if($res1[$_POST["idcol"]] == ''){ $res1[$_POST["idcol"]] = '-'; };
	if(!in_array($res1[$_POST["idcol"]], $arr)){
	echo '<input type=checkbox class="checkboxinp" idcol="'.$_POST["idcol"].'" value="'.$res1[$_POST["idcol"]].'" onchange=" var i = 0; var values = ``; while(typeof $(`.checkboxinp`).eq(i).val() != `undefined`){ if($(`.checkboxinp`)[i].checked){ values = values+$(`.checkboxinp`).eq(i).val()+`;`; }; i++;}; $(`th`).find(`#`+$(this).attr(`idcol`)+`input`).val(values); ">'.$res1[$_POST["idcol"]].'<br>';
	$arr[] = $res1[$_POST["idcol"]];
	}	
};
echo '</form>';*/
echo '</div>';
echo '<button id="filterstart" idcol="'.$_POST["idcol"].'"> ОК </button>';
echo '<button id="filtercancel" idcol="'.$_POST["idcol"].'"> Отмена </button>';
?>