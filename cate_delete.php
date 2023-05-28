<?php

include('./db_connection.php');

$id = $_GET['id'];

$stm = $conn->query("delete from category_list where id=$id");

$stm->execute();
header('Location: index.php');
