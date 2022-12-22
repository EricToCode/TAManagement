
<div class="row">
    <div class="col-12 col-t-12 col-s-12" style="text-align:center">
        <?php

        // $conn = new PDO('sqlite:../307.db');
        $currentTerm = 'Winter2022'; // needs update
        $currentTerm = 'Fall2022';

        //open database session
        $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
        $conn  = new PDO($dir) or die("cannot open the database");
        $stmt = "CREATE TABLE IF NOT EXISTS Courses(
            course_num VARCHAR(10)
            );";
        $conn->exec($stmt);

        $results = $conn->query("SELECT DISTINCT course_num FROM Courses;");
        displayCourses($results);


        function displayCourses($results)
        {
            echo "<form method='post'>";
            echo "<select onchange='this.form.submit()' name='course' id='course' required>";
            echo "<option value=''>-- Select a Course --</option>";

            foreach($results as $course){
                $curCourse = $course['course_num'];
                echo "<option value='$curCourse'>$curCourse</option>";
            }
            echo "</select></br>
                </form>";

        }
        $conn->connection = null;
        ?>

    </div>
</div>

<?php

if(isset($_POST["course"])){
    
    $file = fopen("matter/course.txt", "w") or die ("Unable to");

    $course = $_POST["course"];

    echo $course;

    fwrite($file, $course);

    fclose($file);

    echo "<script>window.location = 'https://www.cs.mcgill.ca/~apopia/FinalProject/TAManagement/TAManagement.php?Page=OfficeHours'</script>";
}

?>
