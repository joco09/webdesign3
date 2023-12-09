<?php
session_start();

function validatingTheInputedData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$classTypeError ="";
$dateError ="";
$timeError ="";
$classNameError ="";
$trainerNameDataError ="";
$classType=null;
$date=null;
$time=null;
$className=null;
$trainerName=null;
$classData = array($_POST["classType"],$_POST["day"],$_POST["time"],$_POST["className"],$_POST["trainerName"]);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["classType"])){
        $classTypeError = "Empty Filed!";
    }
    else{
        $classType = validatingTheInputedData($_POST["classType"]);
    }
    if (empty($_POST["date"])){
        $dateError = "Empty Filed!";
    }
    else{
        $date = validatingTheInputedData($_POST["date"]);
    }
    if (empty($_POST["time"])){
        $timeError = "Empty Filed!";
    }
    else{
        $time = validatingTheInputedData($_POST["time"]);
    }
    if (empty($_POST["className"])){
        $classNameError = "Empty Filed!";
    }
    else{
        $className = validatingTheInputedData($_POST["className"]);
    }
    if (empty($_POST["trainerName"])){
        $trainerNameError ="Empty Filed!";
    }
    else{
        $trainerName = validatingTheInputedData($_POST["trainerName"]);
    }

    if (isset($_POST["classType"])&&isset($_POST["date"])&&isset($_POST["time"])&&isset($_POST["trainerName"])){

        require '../database_conncetion/DBConnect.php';

        $sql = "INSERT INTO Class_time_table (Class_id, Staff_id, Gym_id,Time,Date)
                VALUES ('$classType','$trainerName', 1, '$time', '$date');";
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
    <div class="time-table">
        <table class="classes">
            <tr id="day-and-month">
                <th></th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>

                <!--month will be add through DOM js-->
            </tr>
            <tr>
                <th>9:00</th>
                <td id="9:00-Monday"></td>
                <td id="9:00-Tuesday"></td>
                <td id="9:00-Wednesday"></td>
                <td id="9:00-Thursday"></td>
                <td id="9:00-Friday"></td>
                <td id="9:00-Saturday"></td>
                <td id="9:00-Sunday"></td>

            </tr>
            <tr>
                <th>10:00</th>
                <td id="10:00-Monday"></td>
                <td id="10:00-Tuesday"></td>
                <td id="10:00-Wednesday"></td>
                <td id="10:00-Thursday"></td>
                <td id="10:00-Friday"></td>
                <td id="10:00-Saturday"></td>
                <td id="10:00-Sunday"></td>
            </tr>
            <tr>
                <th>11:00</th>
                <td id="11:00-Monday"></td>
                <td id="11:00-Tuesday"></td>
                <td id="11:00-Wednesday"></td>
                <td id="11:00-Thursday"></td>
                <td id="11:00-Friday"></td>
                <td id="11:00-Saturday"></td>
                <td id="11:00-Sunday"></td>
            </tr>
            <tr>
                <th>12:00</th>
                <td id="12:00-Monday"></td>
                <td id="12:00-Tuesday"></td>
                <td id="12:00-Wednesday"></td>
                <td id="12:00-Thursday"></td>
                <td id="12:00-Friday"></td>
                <td id="12:00-Saturday"></td>
                <td id="12:00-Sunday"></td>
            </tr>
            <tr>
                <th>13:00</th>
                <td id="13:00-Monday"></td>
                <td id="13:00-Tuesday"></td>
                <td id="13:00-Wednesday"></td>
                <td id="13:00-Thursday"></td>
                <td id="13:00-Friday"></td>
                <td id="13:00-Saturday"></td>
                <td id="13:00-Sunday"></td>
            </tr>
            <tr>
                <th>14:00</th>
                <td id="14:00-Monday"></td>
                <td id="14:00-Tuesday"></td>
                <td id="14:00-Wednesday"></td>
                <td id="14:00-Thursday"></td>
                <td id="14:00-Friday"></td>
                <td id="14:00-Saturday"></td>
                <td id="14:00-Sunday"></td>
            </tr>
            <tr>
                <th>15:00</th>
                <td id="15:00-Monday"></td>
                <td id="15:00-Tuesday"></td>
                <td id="15:00-Wednesday"></td>
                <td id="15:00-Thursday"></td>
                <td id="15:00-Friday"></td>
                <td id="15:00-Saturday"></td>
                <td id="15:00-Sunday"></td>
            </tr>
            <tr>
                <th>16:00</th>
                <td id="16:00-Monday"></td>
                <td id="16:00-Tuesday"></td>
                <td id="16:00-Wednesday"></td>
                <td id="16:00-Thursday"></td>
                <td id="16:00-Friday"></td>
                <td id="16:00-Saturday"></td>
                <td id="16:00-Sunday"></td>
            </tr>
            <tr>
                <th>17:00</th>
                <td id="17:00-Monday"></td>
                <td id="17:00-Tuesday"></td>
                <td id="17:00-Wednesday"></td>
                <td id="17:00-Thursday"></td>
                <td id="17:00-Friday"></td>
                <td id="17:00-Saturday"></td>
                <td id="17:00-Sunday"></td>
            </tr>
            <tr>
                <th>18:00</th>
                <td id="18:00-Monday"></td>
                <td id="18:00-Tuesday"></td>
                <td id="18:00-Wednesday"></td>
                <td id="18:00-Thursday"></td>
                <td id="18:00-Friday"></td>
                <td id="18:00-Saturday"></td>
                <td id="18:00-Sunday"></td>
            </tr>
            <tr>
                <th>19:00</th>
                <td id="19:00-Monday"></td>
                <td id="19:00-Tuesday"></td>
                <td id="19:00-Wednesday"></td>
                <td id="19:00-Thursday"></td>
                <td id="19:00-Friday"></td>
                <td id="19:00-Saturday"></td>
                <td id="19:00-Sunday"></td>
            </tr>
        </table>
    </div>
    <div class="add-classes">
        <?php

        if (!isset($_SESSION['memberID']))
            echo "<button  id=\"add-classes\"> Add Classes </button>";

        ?>
    </div>
</div>




<div class="adding-classes-from-container" id="adding-classes-form">
    <div class="class-background"  >
        <div class="close-pop-up">
            <button id="closeButton" > X </button>
        </div>
        <div class="adding-classes-from">
            <form class="class-info-form" id="class-info-form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <label for="image" class="form-labes">Choice your class</label><label class="warningLabels"><?php echo $classTypeError;?></label>
                <select name="classType" id="image" class="form-input">

                    <?php

                    if (isset($_POST["classType"])){
                        echo "<option selected> Selected  </option>";
                    }
                    else{
                        echo "<option disabled selected>Choice your class type</option>";
                    }

                    require '../database_conncetion/DBConnect.php';

                    $userQuery = "SELECT Class_name, Class_id FROM Class_Table;";
                    $userResult = mysqli_query($connection, $userQuery);
                    while($userResultArray = mysqli_fetch_array($userResult, MYSQLI_ASSOC)) {
                        echo '<option value='.$userResultArray['Class_id'].'>'.$userResultArray['Class_name'].'</option>';
                    }
                    mysqli_close($connection);

                    ?>

                </select>

                <label for="date" class="form-labes">Please Choice a Day</label><label class="warningLabels"><?php echo $dateError;?></label>
                <input type="date" name="date" id="date" class="form-input" value="<?php echo $_POST["date"] ;?>">

                <label for="time" class="form-labes" id="q">Please Choice a Time</label><label class="warningLabels"><?php echo $timeError;?></label>
                <select name="time" id="time" class="form-input">

                    <?php
                    if (isset($_POST["time"])){
                        echo "<option selected> " . $_POST["time"] . " </option>";
                    }
                    else{
                        echo "<option disabled selected>Choice a Time</option>";
                    }
                    ?>
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

                <label for="trainer-name" class="form-labes">Trainer Name</label><label class="warningLabels"><?php echo $trainerNameError;?></label>
                <select name="trainerName" id="trainer-name" class="form-input">

                    <?php

                    if (isset($_POST["trainerName"]))
                    {
                        echo "<option selected> Selected  </option>";
                    }
                    else
                    {
                        echo "<option disabled selected>Choice the trainer</option>";
                    }

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
                <input type="submit" id="submit" name="test" class="registerBtn"  value="Submit">

            </form>


        </div>
    </div>
</div>

<script src="classes.js"></script>


</body>
</html>