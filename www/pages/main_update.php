<?

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');

if(isset($_POST["sriv"])){ mysqli_query($link, "UPDATE `reisi` SET `sriv`='".$_POST["sriv"]."' WHERE `index`='".$_POST["index"]."'"); };
if(isset($_POST["zarplata_vid"])){ 
$s = split('-', $_POST["zarplata_vid"]);
if($s[0] < 10){ $s[0] = '0'.$s[0]; }
if($s[1] < 10){ $s[1] = '0'.$s[1]; }
$date = $s[2].'-'.$s[1].'-'.$s[0];
mysqli_query($link, "UPDATE `reisi` SET `zarplata_vid`='".$date."' WHERE `index`='".$_POST["index"]."'"); };
echo "UPDATE `reisi` SET `zarplata_vid`='".$date."' WHERE `index`='".$_POST["index"]."'";

?>