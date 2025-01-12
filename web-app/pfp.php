<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>alert('Incorrect login credentials')</script>";
    header("Location: register.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <style>
        body {
            display: flex;
            font-family: "Ubuntu", sans-serif;
            font-weight: 400;
            font-style: normal;
            overflow-x: hidden;
            background: #8d9fdb;
            overflow: hidden;
        }

        .card {
            text-align: center;
            position: absolute;
            left: 300px;
            top: 60px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .card img {
            padding: 12px;
            height: 145px;
            width: 122px;
            align-self: center;
            border-radius: 20%;
            cursor: pointer;
        }

        #nav {
            position: absolute;
            left: 654px;;
            width: 417px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        #socials i {
            font-size: 30px;
            color: rgb(59, 91, 231);
            transition: 0.4s ease-in;
        }

        #socials i:hover {
            color: red;
        }

        nav {
            width: 100%;
        }

        nav {
            padding: 30px;
        }

        nav form {
            position: absolute;
            right: 12px;
        }

        nav a {
            text-decoration: none;
        }

        .dropdown-item img {
            width: 50px;
            padding: 2px;
            border-radius: 20%;
        }

        .dropdown-item img {
            align-content: center;
        }

        .sidebar {
            height: 100%;
            width: 130px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #1e35a5;
            padding-top: 16px;
        }

        .sidebar i {
            color: #f1f1f1;
            padding: 2px 50px;
            font-size: 40px;
        }

        .sidebar ul li {
            list-style: none;
        }

        .sidebar a {
            padding: 20px 0;
            text-decoration: none;
            font-size: 20px;
            color: #fff;
            display: block;
            transition: 0.3s ease-in;
        }

        .sidebar a:hover {
            color: aquamarine;
        }

        .sidebar i {
            position: relative;
            right: 10px;
            transition: 0.3s ease-in;
        }

        .sidebar i:hover {
            cursor: pointer;
            color: aqua;
        }

        .dropdown-show {
            position: relative;
            left: 200px;
        }

        #fileToUpload {
            display: none;
        }
    </style>

</head>

<body>

    <div class="sidebar">
        <i class="fa-solid fa-gamepad"></i>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#clients">Clients</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </div>

    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="dropdown-show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown link
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#" style="color:red" onclick="logout()">Logout</a>
            </div>
        </div>
        <form action="backend.php">
            <input type="search" name="Search" placeholder="Search here" id="search">
            <label for="search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </label>
        </form>
    </nav>

    <div class="card" style="width: 18rem;">
        <?php
        $profilePic = 'pfp.jpg';
        if (isset($_SESSION['profile_pic'])) {
            $profilePic = $_SESSION['profile_pic'];
        }
        ?>
        <img id="current-profile-pic" class="card-img-top" src="<?php echo $profilePic; ?>" alt="Current Profile Picture" onclick="document.getElementById('fileToUpload').click();">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $_SESSION['name'] ?></li>
            <li class="list-group-item"><?php echo $_SESSION['email'] ?></li>
        </ul>
        <div class="card-body" id="socials">
            <a href="#" class="card-link"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" class="card-link"><i class="fa-brands fa-linkedin"></i></a>
            <a href="#" class="card-link"><i class="fa-brands fa-square-instagram"></i></a>
            <a href="#" class="card-link"><i class="fa-brands fa-square-x-twitter"></i></a>
        </div>
        <form id="upload-form" enctype="multipart/form-data" onsubmit="return uploadImage(event)">
            <input type="file" name="fileToUpload" id="fileToUpload" onchange="uploadImage()">
        </form>
    </div>

    <div class="card text-center" id="nav">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#" onclick="toggleContent('active')">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleContent('link')">Edit Content</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="toggleContent('yo')">Yo</a>
                </li>
            </ul>
        </div>

        <div class="card-body" id="card-body">
            <div class="active-content" id="active-content">
                <h5 class='card-title'>Active Content</h5>
                <p class='card-text'>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro expedita reprehenderit aperiam deleniti? Vel fugiat non dolore iusto earum ipsum natus, voluptatem, eligendi, praesentium reiciendis est unde! Consequuntur eos dolorem, velit quam, quo quisquam temporibus consequatur, optio harum unde esse. Molestiae, repudiandae facilis. Consectetur, quibusdam dolorem ducimus temporibus voluptatibus ab ipsam error quasi atque deleniti?</p>
                <a href='#' class='btn btn-primary'>Go somewhere</a>
            </div>

            <div class="edit-content" id="edit-content" style="display: none;">
                <h5 class='card-title'>Edit Account</h5>
                <form id="edit-form">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                    Edit Name: <input type="text" name='update-name' value="<?php echo $_SESSION['name']; ?>">
                    <br>
                    <button type="button" class='btn btn-primary' onclick="editName()">Edit</button>
                </form>
            </div>

            <div class="yo-content" id="yo-content" style="display: none;">
                <h5 class='yo-title'>Yo Content</h5>
                <p class='card-text'>    <table>
        <thead>
            <tr>
                <td><h5>Profile Details</h5></td>
            </tr>
        </thead>
        <tr>
            <td>Name: </td>
            <td>Koustav</td>
        </tr>
        <tr>
            <td>Profession: </td>
            <td>Web Developer</td>
        </tr>
        <tr>
            <td>Country: </td>
            <td>India</td>
        </tr>
    </table></p>
                <a href='#' class='btn btn-primary'>Go somewhere</a>
            </div>
        </div>
    </div>

    <script>
        function toggleContent(content) {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => link.classList.remove('active'));

            const activeLink = document.querySelector(`.nav-link[onclick="toggleContent('${content}')"]`);
            activeLink.classList.add('active');

            const sections = ['active-content', 'edit-content', 'yo-content'];
            sections.forEach(section => {
                document.getElementById(section).style.display = 'none';
            });

            if (content === 'active') {
                document.getElementById('active-content').style.display = 'block';
            } else if (content === 'link') {
                document.getElementById('edit-content').style.display = 'block';
            } else if (content === 'yo') {
                document.getElementById('yo-content').style.display = 'block';
            }
        }

        function logout() {
            <?php session_destroy(); ?>
            alert('Logged out!');
            window.location.href = 'register.html';
        }

        function editName() {
            var formData = $("#edit-form").serialize();

            $.ajax({
                type: "POST",
                url: "edit.php",
                data: formData,
                success: function(response) {
                    if (response.trim() === 'success') {
                        alert('Content edited, please re-login');
                        location.reload();
                    } else {
                        alert(response);
                    }
                },
                error: function() {
                    alert('Error updating record.');
                }
            });
        }

        function uploadImage() {
            var formData = new FormData();
            var fileInput = document.getElementById('fileToUpload');
            var file = fileInput.files[0];
            formData.append('fileToUpload', file);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        alert('File uploaded successfully');
                        document.getElementById('current-profile-pic').src = jsonResponse.file_path;
                        document.getElementById('fileToUpload').value = '';
                    } else {
                        alert('File upload failed: ' + jsonResponse.message);
                    }
                },
                error: function() {
                    alert('An error occurred while uploading the file.');
                }
            });
        }

    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>

</html>
