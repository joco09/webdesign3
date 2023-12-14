<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="search_style.css.css">
    <title>Game Play</title>
</head>

<body>

<?php
require '../headers/header2.php';

try {
    if (isset($_POST['searchButton'])) {
        if (empty($_POST['searchInput'])) {
            echo "<div class='textbox'> There are no matches</div>";
        }
        else {
            require '../database_conncetion/dbh.php';

            $query = "SELECT Class_name, Class_duration, description FROM Class_Table WHERE description LIKE '%' ? '%' OR Class_name LIKE '%' ? '%';";

            // Prepares query before sending in actual data.

            $stmt = $pdo->prepare(($query));
            $stmt->execute([$_POST["searchInput"], $_POST["searchInput"]]);

            // Sends data after query has been sent.
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($results); $i++) {
                echo "<div class='textbox'> <h2>" . $results[$i]['Class_name'] . "</h2></div>
            <div class='textbox'> Class Duration : " . $results[$i]['Class_duration'] . "</div>
            <div class='textbox'> Description : " . $results[$i]['description'] . "</div>          
            <a href='../classes/classes.php'> <button> View classes </button>  </a>";
            }
            if (count($results) == 0) {
                echo "<div class='textbox'> There are no matches</div>";
            }
        }
    }
    $pdo = null;
    $stmt = null;
} catch (PDOException $e) {
    echo "";
    die("Query failed: " . $e->getMessage());
}


?>


<script src="../profile page/profile.js"></script>
</body>

</html>
