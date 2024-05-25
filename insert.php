<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];  // Country ID
$state = $_POST['state'];      // State ID
$city = $_POST['city'];        // City ID

if (!empty($username) && !empty($password) && !empty($gender) &&
    !empty($email) && !empty($phone) && !empty($country) && !empty($state) && !empty($city)) {

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "tests";

    // Create connection
    $connect = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    // Check connection
    if ($connect->connect_error) {
        die('Connect Error (' . $connect->connect_errno . ') ' . $connect->connect_error);
    } else {
        $SELECT = "SELECT email FROM registernow WHERE email = ? LIMIT 1";
        $INSERT = "INSERT INTO registernow (username, password, gender, email, phone, country, state, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare statement
        $stmt = $connect->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            // Hash the password before storing it
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $connect->prepare($INSERT);
            $stmt->bind_param("ssssssss", $username, $hashedPassword, $gender, $email, $phone, $country, $state, $city);
            $stmt->execute();
            echo "New record inserted successfully";
        } else {
            echo "Someone is already using this email";
        }
        $stmt->close();
        $connect->close();
    }
} else {
    echo "All fields are required";
    die();
}
?>
