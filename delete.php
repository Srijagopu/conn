<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "tests";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $userid = $_GET['id'];

    // Delete user from database based on userid
    $sql = "DELETE FROM registrations WHERE userid=$userid";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "User ID not provided.";
    exit();
}

$conn->close();
?>