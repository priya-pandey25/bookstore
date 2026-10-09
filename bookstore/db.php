<?php
$host = 'localhost';
$username = 'root';
$password = 'mysql';
$database = 'lumina_books_db';

// Initial connection to create DB if it doesn't exist
$conn_init = new mysqli($host, $username, $password);
if ($conn_init->connect_error) {
    die("Connection failed: " . $conn_init->connect_error);
}

// Ensure database exists
$conn_init->query("CREATE DATABASE IF NOT EXISTS $database");
$conn_init->close();

// Connect to the specific database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
