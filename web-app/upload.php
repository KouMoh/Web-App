<?php
session_start();
include 'config.php';

$response = ['status' => 'error', 'message' => ''];

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_FILES["fileToUpload"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $response['message'] = "File is not an image.";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    $response['message'] = "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    $response['message'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    $response['message'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $response['message'] = "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO photo (file_loc, uploaded_at) VALUES (?, NOW())");
        $stmt->bind_param("s", $target_file);

        if ($stmt->execute()) {
            $_SESSION['profile_pic'] = $target_file;
            $response['status'] = 'success';
            $response['message'] = "The file has been uploaded.";
            $response['file_path'] = $target_file;
        } else {
            $response['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $response['message'] = "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
echo json_encode($response);
?>
