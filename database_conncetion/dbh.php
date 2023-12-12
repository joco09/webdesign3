<?php

$username = "s5522735"; // Put your username in the quotations
$password = "nXu4qEdCkywULr4UvERpAhtCALLaAiqp"; // Put your database password in the quotations
$host = "db.bucomputing.uk";
$port = 3306; // Note our MySQL server doesn't use the standard MySQL port, hence why we need to specify it
$database = $username;  // In our case the database name is the same as the username (normally it is
// different) so we can set it as the same as the username

$dsn = "mysql:host=$host;dbname=$database;port=$port";
$options = array ( 'usessl' => true );

try
{
    $pdo = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::MYSQL_ATTR_SSL_CAPATH => '/public_html', PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => 0));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo 'Error: ' . $e->getMessage();
}