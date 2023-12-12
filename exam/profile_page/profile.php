<?php

session_start();

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
            <img class="person-icon" alt="icon" src="../images/person-icon.jpg">
            <h2>Good to see you working on you gains, </h2>
            <h1> <?php echo $_SESSION['f_n']; ?></h1>
        </div>
    </div>

    <div class="profile">

        <div class="personal-details">
            <h2>Personal details</h2>
            <label>View and edit your personal details.</label>
            <a href="join"><button type="button">Edit profile</button></a>
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
        <!-- <div class="gym-passes">
            <h2>Get Gym passes</h2>
            <ul>
                <li><p>Get your friend in the Gym!</p></li>
            </ul>
            <a href="join"><button type="button">Get Gym pass</button></a>
        </div> -->

    </div>

    <div class="pop-up" id="pop-up">
        <div class="pop-up-header">
            <div class="title"> pop up</div>
            <button class="close-button">&times;</button>
        </div>
        <div class="pop-up-body">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
             Dolorem quisquam sequi qui dolorum unde minus quis perferendis,
              dicta praesentium labore nemo optio eius quibusdam laborum rem beatae dolor in,
               laboriosam exercitationem, rerum architecto! Provident minima saepe commodi
                ea officiis voluptate odit pariatur quasi, atque beatae earum at et in, fuga expedita necessitatibus vel? Temporibus rem eveniet maiores. Ducimus neque molestiae eos praesentium commodi, quos debitis sed optio nam iure velit doloribus voluptate incidunt consectetur soluta odit porro quae suscipit ratione?
        </div>
    </div> 
    <div id="overlay"></div>

    <script src="../profile page/profile.js"></script>
</body>

</html>