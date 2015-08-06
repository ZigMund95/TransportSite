<?
function mb_ucwords($str) { 
$str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8"); 
return ($str); 
}

$link = mysqli_connect('localhost','admin','admin','test');
if(isset($_GET["search"])){ $search = "WHERE `".$_GET["idcol"]."` LIKE '%".$_GET["search"]."%' OR `".$_GET["idcol"]."` LIKE '%".mb_ucwords($_GET["search"])."%'"; };
$res = mysqli_query($link, "SELECT `".$_GET["idcol"]."` FROM `reisi`".$search." ORDER BY `".$_GET["idcol"]."`");
$arr = array();
echo '<form>';
while($res1 = mysqli_fetch_assoc($res)){
	if($res1[$_GET["idcol"]] == ''){ $res1[$_GET["idcol"]] = '-'; };
	if(!in_array($res1[$_GET["idcol"]], $arr)){
	echo '<input type=checkbox class="checkboxinp" idcol="'.$_GET["idcol"].'" value="'.$res1[$_GET["idcol"]].'" onchange=" var i = 0; var values = ``; while(typeof $(`.checkboxinp`).eq(i).val() != `undefined`){ if($(`.checkboxinp`)[i].checked){ values = values+$(`.checkboxinp`).eq(i).val()+`;`; }; i++;}; $(`th`).find(`#`+$(this).attr(`idcol`)+`input`).val(values); ">'.$res1[$_GET["idcol"]].'<br>';
	$arr[] = $res1[$_GET["idcol"]];
	}	
};
echo '</form>';
?>