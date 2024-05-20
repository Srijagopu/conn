<!DOCTYPE html>
<html> 
<head>
    <title>Table with database</title>
</head>
<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Password</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "test";

        $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $limit = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $sql = "SELECT * FROM registrations LIMIT $start, $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userid = $row["userid"];
                $username = $row["username"];
                $password = $row["password"];
                $gender = $row["gender"];
                $email = $row["email"];
                $phone = $row["phone"];
                echo "<tr>
                <td>$userid</td>
                <td>$username</td>
                <td>$password</td>
                <td>$gender</td>
                <td>$email</td>
                <td>$phone</td>
                <td><a href='edit.php?id=$userid'>Edit</a></td>
                <td><a href='delete.php?id=$userid'>Delete</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }
        echo "</table>";

        // Pagination links
        $queryCount = "SELECT COUNT(*) AS total FROM registrations";
        $countResult = $conn->query($queryCount);
        $countRow = $countResult->fetch_assoc();
        $totalPages = ceil($countRow['total'] / $limit);

        echo "<div>";
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        echo "</div>";

        $conn->close();
        ?>
    </table>
</body>
</html>
