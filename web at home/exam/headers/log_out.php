<?php
session_start();
session_unset();
session_destroy();
//echo $_SESSION['f_n'];
//echo 'ewffe';
header('location:../home_page/index.php');
