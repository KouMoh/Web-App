<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "website");

$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) { 
    die("Connection failure: " . $conn->connect_error); 
}

$email = $_POST['email'];
$password = $_POST['password'];


$stmt = $conn->prepare("SELECT * FROM `login` WHERE `email` = ? AND `password` = ?");
$stmt->bind_param("ss",$email, $password);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    session_start();
    $row = $result->fetch_assoc();
    
    $_SESSION['id'] = $row['id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    header("Location:http://localhost/project/pfp.php");
    exit();
} else {
    
    echo "<script>alert('Incorrect login credentials'); window.location.href = 'register.html';</script>";
}

$stmt->close();
$conn->close();

?>
