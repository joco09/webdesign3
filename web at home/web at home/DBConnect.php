            <?php
        $username = "s5522735"; // Put your username in the quotations
        $password = "nXu4qEdCkywULr4UvERpAhtCALLaAiqp"; // Put your database password in the quotations
        $host = "db.bucomputing.uk";
        $port = 3306; // Note our MySQL server doesn't use the standard MySQL port, hence why we need to specify it
        $database = $username;  // In our case the database name is the same as the username (normally it is 
        // different) so we can set it as the same as the username

        $mysqli = new mysqli(); // Create a MySQLi object
        $mysqli->init(); // Initializes MySQLi and returns a resource for use with mysqli::real_connect()
        if (!$mysqli) { // If initalising MySQLi failed (i.e. it didn't return true, hence the ! for checking not true)
            echo "<p>Initalising MySQLi failed</p>";
        } else {
            // Establish secure connection using SSL for use with MySQLi
            $mysqli->ssl_set(NULL, NULL, NULL, '/public_html/sys_tests', NULL);

            // Connect the MySQL connection
            $mysqli->real_connect($host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
            if ($mysqli->connect_errno) { // If connection error
                // Display error message and stop the script. We can't do any database work as there is no connection to use
                echo "<p>Failed to connect to MySQL. " .
                "Error (" . $mysqli->connect_errno . "): " . $mysqli->connect_error . "</p>";
            } else {
//                echo "<p>Connected to server: " . $mysqli->host_info . "</p>";

                // ADD CODE THAT USES THE DATABASE CONNECTION HERE

//                $sql = "SELECT * FROM User";
//                $result = mysqli_query($mysqli, $sql);
//                while($row = mysqli_fetch_assoc($result)) {
//                    echo "id: " . $row["pin"]."<br>";}
//                // After all work with the database is complete disconnect the database connection
//                // (we are finished with the database)
//                $mysqli->close();
//                echo "<p>Disconnected from server: " . $host . "</p>";
            }
        }
