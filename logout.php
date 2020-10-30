<?php
require_once 'php_files/login_helper.php';
init_session();
unset($_SESSION);
session_destroy();
header('Location: /Art Gallery');
?>