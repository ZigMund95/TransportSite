<? session_start(); ?>
<form method=POST>
Поиск: <input type=text id='search' name='counters'>
</form>

<div id='drivers'>
<? include('../pages/counters.php'); ?>
</div>
