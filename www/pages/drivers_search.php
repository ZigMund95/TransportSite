<? session_start(); ?>
<form method=GET>
Поиск: <input type=text id='drivers_search'>
</form>

<div id='drivers'>
<? include('../pages/drivers.php'); ?>
</div>