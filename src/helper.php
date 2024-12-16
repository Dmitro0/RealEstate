<?php

const DB_HOST = 'localhost';
const DB_USER = 'postgres';
const DB_PASS = '200409';
const DB_NAME = 'postgres';

function getDbConnection() {
    $conn = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    return $conn;
}
?>

