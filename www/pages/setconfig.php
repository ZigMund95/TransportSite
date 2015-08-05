<?

$link = mysqli_connect('localhost', 'admin', 'admin', 'test');
mysqli_query($link, "UPDATE `reisi_config` SET `width`=100");

?>