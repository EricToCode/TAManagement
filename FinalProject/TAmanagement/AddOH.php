    <?php
        global $course;

        $file = fopen("matter/course.txt", "r");
        $line = fgets($file);

        $course = $line;

        fclose($file);

        global $person;

        $file = fopen("matter/prof.txt", "r");
        $line = fgets($file);

        $person = $line;

        fclose($file);
    ?>
    

    <?php
    if(isset($_POST["startTimeADD"])){

        //open database session
        $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
        $conn  = new PDO($dir) or die("cannot open the database");

        $days = $_POST['weekDayADD'];

        $time = $_POST["startTimeADD"] . ' to ' . $_POST["endTimeADD"];

        $columns = "";

        $times = "";
        // building up the columns to edit
        foreach($_POST['weekDayADD'] as $day){
            $columns .= $day . ", ";

            $times .= "'" . $time . "'" . ", ";
        }

        $columns = substr($columns, 0, -2);

        $times = substr($times, 0, -2);


        // add the OH hours for each day
        $stmt = "INSERT INTO OfficeHours(course_num, responsible, $columns)
        VALUES ('$course', '$person', $times);";

        //echo $stmt;
        $query = $conn->prepare($stmt);
        // echo $stmt, "<br>";
        $query->execute();
        
        echo "<span style='color: #66AC50;'>ADDED</span>";

        $conn->connection = null;

    }

    ?>
    