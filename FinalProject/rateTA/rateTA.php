<?php
if (array_key_exists('submit', $_POST)) {
    //open database session
    $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
    $conn  = new PDO($dir) or die("cannot open the database");

    $stmt = "CREATE TABLE IF NOT EXISTS TaRatings(
    userID INTEGER,
    CourseName VARCHAR(30),
    TaName VARCHAR(30),
    Rating VARCHAR(50),
    Comment VARCHAR(200),
    student_ID VARCHAR(200),
    PRIMARY KEY (userID, CourseName, TaName)
    );";
    $conn->exec($stmt);
  
    $ID = $_POST["user_ID"];
    $courses = $_POST["courses"];
    $ta = $_POST["ta"];
    $stars = $_POST["stars"];
    $comment = $_POST["comment"];

    $results = $conn->query("SELECT student_ID FROM ta_course_assignment WHERE TA_name='$ta' LIMIT 1;");
    foreach ($results as $r) {
        $sid = $r['student_ID'];
    }
    $stmt = "INSERT INTO TaRatings(userID, CourseName, TaName, Rating, Comment, student_ID)
        VALUES ('$ID', '$courses', '$ta', '$stars', '$comment', '$sid');";

    $conn->exec($stmt);
    //close database session
    $conn = null;

    // Redirection upon sign up
    header("Location: https://www.cs.mcgill.ca/~hchen172/TAManagement/FinalProject/rateTA/rateTA.php");
    exit();
 }
            
  ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rate a TA</title>
        <script type="text/javascript"></script>
        <link rel="stylesheet" href="rate.css">
    </head>
    <body style="margin: 0px; background-color: white;">
    <div class="row header" style="background-color:#CFCFCF">
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

        <div class="col-6" style="background-color: rgb(255, 255, 255)">
            <a href="sysop.html"><img src="mcgill-logo.png" style="display: block; width:10%; height:10%; margin-left: auto; margin-right: auto;"></a>
        </div>

        <div class="col-6">
            <h2 class="message" style="padding:0; background-color:rgb(255, 255, 255)">
                Submit a TA Review
            </h2>
        </div>

        <div class="main-content" style="text-align:center">
            <form method="post" style="display:inline-block; text-align:center; place-items:center">
                <label for="user_ID" style="width:100%">Enter your student ID:</label><br>
                <input type="text" name="user_ID" id="user_ID" required="">
                <br><br>
                <label for="courses" style="width:100%">Course:</label><br>
                <input list="courses" name="courses" id="courses" required="">
                <datalist id="courses">
                    <option name="courses" value="COMP307">
                    <option name="courses" value="COMP551">
                </datalist>
                <br><br>
                <label for="ta" style="width:100%">Teaching Assistant:</label><br>
                <input list="ta" name="ta" id="ta" required="">
                <datalist id="ta">
                    <option name="ta"  value="dummy 1">
                    <option name="ta" value="dummy 2">
                </datalist>
                <br><br>
                <label for="stars" style="width:100%">Rating:</label><br>
                <select name="stars" id="stars" required="">
                    <option name="stars" value="1">1</option>
                    <option name="stars" value="2">2</option>
                    <option name="stars" value="3">3</option>
                    <option name="stars" value="4">4</option>
                    <option name="stars" value="5">5</option>
                </select>
                <br><br>
                <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
                <br><br>
                <button class="submitBtn" type="submit" name="submit">Submit</button>
            </form>
        </div>
        
	</div>
    <footer>
        <div class="footer" style="position:fixed">
            <img class="logo2" src="logo-footer.png" alt="School of CS">
        </div>
    </footer>
</body>

</html>