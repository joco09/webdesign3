<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../headers/header2_style.css">
</head>
<body>
<header>
        <img src="../images/logo.png" width="90">
        <div class="searchBar">
            <input placeholder="Search in here...">
            <button>
                <img src="../images/magnifier.png">
            </button>
        </div>
        <div class="dropdownNavBar" id="dropdownNavBar">
            <button>
                Menu
            </button>
        </div>
        <ul class="headlinesSection" id="headlinesSection">
            <li><a href="../home_page/index.php">HOME</a></li>
            <li><a href="../classes/classes.php">COURSES AND LESSONS</a></li>

            <?php

//            function foo()
//            {
//                echo 'ouhgrouewfu';
//            }

            if (!isset($_SESSION['f_n']))
            {
                echo '<li><a href="../register_form_page/Register_Form.php">Join</a></li>
                  <li><a href="../login_form_page/LoginForm.php">Log in</a></li>' ;
            }
            else
            {
                echo '<li><a href="../profile_page/profile.php"> '. $_SESSION['f_n'] .' </a></li>';
                echo ' <li><a href="../headers/log_out.php">LOG OUT</a></li>';
            }


            ?>
        </ul>
    </header>
</body>
</html>