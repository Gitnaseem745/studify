<?php
require_once __DIR__ ."/../config/paths.php";
session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600);
header('Location:'.BASE_URL.'/auth/login.php');
exit;
