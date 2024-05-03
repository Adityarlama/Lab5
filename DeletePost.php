<?php
if(isset($_POST['posts'])) {
    $posts_to_delete = $_POST['posts'];

    // Connect to database and delete selected posts
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exp";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach ($posts_to_delete as $post_id) {
        $sql = "DELETE FROM posts WHERE post_id='$post_id'";
        if ($conn->query($sql) !== TRUE) {
            echo "Error deleting post with ID " . $post_id . ": " . $conn->error;
        }
    }

    echo "Selected posts deleted successfully.";

    $conn->close();
}
?>
