<?
$pageinf = file('pages/newrecord.inf');
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
				<td id='tdright'>".$name1."</td>
				<td id='tdleft'> ".$type1."
				</td>
				<td id='tdright'>".$name2."</td>
				<td id='tdleft'>".$type2."</td>
			</tr>
			";
		$output = str_replace('Edit', '<input type=text name="login"> ', $output);
		$output = str_replace('Combo', '<input type=text name="login"> 
					<button type=submit name="plus">+</button>', $output);
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
</div>