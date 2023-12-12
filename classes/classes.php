<?php
session_start();
$userId= 1;
function getingTheWeekDay($numberOfDays)
{
    $date = date_create(date("l"));
    date_modify($date, "+" . $numberOfDays . "days");
    return date_format($date, "l ");
}
function gettingTheWeekDate($numberOfDays)
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

function echoClasses($array)
{
    $html_code = "";

    if (isset($_SESSION['Member_id']))
        $html_code = '<form class="class" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post">
                <button type="submit" name="bookingClass" value="' . $array['Class_time_table_id'] . '">Book Class</button>
                </form>';
    else if (isset($_SESSION['Staff_id']))
        $html_code = '<form class="class" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post">
                <button type="submit" name="deleteClass" value="' . $array['Class_time_table_id'] . '">Delete Class</button>
                </form>';
    else
        $html_code = "<a href='../register_form_page/Register_Form.php'><button name='bookingClass' value=" . $array['Class_time_table_id'] . ">Join</button></a>";

    return "<div class='class'>         
                <img src='../images/running.jpg' alt='handstand'>
                <div class='textbox'> <h2>" . $array['Class_name'] . "</h2></div>
                <div class='textbox'> Class Duration : " . $array['Class_duration'] . "</div>
                <div class='textbox'> Class Date : " . formatingDate($array['Date']) . "</div>                
                <div class='textbox'> Class Time : " . formatingTime($array['Time']) . "</div>       
                $html_code
          </div>";
}

$today = array();
$oneDayFromNow = array();
$twoDayFromNow = array();
$threeDayFromNow = array();
$fourDayFromNow = array();
$fiveDayFromNow = array();
$sixDayFromNow = array();

try
{
    require '../database_conncetion/dbh.php';

    $sql = "SELECT  Class_Table.Class_name, Class_Table.Class_duration, Class_time_table.Time, Class_time_table.Date, Class_time_table.Class_time_table_id FROM Class_Table INNER JOIN Class_time_table ON Class_Table.Class_id = Class_time_table.Class_id ;";

    // Prepares query before sending in actual data.
    $stmt = $pdo->prepare($sql);
    // Sends data after query has been sent.
    $stmt->execute();

    // Grabs the selected data from database.
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    for ($int = 0; $int < count($results); $int++)
    {
        switch ($results[$int]['Date'])
        {
            case gettingTheWeekDate(0):
                array_push($today, echoClasses($results[$int]));
                break;
            case gettingTheWeekDate(1);
                array_push($oneDayFromNow, echoClasses($results[$int]));
                break;
            case gettingTheWeekDate(2):
                array_push($twoDayFromNow, echoClasses($results[$int]));
                break;
            case gettingTheWeekDate(3):
                array_push($threeDayFromNow, echoClasses($results[$int]));
                break;
            case gettingTheWeekDate(4):
                array_push($fourDayFromNow, echoClasses($results[$int]));
                break;
            case gettingTheWeekDate(5):
                array_push($fiveDayFromNow, echoClasses($results[$int]));
                break;
            case gettingTheWeekDate(6):
                array_push($sixDayFromNow, echoClasses($results[$int]));
                break;
        }
    }

    // Frees up space manually and closes database (best practice code).
    $pdo = null;
    $stmt = null;

}
catch (PDOException $e)
{
    die("Query failed: " . $e->getMessage());
}

$classType=null;
$date=null;
$time=null;
$className=null;
$trainerName=null;

//if ($_SERVER["REQUEST_METHOD"] == "POST")
//{
//    $classType = validatingTheInputedData($_POST["classType"]);
//    $date = validatingTheInputedData($_POST["date"]);
//    $time = validatingTheInputedData($_POST["time"]);
//    $className = validatingTheInputedData($_POST["className"]);
//    $trainerName = validatingTheInputedData($_POST["trainerName"]);
//
//    if (isset($_POST["classType"]) && isset($_POST["date"]) && isset($_POST["time"]) && isset($_POST["trainerName"]))
//    {
//        require '../database_conncetion/DBConnect.php';
//        $sql = "INSERT INTO Class_time_table (Class_id, Staff_id, Gym_id,Time,Date)
//        VALUES ('{$_POST['classType']}',''{$_POST['trainerName']}'',1,'{$_POST['time']}',''{$_POST['date']}'');";
//        mysqli_query($connection, $sql);
//        mysqli_close($connection);
//    }
//}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST["bookingClass"]))
    {
        $class_id = $_POST['bookingClass'];
        $member_id = $_SESSION['Member_id'];

        //var_dump($class_id);

        try
        {
            require '../database_conncetion/dbh.php';

            $sql = "SELECT * FROM Class_booking_table WHERE Class_time_table_id = ? AND Member_id = ?;";

            // Prepares query before sending in actual data.
            $stmt = $pdo->prepare($sql);

            // Sends data after query has been sent.
            $stmt->execute([$class_id, $member_id]);

            // Grabs the selected data from database.
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($results))
            {
                $sql = "DELETE FROM Class_booking_table WHERE Class_time_table_id = ? AND Member_id = ?;";

                // Prepares query before sending in actual data.
                $stmt = $pdo->prepare($sql);

                // Sends data after query has been sent.
                $stmt->execute([$class_id, $member_id]);
            }
            else
            {
                $sql = "INSERT INTO Class_booking_table (Class_time_table_id, Member_id)
        VALUES (?, ?);";

                // Prepares query before sending in actual data.
                $stmt = $pdo->prepare($sql);

                // Sends data after query has been sent.
                $stmt->execute([$class_id, $member_id]);
            }

            // Frees up space manually and closes database (best practice code).
            $pdo = null;
            $stmt = null;
        }
        catch (PDOException $e)
        {
            die("Query failed: " . $e);
        }
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
                <h2><?php echo formatingDate(gettingTheWeekDate(0));?></h2>
                <?php
                foreach ($today as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>

        <div id="Tuesday">

            <div class="week"> <h1><?php echo getingTheWeekDay(1)?></h1>
                <h2><?php echo formatingDate(gettingTheWeekDate(1));?></h2>
                <?php
                foreach ($oneDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>
        <div id="Wednesday">

            <div class="week"> <h1><?php echo getingTheWeekDay(2)?></h1>
                <h2><?php echo formatingDate(gettingTheWeekDate(2));?></h2>
                <?php
                foreach ($twoDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>

        <div id="Thursday">
            <div class="week"> <h1><?php echo getingTheWeekDay(3)?></h1>
                <h2><?php echo formatingDate(gettingTheWeekDate(3));?></h2>
                <?php
                foreach ($threeDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>

        </div>

        <div id="Friday">
            <div class="week"> <h1><?php echo getingTheWeekDay(4)?></h1>
                <h2><?php echo formatingDate(gettingTheWeekDate(4));?></h2>
                <?php
                foreach ($fourDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>
        </div>

        <div id="Saturday">
            <div class="week"> <h1><?php echo getingTheWeekDay(5)?></h1>
                <h2><?php echo formatingDate(gettingTheWeekDate(5));?></h2>
                <?php
                foreach ($fiveDayFromNow as $classes){
                    echo $classes;
                }
                ?>
            </div>
        </div>

        <div id="Sunday">
            <div class="week"> <h1><?php echo getingTheWeekDay(6)?></h1>
                <h2><?php echo formatingDate(gettingTheWeekDate(6));?></h2>
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
    if (isset($_SESSION['Staff_id']))
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
                    <option value=<?php echo gettingTheWeekDate(1)?>><?php echo getingTheWeekDay(1) .  formatingDate(gettingTheWeekDate(1))?></option>
                    <option value=<?php echo gettingTheWeekDate(2)?>><?php echo getingTheWeekDay(2) .  formatingDate(gettingTheWeekDate(2))?></option>
                    <option value=<?php echo gettingTheWeekDate(3)?>><?php echo getingTheWeekDay(3) .  formatingDate(gettingTheWeekDate(3))?></option>
                    <option value=<?php echo gettingTheWeekDate(4)?>><?php echo getingTheWeekDay(4) .  formatingDate(gettingTheWeekDate(4))?></option>
                    <option value=<?php echo gettingTheWeekDate(5)?>><?php echo getingTheWeekDay(5) .  formatingDate(gettingTheWeekDate(5))?></option>
                    <option value=<?php echo gettingTheWeekDate(6)?>><?php echo getingTheWeekDay(6) .  formatingDate(gettingTheWeekDate(6))?></option>
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