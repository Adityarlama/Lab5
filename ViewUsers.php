<?php
// Connect to database and fetch all users
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_id FROM Users";
$result = $conn->query($sql);

// Display users in a table
if ($result->num_rows > 0) {
    echo "<table><tr><th>User ID</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["user_id"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No users found";
}
$conn->close();
?>
