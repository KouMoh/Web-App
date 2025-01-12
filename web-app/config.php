<?php

define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "website");

$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if ($conn->connect_error) { 
    die("Connection failure: " . $conn->connect_error); 
}