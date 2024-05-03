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

// Get username and post content from form submission
$username = $_POST['username'];
$post_content = $_POST['post'];

// Check if username or post content is empty
if (empty($username) || empty($post_content)) {
    echo "Username and post content cannot be empty.";
} else {
    // Check if username exists in users table
    $check_query = "SELECT * FROM users WHERE user_id = '$username'";
    $result = $conn->query($check_query);

    if ($result->num_rows == 0) {
        echo "User does not exist.";
    } else {
        // Insert new post into Posts table
        $insert_query = "INSERT INTO Posts (content, author_id) VALUES ('$post_content', '$username')";
        if ($conn->query($insert_query) === TRUE) {
            echo "New post created successfully.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>