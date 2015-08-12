<?
function mb_ucwords($str) { 
$str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8"); 
return ($str); 
}
$dateCol = array('date', 'date_pogr', 'date_vig', 'fact_date_vig', 'ttn_poluch', 'ttn_otp', 'post_date1', 'post_date2', 'post_date3', 'post_date4',
				'opl_date1', 'opl_date2', 'opl_date3', 'opl_date4');

if($_POST["filter"] != ''){
	$filter = '';
	foreach($_POST["filter"] as $key => $value){
		if($key == 0){ $b = ''; }else{ $b = " AND "; };
			$arr = split(";", $_POST["filter"][$key]);
			$all[$_POST["filterC"][$key]] = $arr;
			$filter = $filter.$b."(";
			for($i=0; $i < (sizeof($arr)-1); $i++){ 
				if($i == 0){ $a = ''; }else{ $a = " OR "; };
				$filter = $filter.$a.'`'.$_POST["filterC"][$key].'` LIKE "'.$arr[$i].'"'; 
			};
			$filter = $filter.")";
	}
}
else{
	$filter = '';
}
//print_r($all);
if(isset($_POST["dolg"])){
	$dolg =  "(`dolg1` <> 0 OR `dolg2` <> 0)";
}
else{
	$dolg = '';
}

$link = mysqli_connect('localhost','admin','admin','test');
$search = "";
if(isset($_POST["search"])){ $search = $search."WHERE (`".$_POST["idcol"]."` LIKE '%".$_POST["search"]."%' OR `".$_POST["idcol"]."` LIKE '%".mb_ucwords($_POST["search"])."%')"; };
//echo substr_count($search, 'WHERE');
if(isset($_POST["filterC"])){
	if(!in_array($_POST["idcol"], $_POST["filterC"])){
	if($filter != ''){ if(!substr_count($search, 'WHERE')){ $search = $search."WHERE ".$filter; }else{ $search = $search."AND ".$filter; };};
	if($dolg != ''){ if(!substr_count($search, 'WHERE')){ $search = $search."WHERE ".$dolg; }else{ $search = $search."AND ".$dolg; };};
	};
};
$res = mysqli_query($link, "SELECT `".$_POST["idcol"]."` FROM `reisi`".$search." ORDER BY `".$_POST["idcol"]."`");
echo "SELECT `".$_POST["idcol"]."` FROM `reisi`".$search." ORDER BY `".$_POST["idcol"]."`";
$arr = array();
echo '<form>';
while($res1 = mysqli_fetch_assoc($res)){
	if(!in_array($res1[$_POST["idcol"]], $arr)){
		if(in_array($_POST["idcol"], $dateCol)){
			$s = split('-', $res1[$_POST["idcol"]]);
			$value = $s[2].'-'.$s[1].'-'.$s[0];
		}
		else
		{
			$value = $res1[$_POST["idcol"]];
		}
		if($res1[$_POST["idcol"]] == ''){ $value = '-'; };
		
		if($all[$_POST["idcol"]] != ''){
			if(!in_array($res1[$_POST["idcol"]], $all[$_POST["idcol"]])){
				echo '<input type=checkbox class="checkboxinp" idcol="'.$_POST["idcol"].'" value="'.$res1[$_POST["idcol"]].'" onchange=" var i = 0; var values = ``; while(typeof $(`.checkboxinp`).eq(i).val() != `undefined`){ if($(`.checkboxinp`)[i].checked){ values = values+$(`.checkboxinp`).eq(i).val()+`;`; }; i++;}; $(`th`).find(`#`+$(this).attr(`idcol`)+`input`).val(values); "><span style="color: grey">'.$value.'</span><br>';
			}
			else{
				echo '<input type=checkbox class="checkboxinp" idcol="'.$_POST["idcol"].'" value="'.$res1[$_POST["idcol"]].'" onchange=" var i = 0; var values = ``; while(typeof $(`.checkboxinp`).eq(i).val() != `undefined`){ if($(`.checkboxinp`)[i].checked){ values = values+$(`.checkboxinp`).eq(i).val()+`;`; }; i++;}; $(`th`).find(`#`+$(this).attr(`idcol`)+`input`).val(values); ">'.$value.'<br>';
			}
		}
		else{
			echo '<input type=checkbox class="checkboxinp" idcol="'.$_POST["idcol"].'" value="'.$res1[$_POST["idcol"]].'" onchange=" var i = 0; var values = ``; while(typeof $(`.checkboxinp`).eq(i).val() != `undefined`){ if($(`.checkboxinp`)[i].checked){ values = values+$(`.checkboxinp`).eq(i).val()+`;`; }; i++;}; $(`th`).find(`#`+$(this).attr(`idcol`)+`input`).val(values); ">'.$value.'<br>';
		}
		$arr[] = $res1[$_POST["idcol"]];
	}
}	
echo '</form>';
?>
