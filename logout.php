<?php
ob_start();
session_start();
session_destroy();
header('Location: loginSel.php');
ob_flush();
?>
