<?php
/**
 * mysql_connect is deprecated
 * using mysqli_connect instead
 */

$databaseHost     = 'localhost';
$databaseName     = 'register_login_db';
$databaseUsername = 'root';
$databasePassword = 'root';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
