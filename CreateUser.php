<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from form submission
$username = $_POST['username'];

// Check if username is empty
if (empty($username)) {
    echo "Username cannot be empty.";
} else {
    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE user_id = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Username already exists.";
    } else {
        // Insert new user into Users table
        $insert_query = "INSERT INTO users (user_id) VALUES ('$username')";
        if ($conn->query($insert_query) === TRUE) {
            echo "New user created successfully.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
