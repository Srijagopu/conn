<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "tests";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$countryId=isset($_POST['countryId'])? $_POST['countryId']:0;
$stateId=isset($_POST['stateId'])? $_POST['stateId']:0;
$command=isset($_POST['get'])? $_POST['get']: "";

switch($command){
    case "country":
        $statement="SELECT id,name FROM country";
        $dt=mysqli_query($conn,$statement);
        while ($result=mysqli_fetch_array($dt)){
            echo $result1="<option value=" . $result['id'].">".$result['name']."</option>";
        }
        break;

        case "state":
            $result1="<option>Select State</option>";
            $statement="SELECT id,state_name FROM state WHERE country_id=" . $countryId;
            $dt=mysqli_query($conn,$statement);
            while ($result=mysqli_fetch_array($dt)){
                 $result1 .="<option value=" . $result['id'].">".$result['state_name']."</option>";
            }
            echo $result1;

            break;

        case "city":
                $result1="<option>Select city</option>";
                $statement="SELECT id,city_name FROM city WHERE state_id=" . $stateId;
                $dt=mysqli_query($conn,$statement);
                while ($result=mysqli_fetch_array($dt)){
                     $result1 .="<option value=" . $result['id'].">".$result['city_name']."</option>";
                }
                echo $result1;
                break;
            }

