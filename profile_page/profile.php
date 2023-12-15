<?php

session_start();



$membership = "";
// variable for membership type

if($_SESSION['membership'] == 1){
    $membership = "Bronze";
    // turn membership into bronze
}else if($_SESSION['membership'] == 2){
    $membership = "Silver";
    // turn membership into silver
}else if($_SESSION['membership'] == 3){
    $membership = "Gold";
    // turn membership into gold
}else{
    $membership = "Admin";
    // shows admin as the status
}



if (isset($_SESSION["Member_id"])) {
    // check if Member_id is set

    try{

        require '../database_conncetion/dbh.php';
        // Establishes connection to the database.


        $query = "select * from Class_booking_table where Member_id = ?;";
        // Query


        $stmt = $pdo->prepare(($query));
        // Prepares query before sending in actual data.


        $stmt->execute([$_SESSION["Member_id"]]);
        // Sends data after query has been sent.


        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Grabs the selected data from database.

    }
    catch (PDOException $e)
        // catch exeptions
    {
        die("Query failed: " . $e);
        // message if connection failed
    }
}
try {
    require '../database_conncetion/dbh.php';
    // establish connection to database

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // check if request method is post

        $sql = "DELETE FROM User_member_table WHERE Member_id = ? ;";
        // sql command to delete user from the data base

        $stmt = $pdo->prepare($sql);
        // Prepares query before sending in actual data.


        $stmt->execute([$_SESSION['Member_id']]);
        // Sends data after query has been sent.

        session_unset();
        session_destroy();
        // undest and destroy session

        header('location:../home_page/index.php');
        // redirect user to the home page
    }
}catch (PDOException $e){
    // exception

    die("Query failed: " . $e->getMessage());
    // message when the query fails
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="profile.css">
    <title>Game Play</title>
</head>

<body>

<?php
require '../headers/header2.php';
// php header
?>

<div class="welcome-message">
    <div class="welcome-container">
        <img class="person-icon" alt="icon" src="../images/person-icon.png">
        <h2>Good to see you working on you gains, </h2>
        <h1> <?php echo $_SESSION['f_n']; ?></h1>
        <!--            display first name-->

    </div>
</div>

<div class="profile">

    <div class="personal-details">
        <h2>Personal details</h2>
        <ul>
            <li><h4>First name:<span class="p-details"> <?php echo $_SESSION['f_n']; ?></span></h4></li>
            <li><h4>Last name:<span class="p-details"> <?php echo $_SESSION['l_n']; ?></span></h4></li>
            <li><h4>Email:<span class="p-details"> <?php echo $_SESSION['email']; ?></span></h4></li>
            <li><h4>Phone number:<span class="p-details"> <?php echo $_SESSION['p_n']; ?></span></h4></li>
            <li><h4>Membership type:<span class="p-details"> <?php echo $membership; ?></span></h4></li>
            <!--                 display personal details-->

        </ul>
        <?php if(isset($_SESSION['Member_id'])){
            echo "<a href='../Edit_profile/edit_profile.php'><button type='button'>Edit profile</button></a>";
            // this shows the edit button for members only and not for admin
        }?>
    </div>
    <div class="personal-calendar">
        <h2>Personal calendar</h2>
        <label>You have $classesCount classes booked.</label>
        <label>(This feature is currently not working, we're trying our very best to improve our website)</label>
        <a href="join"><button type="button">Edit calendar</button></a>
    </div>

    <div class="upgrade-account">
        <h2>Upgrade account</h2>
        <label>From £4 a month. Get multi-gym access and free Gym passes!</label>
        <label>(This feature is currently not working, we're trying our very best to improve our website)</label>
        <a href="join"><button type="button">Upgrade account</button></a>
    </div>
    <div class="gym-access">
        <h2>Your Gyms</h2>
        <label>View the gyms you have access to and add more!</label>
        <label>(This feature is currently not working)</label>
        <a href="join"><button type="button">Manage gyms</button></a>
    </div>

    <?php
    if(isset($_SESSION['Member_id']))
    {
//            this code will only show the delete account function to members and not the admin
        echo "<div class='delete-account'>

        <h2>Delete account</h2>
        
        <label>Thinking of quitting the gym?</label>
        <span></span>
        <form action=". htmlspecialchars($_SERVER['PHP_SELF'])." method='post'>
        <a href='../home_page/index.php'><button type='submit'> Delete my account</button></a>
        </form>
    </div>";
    }

    ?>
</div>


</body>

</html>