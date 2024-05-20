<?php
$username=$_POST['username'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$phone=$_POST['phone'];

if(!empty($username)|| !empty($password)|| !empty($gender)||
 !empty($email)|| !empty($phone)){
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="test";

    $connect=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if (mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());

    } else{
        $SELECT="SELECT email FROM registrations WHERE email = ? LIMIT 1";
        $INSERT="INSERT Into registrations(username,password,gender,email,phone) VALUES(?,?,?,?,?)";

        $stmt=$connect->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;

    

        if ($rnum=0){
            $stmt->close();
            $stmt=$connect->prepare($INSERT);
            $stmt->bind_param('ssssi',$username,$password,$gender,$email,$phone);
            $stmt->execute();
            echo "New record inserted sucessfully";
        } else{
            echo "Someone already using this email";
        }
        $stmt -> close();
        $connect ->close();
        
    }

 } else{
    echo "All field are required";
    die();
 }

?>
