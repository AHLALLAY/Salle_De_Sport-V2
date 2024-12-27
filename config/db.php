<?php
$host = "localhost";
$database = "test";
$username = "root";
$password = "";

$msg = null;

try {
    $conn = new PDO("mysql:host=$host;db_name:$database;charset:utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $msg = '+';
} catch (PDOException $e) {
    $msg = "-";
}
