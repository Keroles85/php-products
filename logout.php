<?php
session_start();
unset($_SESSION['user']);
session_destroy();

header("Location: confirm.php?action=Logout&query=1");
exit;
?>