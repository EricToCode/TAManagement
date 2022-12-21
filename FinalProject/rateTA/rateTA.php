<?php
// readfile("rate.html");


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

    // Redirection upon submission
    header("Location: http://localhost/projects/TAmanagement/FinalProject/landing/landingpage.html");
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
        <div class="row header" style="background-color:#cfcfcf">
            <div class="col-1 col-t-1 col-s-4"></div>
            <div class="col-1 col-t-1 col-s-4"></div>
            <div class="col-1 col-t-1 col-s-4"></div>
            <div class="col-1 col-t-1 col-s-4">
            <a href="../landing/landingpage.html" class="nav-link"><button class="submitBtn">Logout</button></a>
            </div>
            <div class="col-1 col-t-3 col-s-4" style="background-color: #DA3739; padding: 0; height: 100%; margin-right:0">
                <div class="logo">
                    <img src="logo.png" style="height: 100%; width: 100%; object-fit: contain">
                </div>
            </div>
            <div class="col-9 col-t-8 col-s-4"></div>
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
                <label for="TA" style="width:100%">Teaching Assistant:</label><br>
                <select name="TA" id="TA" required="">
                    <option value="Fall2022"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dummy 1</font></font></option>
                    <option value="Winter2023">Dummy 2</option>
                </select>
                <br><br>
                <label for="course" style="width:100%">Course:</label><br>
                <select name="course" id="course" required="">
                    <option value="Fall2022"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Course 1</font></font></option>
                    <option value="Winter2023">Course 2</option>
                </select>
                <br><br>
                <label for="rate" style="width:100%">Rating:</label><br>
                <select name="rate" id="rate" required="">
                    <option value="Winter2023">1</option>
                    <option value="Winter2023">2</option>
                    <option value="Winter2023">3</option>
                    <option value="Winter2023">4</option>
                    <option value="Winter2023">5</option>
                </select>
                <br><br>
                <textarea id="w3review" name="w3review" rows="4" cols="50"></textarea>
                <br><br>
                <button class="submitBtn" type="submit" name="addProfAndCourse">Submit</button>
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