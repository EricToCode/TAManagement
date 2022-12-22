<?php
if (isset($_POST["importTAcohort"])) {
    //open database session
    $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
    $conn  = new PDO($dir) or die("cannot open the database");

    // drop existing tables (overwrite)
    $stmt = "DROP TABLE IF EXISTS CourseQuota;";
    $conn->exec($stmt);
    $stmt = "DROP TABLE IF EXISTS TACohort;";
    $conn->exec($stmt);
    $stmt = "DROP TABLE IF EXISTS ProfTAPerformanceLog;";
    $conn->exec($stmt);
    $stmt = "DROP TABLE IF EXISTS TAWishList;";
    $conn->exec($stmt);

    // create table CourseQuota and insert data
    $file_path = "csvs/CourseQuota.csv";
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
    $file_path = "csvs/TACohort.csv";
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

    // create TA_course_assignment table
    $stmt = "CREATE TABLE IF NOT EXISTS TA_course_assignment(
        term_month_year VARCHAR(10),
        student_ID INTEGER,
        course_num CHAR(7),
        TA_name VARCHAR(50),
        assigned_hours INTEGER,
        PRIMARY KEY (term_month_year, student_ID, course_num)
    );";
    $conn->exec($stmt);

    // create table for ProfTAPerformanceLog
    $file_path = "csvs/ProfTAPerformanceLog.csv";
    $handle = fopen($file_path, "r") or die("Unable to open file!");
    $i = 0;
    while (($cont = fgetcsv($handle, 1000, ",")) !== false) {
        if ($i == 0) {
            $stmt = "CREATE TABLE IF NOT EXISTS ProfTAPerformanceLog(
                term_month_year VARCHAR(10),
                course_num CHAR(7),
                student_ID INTEGER,
                comment VARCHAR(200),
                PRIMARY KEY (term_month_year, course_num, student_ID)
            );";
            $conn->exec($stmt);
        } else {
            $stmt = "INSERT INTO ProfTAPerformanceLog
                (term_month_year, course_num, student_ID, comment)
                VALUES ('$cont[0]', '$cont[1]', '$cont[2]', '$cont[3]');";
            $conn->exec($stmt);
        }
        $i++;
    }

    // create table for TAWishList
    $file_path = "csvs/TAWishList.csv";
    $handle = fopen($file_path, "r") or die("Unable to open file!");
    $i = 0;
    while (($cont = fgetcsv($handle, 1000, ",")) !== false) {
        if ($i == 0) {
            $stmt = "CREATE TABLE IF NOT EXISTS TAWishList(
                term_month_year VARCHAR(10),
                course_num CHAR(7),
                prof_name VARCHAR(30),
                student_ID INTEGER,
                PRIMARY KEY (term_month_year, course_num, prof_name, student_ID)
            );";
            $conn->exec($stmt);
        } else {
            $stmt = "INSERT INTO TAWishList
                (term_month_year, course_num, prof_name, student_ID)
                VALUES ('$cont[0]', '$cont[1]', '$cont[2]', '$cont[3]');";
            $conn->exec($stmt);
        }
        $i++;
    }

    $flagged_courses = "";
    $results = $conn->query("SELECT course_name,course_num, course_enrollment_num,TA_quota FROM CourseQuota;");
    foreach ($results as $course) {
        $enrollment = $course['course_enrollment_num'];
        $TAquota = $course['TA_quota'];
        if ($enrollment / $TAquota < 30 || $enrollment / $TAquota > 45) {
            $flagged_courses = $flagged_courses . $course['course_num'] . " " . $course['course_name'] . "<br>";
        }
    }
// end connection and confirm import success
    $conn->connection = null;
    echo "<span style='color: #66AC50;'>import success!</span>";

    echo '<table class="flagged_classes" id="flagged_classes">';
        echo "<tr>
            <th>Careful! There classes have <30 or >45 students per TA</th>";
        echo "</tr>";
        echo "<tr>
        <td>$flagged_courses</td>";
        echo "</tr>";
        echo "</table>";
}
