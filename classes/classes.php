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

$bookings = [];

try
{
    require '../database_conncetion/dbh.php';

    $sql = "SELECT * FROM Class_booking_table WHERE Member_id = ?;";

    // Prepares query before sending in actual data.
    $stmt = $pdo->prepare($sql);
    // Sends data after query has been sent.
    $stmt->execute([$_SESSION['Member_id']]);

    // Grabs the selected data from database.
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($results);
}
catch (PDOException $e)
{
    die('Query failed: ' . $e->getMessage());
}

function echoClasses($array, $bookings)
{
    $booking_label = "Book Class";

    for ($int = 0; $int < count($bookings); $int++)
    {
        //echo $int . " ";
        //echo $bookings[$int]['Class_time_table_id'] . " ";
        //echo $array[$int]['Class_time_table_id'] . " ";
        if ($bookings[$int]['Class_time_table_id'] === $array['Class_time_table_id'])
        {
            $booking_label = "Booked";
            break;
        }
        else
            $booking_label = "Book Class";
    }

    $image_url = "";
    $image_alt = "";

    switch ($array['Class_name'])
    {
        case 'Cross Fit':
            $image_url = "spin madess.jpg";
            $image_alt = "Man cycling for his life";
            break;
        case 'HIT 24':
            $image_url = "rope fling.jpg";
            $image_alt = "Man with ropes in his hands";
            break;
        case 'Core Madness':
            $image_url = "core madeness.jpg";
            $image_alt = "Woman doing plank";
            break;
        case 'Cardio Carnivor':
            $image_url = "cardio carnivor.jpg";
            $image_alt = "Man performing lunge";
            break;
        case 'Squats Madness':
            $image_url = "weight lifting.jpg";
            $image_alt = "Woman lifting weight on bar";
            break;
    }

    $html_code = "";

    if (isset($_SESSION['Member_id']))
        $html_code = '<form class="class" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post">
                <button type="submit" name="bookingClass" value="' . htmlspecialchars($array['Class_time_table_id']) . '">' . $booking_label . '</button>
                </form>';
    else if (isset($_SESSION['Staff_id']))
        $html_code = '<form class="class" action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="post">
                <button type="submit" name="deleteClass" value="' . htmlspecialchars($array['Class_time_table_id']) . '">Delete Class</button>
                </form>';
    else
        $html_code = "<a href='../register_form_page/Register_Form.php'><button name='bookingClass' value=" . $array['Class_time_table_id'] . ">Join</button></a>";

    return "<div class='class'>         
                <img src='../images/" . $image_url . "' alt='" . $image_alt ."'>
                <div class='textbox'> <h2>" . htmlspecialchars($array['Class_name']) . "</h2></div>
                <div class='textbox'> Class Duration : " . htmlspecialchars($array['Class_duration']) . "</div>
                <div class='textbox'> Class Date : " . formatingDate(htmlspecialchars($array['Date'])) . "</div>                
                <div class='textbox'> Class Time : " . formatingTime(htmlspecialchars($array['Time'])) . "</div>"
                . $html_code .
          "</div>";
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
                array_push($today, echoClasses($results[$int], $bookings));
                break;
            case gettingTheWeekDate(1);
                array_push($oneDayFromNow, echoClasses($results[$int], $bookings));
                break;
            case gettingTheWeekDate(2):
                array_push($twoDayFromNow, echoClasses($results[$int], $bookings));
                break;
            case gettingTheWeekDate(3):
                array_push($threeDayFromNow, echoClasses($results[$int], $bookings));
                break;
            case gettingTheWeekDate(4):
                array_push($fourDayFromNow, echoClasses($results[$int], $bookings));
                break;
            case gettingTheWeekDate(5):
                array_push($fiveDayFromNow, echoClasses($results[$int], $bookings));
                break;
            case gettingTheWeekDate(6):
                array_push($sixDayFromNow, echoClasses($results[$int], $bookings));
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
        }
        catch (PDOException $e)
        {
            die("Query failed: " . $e);
        }
    }
    else if (isset($_POST['deleteClass']))
    {
        $class_id = $_POST['deleteClass'];

        try
        {
            require '../database_conncetion/dbh.php';

            $sql = "DELETE FROM Class_time_table WHERE Class_time_table_id = ?";

            // Prepares query before sending in actual data.
            $stmt = $pdo->prepare($sql);

            // Sends data after query has been sent.
            $stmt->execute([$class_id]);

            // Grabs the selected data from database.
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            die("Query failed: " . $e);
        }
    }
    else if (isset($_POST['add_btn']))
    {
        $classType = $_POST["classType"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $className = $_POST["className"];
        $trainerName = $_POST["trainerName"];

        if (isset($_POST["classType"]) && isset($_POST["date"]) && isset($_POST["time"]) && isset($_POST["trainerName"]))
        {
            try
            {
                require '../database_conncetion/dbh.php';

                $sql = "INSERT INTO Class_time_table (Class_id, Staff_id, Gym_id, Time, Date)
        VALUES (?,?,1,?,?);";

                $stmt = $pdo->prepare($sql);

                $stmt->execute([$classType, $trainerName, $time, $date]);
            }
            catch (PDOException $e)
            {
                die('Query failed: ' . $e->getMessage());
            }
        }
    }

    header('location: ../classes/classes.php');
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

            <div class="week">
                <h1><?php echo getingTheWeekDay(0)?></h1>
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
        <button id="closeButton" >EXIT</button>
        <div class="adding-classes-from">
            <form class="class-info-form" id="class-info-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <label for="image" class="form-labes">Choose your class: <label class="warningLabels"></label></label>
                <select name="classType" id="image" class="form-input">

                    <?php

                    echo "<option disabled selected value=''>Choose your class type:</option>";

                    try
                    {
                        require '../database_conncetion/dbh.php';

                        $userQuery = "SELECT Class_name, Class_id FROM Class_Table;";

                        $stmt = $pdo->prepare($userQuery);

                        $stmt->execute();

                        // Grabs the selected data from database.
                        $class_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        for ($int = 0; $int < count($class_types); $int++)
                            echo '<option value='. htmlspecialchars($class_types[$int]['Class_id']).'>'. htmlspecialchars($class_types[$int]['Class_name']) .'</option>';

                    }
                    catch (PDOException $e)
                    {
                        die('Query failed :' . $e->getMessage());
                    }

                    ?>

                </select>

                <label for="date" class="form-labes">Please Choose a Day: <label class="warningLabels"></label></label>
                <select type="date" name="date" id="date" class="form-input" value="">
                    <option disabled selected value=''>Choose a day</option>
                    <option value=<?php echo gettingTheWeekDate(1)?>><?php echo getingTheWeekDay(1) .  formatingDate(gettingTheWeekDate(1))?></option>
                    <option value=<?php echo gettingTheWeekDate(2)?>><?php echo getingTheWeekDay(2) .  formatingDate(gettingTheWeekDate(2))?></option>
                    <option value=<?php echo gettingTheWeekDate(3)?>><?php echo getingTheWeekDay(3) .  formatingDate(gettingTheWeekDate(3))?></option>
                    <option value=<?php echo gettingTheWeekDate(4)?>><?php echo getingTheWeekDay(4) .  formatingDate(gettingTheWeekDate(4))?></option>
                    <option value=<?php echo gettingTheWeekDate(5)?>><?php echo getingTheWeekDay(5) .  formatingDate(gettingTheWeekDate(5))?></option>
                    <option value=<?php echo gettingTheWeekDate(6)?>><?php echo getingTheWeekDay(6) .  formatingDate(gettingTheWeekDate(6))?></option>
                </select>

                <label for="time" class="form-labes" id="q">Please Choose a Time: <label class="warningLabels"></label></label>
                <select name="time" id="time" class="form-input">
                    <option disabled selected value=''>Choose a Time</option>
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

                <label for="trainer-name" class="form-labes">Trainer Name: <label class="warningLabels"></label></label>
                <select name="trainerName" id="trainer-name" class="form-input">

                    <?php
                    echo "<option disabled selected value=''>Choose a trainer</option>";

                    try
                    {
                        require '../database_conncetion/dbh.php';

                        $userQuery = "SELECT Staff_id, First_name, Last_name FROM User_staff_table;";

                        $stmt = $pdo->prepare($userQuery);

                        $stmt->execute();

                        // Grabs the selected data from database.
                        $trainers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        for ($int = 0; $int < count($trainers); $int++)
                            echo '<option value=' . htmlspecialchars($trainers[$int]['Staff_id']) .'>' . htmlspecialchars($trainers[$int]['First_name']) . ' ' . htmlspecialchars($trainers[$int]['Last_name']) . '</option>';
                    }
                    catch (PDOException $e)
                    {
                        die('Query failed :' . $e->getMessage());
                    }

                    ?>

                </select>
                <input type="submit" id="submit" name="add_btn" class="registerBtn"  value="Submit">

            </form>


        </div>
    </div>
</div>

<script src="classes.js"></script>


</body>
</html>