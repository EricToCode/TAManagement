<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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
                <a href="https://www.cs.mcgill.ca/~hchen172/TAManagement/FinalProject/landing/landingpage.html"><button class="submitBtn">Logout</button></a>
            </div>
    </div>

    
    <?php

        //open database session
        $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
        $conn  = new PDO($dir) or die("cannot open the database");

        $user = $_POST['uname'];
        $pass = $_POST['password'];
    
        $results = $conn->query( "SELECT passwd, signuptype FROM users WHERE username='$user';");

        foreach ($results as $r) {
            if (strcmp($pass, $r['passwd']) == 0) {
                if (strpos($r['signuptype'], 'Sysop') !== false) {
                    echo "<h2 style='text-align:center'>Welcome System Operator</h2>";
                    echo '<div style="text-align: center; padding-top:5%;">
                        <a href="../sysop/sysop.php?Page"><button class="outline-button">Sysop Tasks</button></a>
                        </div>';
                    echo '<div style="text-align: center; padding-top:5%;">
                        <a href="../TAmanagement/TAManagement.php?Page"><button class="outline-button">TA Management</button></a>
                        </div>';
                    echo '<div style="text-align: center; padding-top:5%;">
                        <a href="../TAadministration/TAAdministration.php?Page"><button class="outline-button">TA Administration</button></a>
                        </div>';
                    echo '<div style="text-align: center; padding-top:5%;">
                        <a href="../rateTA/rateTA.php"><button class="outline-button">Rate a TA</button></a>
                        </div>';
                }
                else {
                if (strpos($r['signuptype'], 'Professor') !== false || strpos($r['signuptype'], 'TA')) {
                    echo "<h2 style='text-align:center'>Welcome TA Manager</h2>";
                    echo '<div style="text-align: center; padding-top:5%;">
                        <a href="https://www.cs.mcgill.ca/~hchen172/TAManagement/FinalProject/TAManagement.php?Page"><button class="outline-button">TA Management</button></a>
                        </div>';
                }
                if (strpos($r['signuptype'], 'Admin') !== false) {
                    echo "<h2 style='text-align:center'>Welcome TA Administrator</h2>";
                    echo '<div style="text-align: center; padding-top:5%;">
                        <a href="../TAadministration/TAAdministration.php?Page"><button class="outline-button">TA Administration</button></a>
                        </div>';
                }
                if (strpos($r['signuptype'], 'Student') !== false) {
                    echo "<h2 style='text-align:center'>Welcome Student</h2>";
                    echo '<div style="text-align: center; padding-top:5%;">
                        <a href="../rateTA/rateTA.php"><button class="outline-button">Rate a TA</button></a>
                        </div>';
                }
            }
        }
        else {
            echo "<h2>Sorry, wrong credentials. Please go back to menu by clicking logout.</h2>";
        }
        
        }
    ?>
    
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