<?php

function trimInputs($input)
{
    return preg_replace('/\s+/', '', $input);
}


if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $options = ['cost' => 12];
    $userName = trimInputs($_POST['firstName']);
    $userLastName = trimInputs($_POST['lastName']);
    $userEmail = trimInputs($_POST['emailAddress']);
    $userPass = password_hash(trimInputs($_POST['pass']), PASSWORD_BCRYPT, $options);
    $userPN = trimInputs($_POST['phoneNumber']);
    $userMemType = $_POST['membershipType'];
    $Member_id;

    try
    {
        // Establishes connection to the database.
        require_once '../database_conncetion/dbh.php';
        // Query
        $query = "insert into User_member_table (First_name, Last_name, Phone_number, E_mail, Password, Membership_type_id)
      values (?, ?, ?, ?, ?, ?); SELECT SCOPE_IDENTITY()";
        // Prepares query before sending in actual data.
        $stmt = $pdo->prepare(($query));
        // Sends data after query has been sent.
        $stmt->execute([$userName, $userLastName, $userPN, $userEmail, $userPass, $userMemType]);

        // Grabs the selected data from database.
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $Member_id = $results[0]['Member_id'];

        // Frees up space manually and closes database (best practice code).
        $pdo = null;
        $stmt = null;

        session_start();
        $_SESSION['Member_id'] = $Member_id;
        $_SESSION['f_n'] = $userName;
        $_SESSION['l_n'] = $userLastName;
        $_SESSION['p_n'] = $userPN;
        $_SESSION['email'] = $userEmail;
        $_SESSION['membership'] = $userMemType;


        setcookie("First name", $_SESSION['f_n'] , time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("Last name", $_SESSION['l_n'] , time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("Phone number", $_SESSION['p_n'] , time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("Email", $_SESSION['email'] , time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("Membership", $_SESSION['membership'] , time() + (86400 * 30), "/"); // 86400 = 1 day
    }
    catch (PDOException $e)
    {
        echo "";
        die("Query failed: " . $e->getMessage());
    }

    require_once '../database_conncetion/config_session.php';



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
                    <button id="Bronze" value="1">
                        <img src="../images/bronze-cup.png" width="70">
                    </button>
                    <label>£9.99</label>
                </div>
                <div>
                    <label>Silver</label>
                    <button id="Silver" value="2">
                        <img src="../images/silver-cup.png" width="70">
                    </button>
                    <label>£19.99</label>
                </div>
                <div>
                    <label>Gold</label>
                    <button id="Gold" value="3">
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
