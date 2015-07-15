<? session_start(); ?>
<form method=POST>
Поиск: <input type=text id='search' name='drivers'>
</form>

<div id='drivers'>
<? include('../pages/drivers.php'); ?>
</div>