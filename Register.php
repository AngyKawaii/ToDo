<?php

if (!(isset($_POST['user']) && isset($_POST['password']) && isset($_POST['email']))) {
    header("Location: Register.html");
}

$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "todo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
// You can perform your database operations here...


// Sample data
$userName = $_POST['user'];
$password = $_POST['password'];
$email = $_POST['email'];


// SQL query to insert data into the table
$sql = "INSERT INTO users (User, Password, Email) VALUES ('$userName', '$password', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Remember to close the connection when done
$conn->close();
header("Location: Index.html");
