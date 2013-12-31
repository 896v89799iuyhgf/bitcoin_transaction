<?php
$smarty->assign("Title","Bitcoin Template", true);
$smarty->assign("site_error",$_SESSION['site_error'], true);

$smarty->display('index.tpl');
unset($_SESSION['site_error']);
