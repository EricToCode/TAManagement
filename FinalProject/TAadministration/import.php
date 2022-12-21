<?php
if (isset($_POST["importTAcohort"])) {
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

    // drop existing tables (overwrite)
    $stmt = "DROP TABLE IF EXISTS CourseQuota;";
    $query = $conn->prepare($stmt);
    $query->execute();
    $stmt = "DROP TABLE IF EXISTS TACohort;";
    $query = $conn->prepare($stmt);
    $query->execute();

    // create table CourseQuota and insert data
    $file_path = "CourseQuota.csv";
    $handle = fopen($file_path, "r") or die("Unable to open file!");
    $i = 0;
    while (($cont = fgetcsv($handle, 1000, ",")) !== false) {
        if ($i == 0) {
            $stmt = "CREATE TABLE CourseQuota (
                term_month_year VARCHAR(10),
                course_num CHAR(7),
                course_type CHAR(4),
                course_name VARCHAR(50),
                instructor_name VARCHAR(30),
                course_enrollment_num INTEGER,
                TA_quota INTEGER,
                TA_number INTEGER,
                PRIMARY KEY (course_name)
            );";
            $conn->exec($stmt);
        } else {
            $TAnum = (string)(floor($cont[5] / $cont[6]) + 1);
            $stmt = "INSERT INTO CourseQuota
                (term_month_year, course_num, course_type, course_name, instructor_name, course_enrollment_num, TA_quota, TA_number)
                VALUES ('$cont[0]', '$cont[1]', '$cont[2]', '$cont[3]', '$cont[4]', '$cont[5]', '$cont[6]', '$TAnum');";
            $conn->exec($stmt);
        }
        $i++;
    }

    // create table TACohort and insert data
    $file_path = "TACohort.csv";
    $handle = fopen($file_path, "r") or die("Unable to open file!");
    $i = 0;
    while (($cont = fgetcsv($handle, 1000, ",")) !== false) {
        if ($i == 0) {
            $stmt = "CREATE TABLE TACohort (
                term_month_year VARCHAR(10),
                TA_name VARCHAR(30),
                student_ID INTEGER,
                legal_name VARCHAR(30),
                email VARCHAR(50),
                grad_ugrad VARCHAR(15),
                supervisor_name VARCHAR(30),
                priority_ BOOLEAN,
                hours_ INTEGER,
                date_applied DATE,
                location_ VARCHAR(50),
                phone INTEGER,
                degree VARCHAR(10),
                courses_applied_for VARCHAR(100),
                open_to_other_courses BOOLEAN,
                notes VARCHAR(100),
                PRIMARY KEY (student_ID)
            );";
            $conn->exec($stmt);
        } else {
            $stmt = "INSERT INTO TACohort
                (term_month_year, TA_name, student_ID, legal_name, email, grad_ugrad, supervisor_name, priority_, hours_, date_applied, location_, phone, degree, courses_applied_for, open_to_other_courses, notes)
                VALUES ('$cont[0]', '$cont[1]', '$cont[2]', '$cont[3]', '$cont[4]', '$cont[5]', '$cont[6]', '$cont[7]', '$cont[8]', '$cont[9]', '$cont[10]', '$cont[11]', '$cont[12]', '$cont[13]', '$cont[14]', '$cont[15]');";
            $conn->exec($stmt);
        }
        $i++;
    }

    $stmt = "DROP TABLE IF EXISTS TA_course_assignment;
    CREATE TABLE TA_course_assignment (
        term_month_year VARCHAR(10),
        student_ID INTEGER,
        course_num CHAR(7),
        PRIMARY KEY (term_month_year, student_ID, course_num)
    );";
    $conn->exec($stmt);

    $conn->connection = null;
    echo "<span style='color: #66AC50;'>import success!</span>";
}
