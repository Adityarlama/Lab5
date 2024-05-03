<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Posts</title>
</head>
<body>
    <h1>User Posts</h1>
    <?php
    if(isset($_POST['username'])) {
        $username = $_POST['username'];

        // Connect to database and fetch posts of the selected user
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "exp";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT content FROM posts WHERE author_id='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Content</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["content"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No posts found for this user";
        }
        $conn->close();
    }
    ?>
</body>
</html>
