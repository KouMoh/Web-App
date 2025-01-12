<?php

    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "website");

    $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if ($conn->connect_error) { 
        die("Connection failure: " 
            . $conn->connect_error); 
    } else{
    echo "Connection Successful!";
    }

    $name =  $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `login`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";

    if(mysqli_query($conn, $sql)){
        echo "<h3>data stored in a database successfully." 
            . " Please browse your localhost php my admin" 
            . " to view the updated data</h3>"; 

        echo nl2br("\n$name\n$email");
    } else{
        echo "ERROR: Hush! Sorry $sql. " 
            . mysqli_error($conn);
    }
?>