<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Login_Credentials";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from form
$input_username = $_POST['username'];
$input_password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM Signupdetails WHERE email = ?");
$stmt->bind_param("s", $input_username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($stored_password);
$stmt->fetch();

if ($stmt->num_rows > 0) {
    // Verify the password
    if ($stored_password === $input_password) {
        echo "<h1 style='color:green;font-size:5em;text-align:center;'>Successfully Login.</h1>";
        exit();
    } else {
        echo "<h1 style='color:red;font-size:5em;text-align:center;'>Incorrect password.</h1>";
        echo"<a href='<?previous ?>'>Back</a>";
    }
} else {
    echo "<h1 style='color:blue;font-size:5em;text-align:center;'>This account doesn't exist.</h1>";
}

// Close connection
$stmt->close();
$conn->close();
?>
