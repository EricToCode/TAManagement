<?php
if (array_key_exists('submit', $_POST)) {
    //open database session
    $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
    $conn  = new PDO($dir) or die("cannot open the database");

    $stmt = "CREATE TABLE IF NOT EXISTS Users(
    firstname VARCHAR(30),
    lastname VARCHAR(30),
    email VARCHAR(50),
    username VARCHAR(30),
    passwd VARCHAR(30),
    studentId INTEGER,
    courses VARCHAR(50),
    signuptype VARCHAR(100),
    PRIMARY KEY (studentId)
    );";
    $conn->exec($stmt);
    echo "Table created successfully";
  
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $username = $_POST["uname"];
    $password = $_POST["password"];
    $studentId = $_POST["stid"];
    $courses=$_POST["courses"];
    $type = implode(', ', $_POST['type']);

    $stmt = "INSERT INTO Users (firstname, lastname, email, username, passwd, studentId, courses, signuptype)
            VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$studentId', '$courses', '$type');";
    $conn->exec($stmt);
    echo "entries added successfully";
    $conn = null;
    echo "db disconnected successfully";

    // Redirection upon sign up
    header("Location: https://www.cs.mcgill.ca/~hchen172/TAManagement/FinalProject/landing/landingpage.html");
    exit();
}
            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="signupstyle.css">
</head>
<body style="margin: 0px; background-color: white;">

    <!-- Header -->
    <div class="row header" style="background-color:#DA3739">
            <div class="col-1 col-t-1 col-s-4"></div>
            <div class="col-1 col-t-1 col-s-4"></div>
            <div class="col-1 col-t-1 col-s-4"></div>
            <div class="col-1 col-t-1 col-s-4"></div>
            <div class="col-1 col-t-3 col-s-4" style="background-color: #DA3739; padding: 0; height: 100%; margin-right:0">
                <div class="logo">
                    <img src="logo.png" style="height: 100%; width: 100%; object-fit: contain">
                </div>
            </div>
            <div class="col-9 col-t-8 col-s-4">
                <a href="../landing/landingpage.html"><button class="submitBtn">Logout</button></a>
            </div>
    </div>


    <!-- Main Body -->
    <div class="row" style="height: 100vh;">

    <form action ="" method="post">

        <!-- left fields -->
        <div class="col-3 col-t-3 col-s-3" style="padding-top: 5%; padding-left: 5%;">
            <label for="fname"><b>First Name</b></label><br>
            <input type="text" placeholder="Enter First Name" id="fname" name="fname" required><br>
            <br>
            <label for="lname"><b>Last Name</b></label><br>
            <input type="text" placeholder="Enter Last Name" id="lname" name="lname" required><br>
            <br>
            <label for="email">Email</label></br>
            <input type="text" placeholder="Enter Email" id="email" name="email" required></br>
            </br>
        </div>


        <!-- right fields -->
        <div class="col-3 col-t-3 col-s-3" style="padding-top: 5%;">
                <label for="uname">Username</label></br>
                <input type="text" placeholder="Enter Username" id="uname" name="uname" required></br>
                </br>
                <label for="password">Password</label></br>
                <input type="password" placeholder="Enter Password" id="password" name="password" required></br>
                </br>
                <label for="stid">StudentID</label></br>
                <input type="text" placeholder="Enter Student ID" id="stid" name="stid" required></br>
                </br>
                <label for="courses">Course</label></br>
                <input type="text" placeholder="Enter course" id="courses" name="courses"></br>
                </br>
                <label for="type">Signup type</label><br>
                <select name="type[]" id="type[]" multiple style="width:200px; height:100px;">
                <option value="Student">Student</option>
                <option value="Professor">Professor</option>
                <option value="TA">TA</option>
                <option value="Admin">TA Administrator</option>
                <option value="Sysop">System Operator</option>
                </select>
                <br><br>
                
                <!-- sign up button  -->
                <div class="clearfix">
                <button name="submit" type="submit" class="outline-button"> <a>Register</a> </button>
                </div>
        </div>  
    </form>

    <!-- Image -->
    <div class="col-6 col-t-6 col-s-6" style="padding: 0; height:100vh">
        <img src="registrationimage.jpg" style='height: 100%; width: 100%; object-fit: cover'>
        </div>
    </div>

    <!-- Footer -->
    <div class="row footer" style="margin-top: 3%;">
        <div class="col-10"></div>
        <div class="col-2">
            <img src="logo-footer.png" style='height: 100%; width: 100%; object-fit: contain'>
            <p style="color: #A0A0A0;">© McGill University 2022</p>
        </div>

    </div>
    
</body>
</html>