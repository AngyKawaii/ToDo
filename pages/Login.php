<?php
/*
se la password e username sono corretti reindirizza a benvenuto.html altrimenti
reindirizza index.html


*/
session_start();

//print_r(($_GET));


if (isset($_POST['user']) && isset($_POST['password'])) {

    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username = "root";
    $password = ""; // If your root user has a password, set it here
    $dbname = "todo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected successfully";
    // You can perform your database operations here...


    // SQL query to select data from the table
    $sql = "SELECT id, User, Password FROM users";

    $result = $conn->query($sql);
    $found = false;
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {

            if ($_POST['user'] == $row["User"]  && $_POST['password'] == $row["Password"]) {
                $found = true;
                $_SESSION['id'] = $row["id"];
                break;
            }
        }
    }

    // Remember to close the connection when done
    $conn->close();


    if ($found) {
        //benvenuto
        $_SESSION['user'] = $_POST['user'];
    
        header("Location: benvenuto.php");
    } else {
        header("Location: index.html");
    }
} else  header("Location: index.html");
