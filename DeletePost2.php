<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exp";

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        // Connect to the database
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Delete post
        $sql = "DELETE FROM posts WHERE post_id='$post_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<h2>Post deleted successfully.</h2>";
        } else {
            echo "Error deleting post: " . $conn->error;
        }
        $conn->close();
    }
}
?>
