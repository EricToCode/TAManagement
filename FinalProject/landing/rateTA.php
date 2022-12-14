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

    $stmt = "CREATE TABLE IF NOT EXISTS TaRatings(
    CourseName VARCHAR(30),
    TaName VARCHAR(30),
    Rating VARCHAR(50),
    Comment VARCHAR(30),
    PRIMARY KEY (CourseName)
    );";
    $conn->exec($stmt);
  
    $courses = $_POST["courses"];
    $ta = $_POST["ta"];
    $stars = $_POST["stars"];
    $comment = $_POST["comment"];

    $stmt = "INSERT INTO TaRatings(CourseName, TaName, Rating, Comment)
        VALUES ('$courses', '$ta', '$stars', '$comment');";
    $conn->exec($stmt);
    //close database session
    $conn = null;

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
    <title>Student Dashboard</title>

    <link rel="stylesheet" href="rateTAstyle.css">
</head>
<body style="margin: 0px; background-color: white;">

    <!-- Header -->
    <div class="row header">
        <div class="col-1 col-t-1 col-s-4"></div>
        <div class="col-2 col-t-3 col-s-4" style="background-color: #DA3739; padding: 0; height: 100%;">
            <div class="logo">
                <img src="Logo.png" style='height: 100%; width: 100%; object-fit: contain'>
            </div>
        </div>
        <div class="col-9 col-t-8 col-s-4">
            <a href="#" class="nav-link" style="margin-left: 15%;">Dashboard</a>
            <a href="landingpage.html" class="nav-link" style="margin-left: 65%;">Logout</a>
        </div>
    </div>


    <!-- Welcome back section -->
    <div class="row">
        <div class="col-1 col-t-1 col-s-0"></div>
        <div class="col-10 col-t-10 col-s-12">
            <h2>
                Welcome back, {username}!
            </h2>
            <h2>
                Rate a TA
            </h2>

        </div>
        <div class="col-1 col-t-1 col-s-0"></div>
    </div>


    <!-- First input line -->
    <div class="row">
        <div class="col-1 col-t-1 col-s-0"></div>
        <div class="col-4 col-t-4 col-s-6">
            <form method="post">
                                
                <label >Select Course</label></br>
                    <select name="courses" value="<?php echo $courses; ?>">
                     <?php
                    $fileHandle = fopen("studentCourses.csv", "r");
                    while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
                        $courses = $row[0];
                    ?>
                    <option value="<?php echo $courses;?>"><?php echo $courses;?></option>
                    <?php
                    }
                    ?>
                    </select>
        </div>
        <div class="col-1 col-t-1 col-s-0"></div>
        <div class="col-4 col-t-4 col-s-5">

        <label >Select a TA </label></br>
                    <select name="ta"  value="<?php echo $ta; ?>">
                     <?php
                    $fileHandle = fopen("TaList.csv", "r");
                    while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
                        $ta = $row[0];
                    ?>
                    <option value="<?php echo $ta;?>"><?php echo $ta;?></option>
                    <?php
                    }
                    ?>
                    </select>
        </div>
        <div class="col-2 col-t-1 col-s-0"></div>
    </div>

    <!-- Second input line -->
    <div class="row" style="padding-top: 3%;">
        <div class="col-1 col-t-1 col-s-0"></div>
        <div class="col-5 col-t-4 col-s-8">

                <label for="comment">Comment</label></br>
                <textarea name="comment" id="comment"></textarea>
                </br>

        </div>
        <div class="col-1 col-t-1 col-s-0"></div>
        <div class="col-4 col-t-4 col-s-2">
                                
                <label for="rating">Rating</label></br>
                <input class="radio" type="radio" name="stars" value="1"> 1
                <input class="radio" type="radio" name="stars" value="2"> 2
                <input class="radio" type="radio" name="stars" value="3"> 3
                <input class="radio" type="radio" name="stars" value="4"> 4
                <input class="radio" type="radio" name="stars" value="5"> 5 </br>

        </div>
        <div class="col-1 col-t-1 col-s-0"></div>
    </div>


    <!-- Submit button -->
    <div class="row" style="padding-top: 3%">
        <div class="col-12 col-t-12 col-s-12" style="padding: 0; text-align: center;">
        
            <button type="submit" name="submit" class="outline-button" > Submit </button>            
        </div>
    </div>
    </form>

    <!-- Image -->
    <div class="row" style="padding-top: 3%">
        <div class="col-12 col-t-12 col-s-12" style="padding: 0;">
            <img src="wide_pan_mcgill.jpg" style='height: 100%; width: 100%; object-fit: cover'>
        </div>
    </div>


    <!-- Footer -->
    <div class="row footer">
        <div class="col-10"></div>
        <div class="col-2">
            <img src="logo-footer.png" style='height: 100%; width: 100%; object-fit: contain'>
            <p style="color: #A0A0A0;">© McGill University 2022</p>
        </div>

    </div>
    
</body>
</html>