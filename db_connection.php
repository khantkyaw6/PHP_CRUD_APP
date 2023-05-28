<?php



// $host = "localhost";
// $db_name = "category";
// $db_user = "root";
// $db_pass = "devkay06";
$host = "localhost";
$db_name = "kk";
$db_user = "root";
$db_pass = "Hello*111#";


try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_pass);
    // echo "category db connected";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
