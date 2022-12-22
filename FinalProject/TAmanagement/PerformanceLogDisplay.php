    <div class="row">
        <div class="col-1 col-t-1 col-s-0"></div>
        <div class="col-6 col-t-3 col-s-12">
            <h2> Past Notes </h2>

            <div style="border-color: #AAAAAA; border-radius: 8px; border: 1px solid; width: 80%;"> 
            <?php

            $conn = new PDO('sqlite:../307.db');

            if(isset($_POST["TA"])){
                $name = $_POST['TA'];
            

                $proflog = "";
                $results = $conn->query("SELECT * FROM ProfTAPerformanceLog WHERE student_ID=$name;");
                foreach ($results as $log) {
                    $proflog = $proflog . "Semester: " . $log['term_month_year'] . "Comment: " . $log['comment'] . "<br>";
                }

                echo "$proflog";
            }
            $conn->connection = null;

            ?>
            </div>
            
        </div>
        <div class="col-4 col-t-3 col-s-12">
            <h2> New Note </h2>

	    <form method="post">
            <textarea name="newNote" id="newNote"></textarea>
            </br>
            <button class="submitBtn" type="submit" name="noteAdded" >Submit</button>
        </form>

        <?php

            if (isset($_POST["noteAdded"])) {
               
                echo "<span style='color: #66AC50;'>ADDED</span>";

            }
        ?>

        </div>
        <div class="col-1 col-t-1 col-s-0"></div>
    </div>
