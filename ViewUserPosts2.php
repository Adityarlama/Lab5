<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Posts</title>
</head>
<body>
    <h1>View User Posts</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Select User:</label>
        <select name="username">
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "exp";

            // Connect to the database
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve list of users
            $sql = "SELECT user_id FROM users";
            $result = $conn->query($sql);

            // Display users in dropdown list
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row['user_id']."'>".$row['user_id']."</option>";
                }
            }
            $conn->close();
            ?>
        </select>
        <button type="submit">Submit</button>
    </form>

    <?php
    // Check if form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['username'])) {
            $username = $_POST['username'];

            // Connect to the database
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve user posts
            $sql = "SELECT content FROM posts WHERE author_id='$username'";
            $result = $conn->query($sql);

            // Display user posts
            if ($result->num_rows > 0) {
                echo "<h2>User Posts:</h2>";
                while($row = $result->fetch_assoc()) {
                    echo "<p>".$row["content"]."</p>";
                }
            } else {
                echo "<p>No posts found for this user.</p>";
            }
            $conn->close();
        }
    }
    ?>
</body>
</html>
