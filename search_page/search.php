<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="search_style.css">
    <title>Game Play</title>
</head>

<body>
<?php require '../headers/header2.php';?>
<div class="search-results">

<?php
try {
    if (isset($_POST['searchButton'])) {
        if (empty($_POST['searchInput'])) {
            echo "<div class='class-name'> The search bar is empty</div>";
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
                echo "<div class='class-name'> <h2>" . $results[$i]['Class_name'] . "</h2></div>
            <div> Class Duration : " . $results[$i]['Class_duration'] . "</div>
            <div> Description : " . $results[$i]['description'] . "</div>          
            <div class='view-classes'><a href='../classes/classes.php'> <button class='view-classes-button'> View classes </button>  </a></div>";
            }
            if (count($results) == 0) {
                echo "<div class='class-name'> There are no matches</div>";
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

</div>
<script src="../profile page/profile.js"></script>
</body>

</html>
