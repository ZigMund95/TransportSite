<? session_start(); ?>
<form method=POST>
Поиск: <input type=text id='search' name='counters'>
</form>
<input type=hidden id='action'>
<input type=hidden id='button_pressed'>
<div id='drivers'>
<? include('../pages/counters.php'); ?>
</div>
