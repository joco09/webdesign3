<?php
session_start();
$userId= 1;
function getingTheWeekDay($numberOfDays)
{
    $date = date_create(date("l"));
    date_modify($date, "+" . $numberOfDays . "days");
    return date_format($date, "l ");
}
function getingTheWeekDate($numberOfDays)
{
    $date = date_create(date("l"));
    date_modify($date, "+" . $numberOfDays . "days");
    return date_format($date, "Y-m-d");
}
function validatingTheInputedData($data)
{
    $data = trim($data);
    return $data;
}
function formatingDate($unformatedDate){
    $date = date_create($unformatedDate);
    return date_format($date,"d/m/y");
}
function formatingTime($unformatedTime){
    $time = date_create($unformatedTime);
    return date_format($time,"H:i");
}
function echoClasses($array){
    return "<div class='class'>         
                <img src='../images/running.jpg' alt='handstand'>
                <div class='textbox'> <h2>" . $array['Class_name'] . "</h2></div>
                <div class='textbox'> Class Duration : " . $array['Class_duration'] . "</div>
                <div class='textbox'> Class Date : " . formatingDate($array['Date']) . "</div>                
                <div class='textbox'> Class Time : " . formatingTime($array['Time']) . "</div>       
                <form class='class' action=" . htmlspecialchars($_SERVER['PHP_SELF']) . " method='post'><button type='submit' name='bookingClass' value=".$array['Class_time_table_id'].">Sign up</button></form>
          </div>";
}

$today = array();
$oneDayFromNow = array();
$twoDayFromNow = array();
$threeDayFromNow = array();
$fourDayFromNow = array();
$fiveDayFromNow = array();
$sixDayFromNow = array();
require_once '../database_conncetion/DBConnect.php';
$sql = "SELECT  Class_Table.Class_name, Class_Table.Class_duration, Class_time_table.Time, Class_time_table.Date, Class_time_table.Class_time_table_id FROM Class_Table INNER JOIN Class_time_table ON Class_Table.Class_id = Class_time_table.Class_id ;";
$result = mysqli_query($connection, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    switch ($row['Date']) {
        case getingTheWeekDate(0):
            array_push($today, echoClasses($row));
            break;
        case getingTheWeekDate(1);
            array_push($oneDayFromNow, echoClasses($row));
            break;
        case getingTheWeekDate(2):
            array_push($twoDayFromNow, echoClasses($row));
            break;
        case getingTheWeekDate(3):
            array_push($threeDayFromNow, echoClasses($row));
            break;
        case getingTheWeekDate(4):
            array_push($fourDayFromNow, echoClasses($row));
            break;
        case getingTheWeekDate(5):
            array_push($fiveDayFromNow, echoClasses($row));
            break;
        case getingTheWeekDate(6):
            array_push($sixDayFromNow, echoClasses($row));
            break;
    }
}
mysqli_close($connection);

$classType=null;
$date=null;
$time=null;
$className=null;
$trainerName=null;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $classType = validatingTheInputedData($_POST["classType"]);
    $date = validatingTheInputedData($_POST["date"]);
    $time = validatingTheInputedData($_POST["time"]);
    $className = validatingTheInputedData($_POST["className"]);
    $trainerName = validatingTheInputedData($_POST["trainerName"]);
    if (isset($_POST["classType"])&&isset($_POST["date"])&&isset($_POST["time"])&&isset($_POST["trainerName"])){
        require '../database_conncetion/DBConnect.php';
        $sql = "INSERT INTO Class_time_table (Class_id, Staff_id, Gym_id,Time,Date)
        VALUES ('{$_POST['classType']}',''{$_POST['trainerName']}'',1,'{$_POST['time']}',''{$_POST['date']}'');";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["bookingClass"])){
        require '../database_conncetion/DBConnect.php';
        $sql = "INSERT INTO Class_booking_table (Class_time_table_id, Member_id)
        VALUES ('{$_POST['bookingClass']}','{$_SESSION['memberID']}');";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game play</title>
    <link rel="stylesheet" href="classes.css">
</head>
<body>
<?php require '../headers/header2.php'; ?>
<div id="main-body">

    <div class="classes">

        <div id="Monday">

            <div class="week"> <h1><?php echo getingTheWeekDay(0)?></h1>
                <h2><?php echo formatingDate(getingTheWeekDate(0));?></h2>
                <?php
                foreach ($today as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>

        <div id="Tuesday">

            <div class="week"> <h1><?php echo getingTheWeekDay(1)?></h1>
                <h2><?php echo formatingDate(getingTheWeekDate(1));?></h2>
                <?php
                foreach ($oneDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>
        <div id="Wednesday">

            <div class="week"> <h1><?php echo getingTheWeekDay(2)?></h1>
                <h2><?php echo formatingDate(getingTheWeekDate(2));?></h2>
                <?php
                foreach ($twoDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>

        <div id="Thursday">
            <div class="week"> <h1><?php echo getingTheWeekDay(3)?></h1>
                <h2><?php echo formatingDate(getingTheWeekDate(3));?></h2>
                <?php
                foreach ($threeDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>

        <div id="Friday">
            <div class="week"> <h1><?php echo getingTheWeekDay(4)?></h1>
                <h2><?php echo formatingDate(getingTheWeekDate(4));?></h2>
                <?php
                foreach ($fourDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>
        </div>

        <div id="Saturday">
            <div class="week"> <h1><?php echo getingTheWeekDay(5)?></h1>
                <h2><?php echo formatingDate(getingTheWeekDate(5));?></h2>
                <?php
                foreach ($fiveDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>
        </div>

        <div id="Sunday">
            <div class="week"> <h1><?php echo getingTheWeekDay(6)?></h1>
                <h2><?php echo formatingDate(getingTheWeekDate(6));?></h2>
                <?php
                foreach ($sixDayFromNow as $classes){
                    echo $classes;
                }
                ?>

            </div>
        </div>
    </div>
</div>






<div class="add-classes">
    <?php
    if (!isset($_SESSION['memberID']))
        echo "<button  id=\"add-classes\"> Add Classes </button>";
    ?>
    </div>
</div>




<div class="adding-classes-from-container" id="adding-classes-form">
    <div class="class-background">
        <div class="close-pop-up">
            <button id="closeButton" > X </button>
        </div>
        <div class="adding-classes-from">
            <form class="class-info-form" id="class-info-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <label for="image" class="form-labes">Choice your class</label><label class="warningLabels"></label>
                <select name="classType" id="image" class="form-input">

                    <?php

                    echo "<option disabled selected value=''>Choice your class type</option>";

                    require '../database_conncetion/DBConnect.php';

                    $userQuery = "SELECT Class_name, Class_id FROM Class_Table;";
                    $userResult = mysqli_query($connection, $userQuery);
                    while($userResultArray = mysqli_fetch_array($userResult, MYSQLI_ASSOC)) {
                        echo '<option value='.$userResultArray['Class_id'].'>'.$userResultArray['Class_name'].'</option>';
                    }
                    mysqli_close($connection);

                    ?>

                </select>

                <label for="date" class="form-labes">Please Choice a Day</label><label class="warningLabels"></label>
                <select type="date" name="date" id="date" class="form-input" value="">
                    <option disabled selected value=''>Choice a day</option>
                    <option value=<?php echo getingTheWeekDate(1)?>><?php echo getingTheWeekDay(1) .  formatingDate(getingTheWeekDate(1))?></option>
                    <option value=<?php echo getingTheWeekDate(2)?>><?php echo getingTheWeekDay(2) .  formatingDate(getingTheWeekDate(2))?></option>
                    <option value=<?php echo getingTheWeekDate(3)?>><?php echo getingTheWeekDay(3) .  formatingDate(getingTheWeekDate(3))?></option>
                    <option value=<?php echo getingTheWeekDate(4)?>><?php echo getingTheWeekDay(4) .  formatingDate(getingTheWeekDate(4))?></option>
                    <option value=<?php echo getingTheWeekDate(5)?>><?php echo getingTheWeekDay(5) .  formatingDate(getingTheWeekDate(5))?></option>
                    <option value=<?php echo getingTheWeekDate(6)?>><?php echo getingTheWeekDay(6) .  formatingDate(getingTheWeekDate(6))?></option>
                </select>

                <label for="time" class="form-labes" id="q">Please Choice a Time</label><label class="warningLabels"></label>
                <select name="time" id="time" class="form-input">
                    <option disabled selected value=''>Choice a Time</option>
                    <option value="9:00" >9:00 </option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                </select>

                <label for="trainer-name" class="form-labes">Trainer Name</label><label class="warningLabels"></label>
                <select name="trainerName" id="trainer-name" class="form-input">

                    <?php
                    echo "<option disabled selected value=''>Choice the trainer</option>";

                    require '../database_conncetion/DBConnect.php';
                    $userQuery = "SELECT Staff_id, First_name, Last_name FROM User_staff_table;";
                    $userResult = mysqli_query($connection, $userQuery);

                    while($userResultArray = mysqli_fetch_array($userResult, MYSQLI_ASSOC))
                    {
                        echo '<option value=' . $userResultArray['Staff_id'] .'>' . $userResultArray['First_name'] . ' ' . $userResultArray['Last_name'] . '</option>';
                    }
                    mysqli_close($connection);
                    ?>

                </select>
                <input type="submit" id="submit" class="registerBtn"  value="Submit">

            </form>


        </div>
    </div>
</div>

<script src="classes.js"></script>


</body>
</html>
