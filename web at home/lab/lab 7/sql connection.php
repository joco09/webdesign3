<?php
$username = "s5522735"; // Put your username in the quotations
$password = "nXu4qEdCkywULr4UvERpAhtCALLaAiqp"; // Put your database password in the quotations
$host = "db.bucomputing.uk";
$port = 3306; // Note our MySQL server doesn't use the standard MySQL port, hence why we need to specify it
$database = $username;  // In our case the database name is the same as the username (normally it is
// different) so we can set it as the same as the username

$connection = mysqli_init(); // Initializes MySQLi and returns a resource for use with mysqli_real_connect()
if (!$connection) { // If initalising MySQLi failed (i.e. it didn't return true, hence the ! for checking not true)
    echo "<p>Initalising MySQLi failed</p>";
} else {
    // Establish secure connection using SSL for use with MySQLi
    mysqli_ssl_set($connection, NULL, NULL, NULL, '/public_html/sys_tests', NULL);

    // Connect the MySQL connection
    mysqli_real_connect($connection, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
    if (mysqli_connect_errno()) { // If connection error
        // Display error message and stop the script. We can't do any database work as there is no connection to use
        echo "<p>Failed to connect to MySQL. " .
            "Error (" . mysqli_connect_errno() . "): " . mysqli_connect_error() . "</p>";
    } else {
//                echo "<p>Connected to server: " . mysqli_get_host_info($connection) . "</p>";

        // ADD CODE THAT USES THE DATABASE CONNECTION HERE

//                $query = "insert into User_member_table (First_name, Last_name, Phone_number, E_mail, Password, Membership_type_id)
//                values ('Zambra', 'Joco', '02565', 'Homa@gmail.com', 'Password', 4);";
//                mysqli_query($connection, $query);
        // After all work with the database is complete disconnect the database connection
        // (we are finished with the database)
//                mysqli_close($connection);
//                echo "<p>Disconnected from server: " . $host . "</p>";
    }
}

//$query = "INSERT INTO User_member_table (First_name, Last_name, Phone_number, E_mail,Password,Membership_type_id)
//VALUES ('Suckma Belenda', 'Ndass', '07546235487', 'Suckma.bell@gmail.com', 'justdoit',3);";
//$result = mysqli_query($connection, $query);


$query = "SELECT *
FROM User_member_table
WHERE First_name = 'Suckma Belenda' AND Last_name = 'Ndass';";
$result = mysqli_query($connection, $query);

echo $result;





//