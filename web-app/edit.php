<?php

session_start();

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "website");

$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
}

$name = $_POST['update-name'];
$id = $_POST['id'];

$stmt = $conn->prepare("UPDATE `login` SET `name`=? WHERE `id`=?");
$stmt->bind_param("si", $name, $id);

if ($stmt->execute()) {
    echo" <script>alert('Content editted please re-login'); </script>";
    header("Location: pfp.php");
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
