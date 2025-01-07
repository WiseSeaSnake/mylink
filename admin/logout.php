<?php

session_start();
unset($_SESSION['user_id']);
unset($_SESSION['role']);
unset($_SESSION['username']);
header('Location: /');
//header('Location: http://localhost:63342/site_admin/index.php');