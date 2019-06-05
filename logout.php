<?php
session_start();
unset($_SESSION['user']);

header("Location: confirm.php?action=Logout&query=1");
exit;
?>