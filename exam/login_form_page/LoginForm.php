<?php

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $error_message = "";
    $userEmail =  preg_replace('/\s+/', '', $_POST['uEmail']);
    $userPassword = preg_replace('/\s+/', '', $_POST['uPIN']);

    try
    {
      // Establishes connection to the database.
      require_once '../database_conncetion/dbh.php';

      // Query
      $query = "select * from user_member_table where E_mail = ?;";

      // Prepares query before sending in actual data.
      $stmt = $pdo->prepare(($query));
      // Sends data after query has been sent.
      $stmt->execute([$userEmail]);

      // Grabs the selected data from database.
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!empty($results))
      {
        if (password_verify($userPassword, $results[0]['Password']))
        {
            require_once '../database_conncetion/config_session.php';

            $_SESSION['Member_id'] = $results[0]['Member_id'];
            $_SESSION['f_n'] = $results[0]['First_name'];
            $_SESSION['l_n'] = $results[0]['Last_name'];
            $_SESSION['p_n'] = $results[0]['Phone_number'];
            $_SESSION['email'] = $results[0]['E_mail'];
            $_SESSION['membership'] = $results[0]['Membership_type_id'];

            header('location:../home_page/index.php');
        }
        else
          $error_message = "Password doesn't match our records!";
      }
      else
      {
        // Query
       $query = "select * from user_staff_table where E_mail = ?;";
       
       // Prepares query before sending in actual data.
       $stmt = $pdo->prepare(($query));
       // Sends data after query has been sent.
       $stmt->execute([$userEmail]);
       
       // Grabs the selected data from database.
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
       if (!empty($results))
       {
         if (password_verify($userPass, $results[0]['Password']))
         {
             require_once '../database_conncetion/config_session.php';

             $_SESSION['Staff_id'] = $results[0]['Staff_id'];
             $_SESSION['f_n'] = $results[0]['First_name'];
             $_SESSION['l_n'] = $results[0]['Last_name'];
             $_SESSION['p_n'] = $results[0]['Phone_number'];
             $_SESSION['email'] = $results[0]['E_mail'];
             $_SESSION['clearance'] = $results[0]['Clearance_level'];

             header('location:../home_page/index.php');
         }
         else
           $error_message = "Password doesn't match our records!";
       }
       else
        $error_message = "This email is not registered!";
      }

      // Frees up space manually and closes database (best practice code).
      $pdo = null;
      $stmt = null;
    }
    catch (PDOException $e)
    {
      die("Query failed: " . $e->getMessage());
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