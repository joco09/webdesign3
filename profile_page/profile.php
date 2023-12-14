<?php

session_start();



$membership = "";

if($_SESSION['membership'] == 1){
    $membership = "Bronze";
}else if($_SESSION['membership'] == 2){
    $membership = "Silver";
}else if($_SESSION['membership'] == 3){
    $membership = "Gold";
}else{
    $membership = "Admin";
}



if (isset($_SESSION["Member_id"])) {

    try{
        // Establishes connection to the database.
        require '../database_conncetion/dbh.php';

        // Query
        $query = "select * from Class_booking_table where Member_id = ?;";

        // Prepares query before sending in actual data.
        $stmt = $pdo->prepare(($query));
        // Sends data after query has been sent.
        $stmt->execute([$_SESSION["Member_id"]]);

        // Grabs the selected data from database.
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $booked_classes = array();

        for($i = 0; $i < count($results); $i++){
            array_push($booked_classes,$results[$i]['Class_time_table_id']) ;

//        } foreach ($booked_classes as $value){
//            echo $this;
        }

//        if(!empty($results)){
//            $query = "SELECT  Class_Table.Class_name, Class_Table.Class_duration, Class_time_table.Time, Class_time_table.Date, Class_time_table.Class_time_table_id FROM Class_Table INNER JOIN Class_time_table ON Class_Table.Class_id = Class_time_table.Class_id WHERE Class_time_table.Class_time_table_id = ?;";
//
//            // Prepares query before sending in actual data.
//            $stmt = $pdo->prepare(($query));
//            // Sends data after query has been sent.
//            $stmt->execute(extract($class_bookings));
//
//            // Grabs the selected data from database.
//            $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//            echo $results2;
//        }

    }
    catch (PDOException $e)
    {
        die("Query failed: " . $e);
    }
}
try {
    require '../database_conncetion/dbh.php';
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "DELETE FROM User_member_table WHERE Member_id = ? ;";


        // Prepares query before sending in actual data.
        $stmt = $pdo->prepare($sql);

        // Sends data after query has been sent.
        $stmt->execute([$_SESSION['Member_id']]);
        session_unset();
        session_destroy();
        header('location:../home_page/index.php');
    }
}catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
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
    ?>

    <div class="welcome-message">
        <div class="welcome-container">
            <img class="person-icon" alt="icon" src="../images/person-icon.png">
            <h2>Good to see you working on you gains, </h2>
            <h1> <?php echo $_SESSION['f_n']; ?></h1>
        </div>
    </div>

    <div class="profile">

        <div class="personal-details">
            <h2>Personal details</h2>
            <ul>
                <li><h2>First name:<span class="p-details"> <?php echo $_SESSION['f_n']; ?></span></h2></li>
                <li><h2>Last name:<span class="p-details"> <?php echo $_SESSION['l_n']; ?></span></h2></li>
                <li><h2>Email:<span class="p-details"> <?php echo $_SESSION['email']; ?></span></h2></li>
                <li><h2>Phone number:<span class="p-details"> <?php echo $_SESSION['p_n']; ?></span></h2></li>
                <li><h2>Membership type:<span class="p-details"> <?php echo $membership; ?></span></h2></li>
            </ul>
            <?php if(isset($_SESSION['Member_id'])){
                echo "<a href='../Edit_profile/edit_profile.php'><button type='button'>Edit profile</button></a>";
            }?>
        </div>
        <div class="personal-calendar">
            <h2>Personal calendar</h2>
            <label>You have $classesCount classes booked.</label>
            <a href="join"><button type="button">Edit calendar</button></a>
        </div>

        <div class="upgrade-account">
            <h2>Upgrade account</h2>
            <label>From £4 a moth. Get multi gym acces and free Gym passes!</label>
            <a href="join"><button type="button">Upgrade account</button></a>
        </div>
        <div class="gym-access">
            <h2>Your Gyms</h2>
            <label>View the gyms you have access to and add more!</label>
            <a href="join"><button type="button">Manage gyms</button></a>
        </div>

        <?php if(isset($_SESSION['Member_id'])){
        echo "<div class='delete-account'>
        <h2>Delete account</h2>
        <label>Get your friend in the Gym!</label>
        <form action=". htmlspecialchars($_SERVER['PHP_SELF'])." method='post'>
        <a href='../home_page/index.php'><button type='submit'> Delete my account</button></a>
        </form>
    </div>";
        }?>
    </div>
    <script src="../profile_page/profile.js"></script>
</body>

</html>
