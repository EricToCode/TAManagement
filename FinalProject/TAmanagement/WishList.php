    
    <h2 style='text-align: center;'>Please Specify Which TA you Would Like to Have Next Semester </h2>
    <div class="row">
        <div class="col-12 col-t-12 col-s-12" style="text-align:center;">
            <?php
            global $course;

            $file = fopen("matter/course.txt", "r");
            $line = fgets($file);

            $course = $line;

            fclose($file);
            ?>

            <form method="post">
                
                <h4>Term and year: (ex: Winter2023)</h4>
                <input type="text" name="termyear" id="termyear" style="width:auto;" required>
                <br><br>
                <h4>Course number (e.g. COMP307):</h4>
                <input type="text" name="coursenum" id="coursenum" style="width:auto;" required>
                <br><br>
                <h4>TA id:</h4>
                <input type="text" name="TA" id="TA" style="width:auto;" required>
                <br><br>
                <button class="importBtn" type="submit" name="addWishList">Submit</button>
            </form>
            
            
            <?php

            if(isset($_POST["addWishList"])){

                //open database session
                $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
                $conn  = new PDO($dir) or die("cannot open the database");

                $termyear = $_POST["termyear"];
                $coursenum = $_POST["coursenum"];
                $TA = $_POST["TA"];

                // add the assignment records to database
                $stmt = "INSERT INTO TAWishList
                (term_month_year, course_num, prof_name, student_ID)
                    VALUES ('$termyear', '$coursenum', '', '$TA');";
                $query = $conn->prepare($stmt);
                //echo $stmt, "<br>";
                $query->execute();
                echo "<span style='color: #66AC50;'>ADDED</span>";

                $conn->connection = null;
            }
           
            ?>
        </div>
    </div>