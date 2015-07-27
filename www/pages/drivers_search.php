<? session_start(); ?>
<form method=POST>
Поиск: <input type=text id='search' name='drivers'>
</form>
<input type=hidden id='action'>
<div id='drivers'>
<? include('../pages/drivers.php'); ?>
</div>