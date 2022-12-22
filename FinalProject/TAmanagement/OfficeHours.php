    <?php
        global $course;

        $file = fopen("matter/course.txt", "r");
        $line = fgets($file);

        $course = $line;

        fclose($file);
    ?>
    

    <div class="row">
        <div class="col-1 col-t-1 col-s-0"></div>
        <div class="col-3 col-t-3 col-s-12">
            <?php

            //open database session
            $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
            $conn  = new PDO($dir) or die("cannot open the database");
            $currentTerm = 'Fall2022'; // needs update

            $results = $conn->query("SELECT DISTINCT instructor_assigned_name FROM Courses WHERE course_num='$course';");
            $results2 = $conn->query("SELECT DISTINCT student_ID FROM TA_course_assignment WHERE course_num='$course';");
            displayProfs($results, $results2);


            function displayProfs($results, $results2)
            {
                echo "<form method='post'>
                    <label for='person'>Select the Prof/TA you'd like to define responsibilities for</label></br>";
                echo "<select onchange='this.form.submit()' name='person' id='person' required>";
                echo "<option value=''>-- Select a Prof or TA --</option>";

                foreach($results as $prof){
                    $curProf = $prof['instructor_assigned_name'];
                    echo "<option value='$curProf'>$curProf</option>";
                }
                foreach($results2 as $TA){
                    $curTA = $TA['student_ID'];
                    echo "<option value='$curTA'>$curTA</option>";
                }
                echo "</select></br>
                    </form>";

            }
            $conn->connection = null;
            ?>
        </div>
        <div class="col-8 col-t-8 col-s-0"></div>
    </div>

    
    <?php

    if(isset($_POST["person"])){
        echo $variable;

        $name = $_POST['person'];

        $file = fopen("matter/prof.txt", "w") or die ("Unable to");

        fwrite($file, $name);

        fclose($file);

        echo "<h2 style='text-align: center;'>Currently working on $name's office hours and responsibilities</h2>";

        $file = fopen("matter/OfficeHours.txt", "r");

        while (!feof($file)) {
            $line = fgets($file);
            echo $line;
        }
        fclose($file);
    }

    include 'AddOH.php';

    ?>