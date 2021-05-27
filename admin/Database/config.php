<?php

session_start();

$db_host = "remotemysql.com";
$db_username = "6LL5jkeDT7";
$db_password = "4kudWzXRnM";
$db_name = "6LL5jkeDT7";

$db = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
