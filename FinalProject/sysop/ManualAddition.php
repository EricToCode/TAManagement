    <!-- Manually add Profs and Courses -->
    <h2>Add a Professor and Course</h2>
    <form method="post">
        <label for="termyear">Term and year:</label><br>
        <select name="termyear" id="termyear" required>
            <option value="Winter2022">Winter2022</option>
            <option value="Fall2022">Fall2022</option>
            <option value="Winter2023">Winter2023</option>
        </select>
        <br><br>
        <label for="coursenum">Course number (e.g. COMP307):</label><br>
        <input type="text" name="coursenum" id="coursenum" required>
        <br><br>
        <label for="coursename">Course name:</label><br>
        <input type="text" name="coursename" id="coursename" required>
        <br><br>
        <label for="instructor">Instructor name:</label><br>
        <input type="text" name="instructor" id="instructor" required>
        <br><br>
        <button class="submitBtn" type="submit" name="addProfAndCourse">Submit</button>
    </form>
    <?php
    if (isset($_POST["addProfAndCourse"])) {
        $conn = new PDO('sqlite:../307.db');

        $termyear = $_POST["termyear"];
        $coursenum = $_POST["coursenum"];
        $coursename = $_POST["coursename"];
        $instructor = $_POST["instructor"];

        // add the assignment records to database
        $stmt = "INSERT INTO Courses
        (term_month_year, course_num, course_name, instructor_assigned_name)
            VALUES ('$termyear', '$coursenum', '$coursename', '$instructor');";
        $query = $conn->prepare($stmt);
        // echo $stmt, "<br>";
        $query->execute();
        echo "<span style='color: #66AC50;'>ADDED</span>";

        $conn->connection = null;
    }
    ?>