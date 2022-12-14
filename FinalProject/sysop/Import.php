<?php
if (isset($_POST["importProfsCourses"])) {
    $conn = new PDO('sqlite:../307.db');

    // drop existing tables (overwrite)
    $stmt = "DROP TABLE IF EXISTS Courses;";
    $query = $conn->prepare($stmt);
    $query->execute();
    $stmt = "DROP TABLE IF EXISTS Profs;";
    $query = $conn->prepare($stmt);
    $query->execute();

    // create tables and insert data
    $file_path = "CoursesAndProfs.csv";
    $handle = fopen($file_path, "r") or die("Unable to open file!");
    $i = 0;
    while (($cont = fgetcsv($handle, 1000, ",")) !== false) {
        if ($i == 0) {

            // Create the courses table
            $stmt = "CREATE TABLE Courses (
                term_month_year VARCHAR(10),
                course_num CHAR(7),
                course_name VARCHAR(50),
                instructor_assigned_name VARCHAR(30),
                PRIMARY KEY (course_name)
            );";
            $query = $conn->prepare($stmt);
            // echo $stmt, "<br>";
            $query->execute();

        } else {
            $TAnum = (string)(floor($cont[5] / $cont[6]) + 1);
            $stmt = "INSERT INTO Courses
                (term_month_year, course_num, course_name, instructor_assigned_name)
                VALUES ('$cont[0]', '$cont[1]', '$cont[2]', '$cont[3]');";
            $query = $conn->prepare($stmt);
            // echo $stmt, "<br>";
            $query->execute();

        }
        $i++;
    }

    $conn->connection = null;
    echo "<span style='color: #66AC50;'>import success!</span>";
}
