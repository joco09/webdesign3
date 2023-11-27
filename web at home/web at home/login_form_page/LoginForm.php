<?php 

$name = "Porotha";
$fakeEmail = "fake@gm.com";
$fakePIN = "123";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['uEmail'];
    $PIN = $_POST['uPIN'];
    // $isLoggedIn = false;

    if ($email === $fakeEmail && $PIN === $fakePIN)
    {
        session_start();
        $_SESSION['name'] = $name;
        header('location:../home_page/index.php');
    }
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
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
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