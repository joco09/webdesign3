<?php

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    require '../database_conncetion/DBConnect.php';

    $userName = $_POST['firstName'];
    $userLastName = $_POST['lastName'];
    $userEmail = $_POST['emailAddress'];
    $userPass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $userPN = $_POST['phoneNumber'];
    $userMemType = $_POST['membershipType'];

    $query = "insert into User_member_table (First_name, Last_name, Phone_number, E_mail, Password, Membership_type_id)
values ('$userName', '$userLastName', '$userPN', '$userEmail', '$userPass', '$userMemType');";

    mysqli_query($connection, $query);
    mysqli_close($connection);

    session_start();

    $_SESSION['f_n'] = $userName;
    $_SESSION['l_n'] = $userLastName;
    $_SESSION['p_n'] = $userPN;
    $_SESSION['email'] = $userEmail;
    $_SESSION['membership'] = $userMemType;

    header('location:../home_page/index.php');
}


?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="register_form.css">
        <script defer src="register_form.js"></script>
        <title>Game Play</title>
    </head>

    <body>

    <?php require '../headers/header2.php'; ?>

    <!-- Don't worry about this -->
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <input type="text" name="firstName">
        <input type="text" name="lastName">
        <input type="text" name="phoneNumber">
        <input type="text" name="emailAddress">
        <input type="text" name="pass">
        <input type="text" name="membershipType">
        <input type="submit">
    </form>

    <div class="form">
        <ul>
            <li class="fullNameInputsContainer">
                <div>
                    <label>First Name: <label class="warningLabels"></label></label>
                    <input type="text">
                </div>
                <div>
                    <label>Last Name: <label class="warningLabels"></label></label>
                    <input type="text">
                </div>
            </li>
            <li>
                <label>Phone number: <label class="warningLabels"></label></label>
                <input type="text">
            </li>
            <li>
                <label>Email: <label class="warningLabels"></label></label>
                <input type="text">
            </li>
            <li>
                <div>
                    <label>PIN: <label class="warningLabels"></label></label>
                    <div class="passwordInputContainer">
                        <input type="password">
                        <button><img src="../images/eye.png"></button>
                    </div>
                </div>
            </li>
            <li>
                <div>
                    <label>Confirm PIN: <label class="warningLabels"></label></label>
                    <div class="passwordInputContainer">
                        <input type="password">
                        <button><img src="../images/eye.png"></button>
                    </div>
                </div>
            </li>
            <li>
                <label>Choose your membership: <label class="warningLabels"></label></label>
                <div class="membershipsContainer">
                    <div>
                        <label>Bronze</label>
                        <button>
                            <img src="../images/bronze-cup.png" width="70">
                        </button>
                        <label>£9.99</label>
                    </div>
                    <div>
                        <label>Silver</label>
                        <button>
                            <img src="../images/silver-cup.png" width="70">
                        </button>
                        <label>£19.99</label>
                    </div>
                    <div>
                        <label>Gold</label>
                        <button>
                            <img src="../images/gold-cup.png" width="70">
                        </button>
                        <label>£29.99</label>
                    </div>
                </div>
            </li>
            <li>
                <button class="registerBtn">SIGN UP</button>
            </li>
        </ul>
    </div>

    </body>

    </html>