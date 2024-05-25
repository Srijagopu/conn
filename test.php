<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "tests";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT registernow.userid, registernow.username, registernow.email, country.name, state.state_name, city.city_name
FROM registernow
JOIN country ON registernow.country = country.id
JOIN state ON registernow.state= state.id
JOIN city ON registernow.city = city.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
</head>
<body>
    <h1>Registered Users</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['userid']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['state_name']}</td>
                        <td>{$row['city_name']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
