<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game play</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="hero-image">

        <div class = "top-nav">

            <img class="logo" alt="logo" src="../images/logo.png">

            <ul>
                <li><a href="../home_page/index.php">Home</a></li>
                <li><a href="../classes/classes.php">Courses and lessons</a></li>
                <?php

                if (!isset($_SESSION['f_n']))
                {
                    echo '<li><a href="../register_form_page/Register_Form.php">Join</a></li>
                  <li><a href="../login_form_page/LoginForm.php">Log in</a></li>' ;
                }
                else
                {
                    echo '<li><a href="../profile_page/profile.php"><img src="../images/person-icon.jpg" width="50"></a></li>';
                }

                ?>
            </ul>

        </div>

        <div class="hero-text">
            <h1>
            <?php 

            if (isset($_SESSION['f_n']))
            {
              echo $_SESSION['f_n'] . ',' ;
            }

            ?>
            </h1>
            <h1>Welcome to game play where we play hard and work hard.</h1>
            <p>Are you ready to join?</p>
        </div>
        <br>
    </div>

    <div class="work-out-classes">

      <div class="class">
        <label>CHRISTINE</label>
        <img src="../images/handstand.jpg" alt="woman doing handstand">
        <p>"GamePlay gives me more than just a workout when I think about it. I joined while going through a tough time, it's given me so much back and helped me to stay feeling good. My quads don't feel so good after leg day, though!"</p>
        <a href="../register_form_page/Register_Form.php"><button type="button">Sign Up</button></a>
        
      </div>

      <div class="class">
        <label>ALDOVO</label>
        <img src="../images/running.jpg" alt="man running">
        <p>"I've become close friends with the assault bike and stairmasters... let's call it a love hate relationship! But in all seriousness, I've even become friendly with John, my PT, who's helped me get even more out of the gym in my path to losing 5 kilos!"</p>
        <a href="../register_form_page/Register_Form.php"><button type="button">Sign Up</button></a>
      </div>

      <div class="class">
        <label>TREVOR</label>
        <img src="../images/squats.jpg" alt="man doing pull-up">
        <p>"Playing sports growing up, I was slightly worried that going to the gym would feel isolating in comparison, but GamePlay is such a friendly environment. I've started attending more classes too, I love that classes are included in the price."</p>
        <a href="../register_form_page/Register_Form.php"><button type="button">Sign Up</button></a>
      </div>

    </div>
    <footer>
      <ul>
        <li>Our gyms</li>
        <li><a>Gyms Near Me</a></li>
        <li><a>Student Gym Membership</a></li>
        <li><a>Gyms in London</a></li>
        <li><a>Fitness Classes</a></li>
        <li><a>Personal trainers</a></li>
        <li><a>City Centre Gyms</a></li>
        <li><a>Corporate Gym Memberships</a></li>
        <li><a>Gym Membership Deals & Offers</a></li>
      </ul>
      <ul>
        <li>Get assistance</li>
        <li><a>Help & Contract</a></li>
        <li><a>Facebook</a></li>
        <li><a>Instagram</a></li>
        <li><a>Twitter</a></li>
        <li><a>Linkedin</a></li>
      </ul>
      <ul>
        <li>Company</li>
        <li><a>About Us</a></li>
        <li><a>Careers</a></li>
        <li><a>GamePlay Corporate</a></li>
        <li><a>Investors Relations</a></li>
        <li><a>GamePlay App</a></li>
        <li><a>Statements</a></li>
        <li><a>GamePlay Switzerland</a></li>
        <li><a>GamePlay Denmark</a></li>
      </ul>
      <ul>
        <li>Serious stuff</li>
        <li><a>Terms & Conditions</a></li>
        <li><a>Gym Rules</a></li>
        <li><a>Privacy</a></li>
        <li><a>Cookies</a></li>
        <li><a>Gym Safety</a></li>
        <li><a>Modern Slavery Statement</a></li>
        <li><a>Gender Pay Gap 2022</a></li>
        <li><a>Tax Strategy</a></li>
        <li><a>Sitemap</a></li>
        <li><a>Register Interest</a></li>
        <li><a>Verify</a></li>
        <li><a href="https://www.flaticon.com/free-icons/show-password" title="show password icons">Show password icons created by Stasy - Flaticon</a></li>
        <li><a href="https://www.flaticon.com/free-icons/show-password" title="show password icons">Show password icons created by ZAK - Flaticon</a></li>
        <li><a href="https://www.flaticon.com/free-icons/search" title="search icons">Search icons created by Freepik - Flaticon</a></li>
      </ul>
    </footer>
    <script src="script.js"></script>

</body>
</html>