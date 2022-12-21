<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .submitBtn {
            padding: 8px 24px;
            font-size: 16px;
            background-color: #DA3739;
            color: #ffffff;
            border: 1px solid black;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .submitBtn:active {
            background-color: #ffffff;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Add TA -->
    <h2>Add TA to Course</h2>
    <p style="color: #DA3739;">
        Find the student ID of a TA from the
        <b>TA Info & History</b>
        Page.
    </p>
    <form method="post">
        <label for="browser">Term and year:</label><br>
        <input list="termyears" for="termyear" name="termyear" id="termyear" required>
        <datalist id="termyears">
            <option value="Fall2022">
            <option value="Winter2023">
        </datalist>
        <br><br>
        <label for="studentID">Student ID of the TA:</label><br>
        <input type="text" name="studentID" id="studentID" required>
        <br><br>
        <label for="coursenum">Course number (e.g. COMP307):</label><br>
        <input type="text" name="coursenum" id="coursenum" required>
        <br><br>
        <label for="taname">TA name:</label><br>
        <input type="text" name="taname" id="taname" required>
        <br><br>
        <label for="hours">Assigned hours:</label><br>
        <input type="number" name="hours" id="hours" required>
        <br><br>
        <button class="submitBtn" type="submit" name="addTA">Submit</button>
    </form>
    <?php
    if (isset($_POST["addTA"])) {
        //open database session
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        try {
            $conn = new PDO("mysql:host=$servername;dbname=comp307", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }

        $termyear = $_POST["termyear"];
        $studentID = $_POST["studentID"];
        $coursenum = $_POST["coursenum"];
        $taname = $_POST["taname"];
        $hours = $_POST["hours"];

        try {
        // add the assignment records to database
        $stmt = "INSERT INTO TA_course_assignment(term_month_year, student_ID, course_num, TA_name, assigned_hours)
            VALUES ('$termyear', '$studentID', '$coursenum', '$taname', '$hours');";
        $conn->exec($stmt);
        echo "<span style='color: #66AC50;'>ADDED</span>";

        }
        catch(PDOException $e)
        {
        echo "No record, please import files first!";
        }
        $conn->connection = null;
    }
    ?>
</body>

</html>