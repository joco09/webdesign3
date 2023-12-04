<?php

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $userEmail = htmlspecialchars($_POST['uEmail']);
    $userPassword = htmlspecialchars($_POST['uPIN']);

    require '../database_conncetion/DBConnect.php';

    $userQuery = "SELECT * FROM User_member_table WHERE E_mail = '{$userEmail}';";
    $userResult = mysqli_query($connection, $userQuery);

    if (mysqli_num_rows($userResult) > 0)
    {
        $userResultArray = mysqli_fetch_array($userResult, MYSQLI_ASSOC);

        if (password_verify($userPassword, $userResultArray['Password']))
        {
            session_start();
            $_SESSION['memberID'] = $userResultArray['Member_id'];
            $_SESSION['f_n'] = $userResultArray['First_name'];
            $_SESSION['l_n'] = $userResultArray['Last_name'];
            $_SESSION['p_n'] = $userResultArray['Phone_number'];
            $_SESSION['email'] = $userResultArray['E_mail'];
            $_SESSION['membership'] = $userResultArray['Membership_type_id'];

            header('location:../home_page/index.php');
        }
    }
    else
    {
        $staffQuery = "SELECT * FROM User_staff_table WHERE E_mail = '{$userEmail}' AND Password = '{$userPassword}';";
        $staffResult = mysqli_query($connection, $staffQuery);

        if (mysqli_num_rows($staffResult) > 0)
        {
            session_start();
            $staffResultArray = mysqli_fetch_array($staffResult, MYSQLI_ASSOC);

            $_SESSION['f_n'] = $staffResultArray['First_name'];
            $_SESSION['l_n'] = $staffResultArray['Last_name'];
            $_SESSION['p_n'] = $staffResultArray['Phone_number'];
            $_SESSION['email'] = $staffResultArray['E_mail'];
            $_SESSION['clearance'] = $staffResultArray['Clearance_level'];

            header('location:../home_page/index.php');
        }
        else
            echo 'Wrong credentials';
    }

    mysqli_close($connection);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="LoginFormStyle.css">
    <title>Game Play</title>
</head>

<body>

    <?php require '../headers/header2.php'; ?>

    <!-- Don't worry about this -->
    <form id="actualLoginForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <input type="text" name="uEmail">
        <input type="text" name="uPIN">
        <input type="submit" name="subBtn">
    </form>

    <div class="form">
        <ul>
            <li class="inputsContainer">
                <div>
                    <label>Email: <label class="warningLabels"></label></label>
                    <input type="text">
                </div>
                <div>
                    <label>PIN: <label class="warningLabels"></label></label>
                    <div class="passwordInputContainer">
                        <input type="password">
                        <button><img src="../images/eye.png"></button>
                    </div>
                    <a id="forgottenPinLink">No clue what my PIN is</a>
                </div>
                
            </li>
            <li class="registerButtonContainer">
                <button class="registerBtn">LOG IN</button>
            </li>
        </ul>
    </div>

    <script src="LoginFormScript.js" type="text/javascript"></script>
</body>

</html>