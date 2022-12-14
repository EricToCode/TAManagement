    <div class="row">
        <div class="col-12 col-t-12 col-s-12" style="text-align:center;">

            <?php
            global $course;

            $file = fopen("matter/course.txt", "r");
            $line = fgets($file);

            $course = $line;

            fclose($file);
            ?>
            <?php

            $conn = new PDO('sqlite:../307.db');
            $currentTerm = 'Winter2022'; // needs update

            $results = $conn->query("SELECT DISTINCT student_ID FROM ProfTAPerformanceLog WHERE course_num='$course';");
            displayTAs($results);


            function displayTAs($results)
            {
                echo "<form method='post'>
                    <h2>Please Select a TA to see their Performance</h2></br>";
                echo "<select onchange='this.form.submit()' name='TA' id='TA' required style='width: 300px;'>";
                echo "<option value=''>-- Select a TA --</option>";

                foreach($results as $TA){
                    $curTA = $TA['student_ID'];
                    echo "<option value='$curTA'>$curTA</option>";
                }
                echo "</select></br>
                    </form>";

            }
            $conn->connection = null;
            ?>
        </div>
    </div>
    
    <?php

    if(isset($_POST["TA"])){
        $name = $_POST["TA"];

        echo "<h2 style='text-align: center;'>Currently displaying $name's Past Performance</h2>";

        include "PerformanceLogDisplay.php";



    }

    ?>