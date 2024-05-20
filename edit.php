<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "test";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $userid = $_GET['id'];
    
    // Fetch user details from database based on userid
    $sql = "SELECT * FROM registrations WHERE userid = $userid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
        $password = $row["password"];
        $gender = $row["gender"];
        $email = $row["email"];
        $phone = $row["phone"];
    } else {
        echo "No user found with the provided ID.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update user details in the database
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $newGender = $_POST['gender'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];

    $sql = "UPDATE registrations SET username='$newUsername', password='$newPassword', gender='$newGender', email='$newEmail', phone='$newPhone' WHERE userid=$userid";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>
        <label for="gender">Gender:</label><br>
        <input type="text" id="gender" name="gender" value="<?php echo $gender; ?>"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
