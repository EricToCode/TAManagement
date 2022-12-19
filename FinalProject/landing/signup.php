<?php
if (array_key_exists('submit', $_POST)) {
    //open database session
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    try {
        $conn = new PDO("mysql:host=$servername;dbname=comp307", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully"; 
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

    $stmt = "CREATE TABLE IF NOT EXISTS Users(
    firstname VARCHAR(30),
    lastname VARCHAR(30),
    email VARCHAR(50),
    username VARCHAR(30),
    passwd VARCHAR(30),
    studentId INTEGER,
    courses VARCHAR(50),
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

    $stmt = "INSERT INTO Users (firstname, lastname, email, username, passwd, studentId, courses)
            VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$studentId', '$courses');";
    $conn->exec($stmt);
    echo "entries added successfully";
    $conn = null;
    echo "db disconnected successfully";

    // Redirection upon sign up
    header("Location: http://localhost/projects/FinalProject/landing/landingpage.html");
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
    <div class="row header" style="background-color: #DA3739">
        <div class="col-2 col-t-3 col-s-4" style="background-color: #DA3739; padding: 0; height: 100%;">
            <div class="logo">
                <img src="Logo.png" style='height: 100%; width: 100%; object-fit: contain'>
            </div>
        </div>
        <div class="col-9 col-t-8 col-s-4">
        </div>
        <div class="col-1 col-t-1 col-s-4"></div>
    </div>


    <!-- Main Body -->
    <div class="row" style="height: 100vh;">

    <form action ="" method="post">

        <!-- left fields -->
        <div class="col-3 col-t-3 col-s-3" style="padding-top: 5%; padding-left: 5%;">
            <label for="fname"><b>First Name</b></label><br>
            <input type="text" placeholder="Enter First Name" id="fname" name="fname" required><br>
            <br>
            <label for="lname"><b>Last Name</b></label>
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
                <!--
                <label for="as">Your courses (choose all that apply)</label></br>
                <select name="courses" multiple>
                    <?php
                        $fileHandle = fopen("courses.csv", "r");
                        while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
                        $courses = $row[0];
                    ?>
                    <option value="<?php echo $courses;?>"><?php echo $courses;?></option>
                    <?php
                    }
                    ?>   
                </select><br>
                <br>
                -->
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