<?php
$servername="localhost";
$usernanme ="root";
$password="";
$conn = new mysqli($servername,$usernanme,$password );
if($conn->connect_error)
die("Connection Failed".$conn->connect_error);
$databasename="Login_Credentials";
$checkdb =$conn->query("SHOW DATABASES LIKE '$databasename'");
if(!$checkdb->num_rows > 0)
{
    $sql = "create database Login_Credentials";
    if($conn->query($sql)){
}
}
$conn = new mysqli($servername,$usernanme,$password,$databasename);
if($conn->connect_error)
die("Connection Failed ".$conn->connect_error);

// Create table if doesn't exist
$table = "Signupdetails";
$sql = $conn->query("SHOW TABLES LIKE '$table'");
if(!$sql->num_rows> 0 )
{
    $sql = "CREATE TABLE signupdetails(
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        mobilenumber VARCHAR(10) NOT NULL,
        email VARCHAR(100) NOT NULL PRIMARY KEY,
        password VARCHAR(255) NOT NULL
    )";
    if($conn->query($sql)){
        echo "<h1>Table Created</h1>";
    }
}
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$mobileno = $_POST['mobileno'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO signupdetails (firstname, lastname,mobilenumber, email, password)
VALUES ('$firstname', '$lastname', '$mobileno', '$email', '$password')";
try{
if($conn->query($sql) == TRUE)
{
    echo "<h1 style='color:green;font-size:5em;text-align:center;top:50%;'>Successfully Sign in</h1>";
}}
catch(Exception $e){
echo "<h1 style='color:green;font-size:5em;text-align:center;'>This email account is already exist</h1>";
}
?>