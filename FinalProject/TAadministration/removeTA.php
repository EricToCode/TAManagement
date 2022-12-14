<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
    margin: 0;
    height: 100%;
    font-family: Arial, Helvetica, sans-serif;
}

.header {
    background-color: white;
    border-top: 4px solid;
    border-top-color: #ba852f;
    box-shadow: rgb(0 0 0 / 4%) 0 1px 0, rgb(0 0 0 / 5%) 0 2px 7px, rgb(0 0 0 / 6%) 0 12px 22px;
}

.footer {
    background-color: #000;
}

* {
    box-sizing: border-box;
}

.row::after {
    content: "";
    clear: both;
    display: table;
}

[class*="col-"] {
    float: left;
    padding: 15px;
}

.logo {
    background-color: #DA3739;
    height: 6vh;
    transform: translateY(7px);
    box-shadow: rgb(0 0 0 / 4%) 0 1px 0, rgb(0 0 0 / 5%) 0 2px 7px, rgb(0 0 0 / 6%) 0 12px 22px;
    padding: 2%;
}

@media only screen and (min-width: 1000px) {
    /* For desktop: */
    /* .col-1 {
        width: 8.33%;
    } */
    .col-1 {
        width: 16.66%;
    }
    /* .col-3 {
        width: 25%;
    } */
    .col-2 {
        width: 33.33%;
    }
    /* .col-5 {
        width: 41.66%;
    } */
    .col-3 {
        width: 50%;
    }
    /* .col-7 {
        width: 58.33%;
    } */
    .col-4 {
        width: 66.66%;
    }
    /* .col-9 {
        width: 75%;
    } */
    .col-5 {
        width: 83.33%;
    }
    /* .col-11 {
        width: 91.66%;
    } */
    .col-6 {
        width: 100%;
    }
    h1 {
        font-weight: 500;
        font-size: 70px;
    }
}

@media only screen and (max-width: 999px) {

    /* For tablets: */
    .col-t-0 {
        width: 0%;
        display: none;
    }

    .col-t-1 {
        width: 6.33%;
    }

    .col-t-2 {
        width: 16.66%;
    }

    .col-t-3 {
        width: 25%;
    }

    .col-t-4 {
        width: 33.33%;
        margin-left: 1%;
    }

    .col-t-5 {
        width: 41.66%;
    }

    .col-t-6 {
        width: 50%;
    }

    .col-t-7 {
        width: 58.33%;
        margin-right: 1%;
    }

    .col-t-8 {
        width: 66.66%;
    }

    .col-t-9 {
        width: 75%;
    }

    .col-t-10 {
        width: 83.33%;
    }

    .col-t-11 {
        width: 91.66%;
        margin-left: 1%;
        margin-right: 1%
    }

    .col-t-12 {
        width: 98%;
        margin-left: 1%;
        margin-right: 1%
    }

    h1 {
        margin-top: 0;
        margin-bottom: 0;
        font-weight: 500;
        font-size: 70px;
    }

}

@media screen and (max-width: 690px) {
    /* For phones: */
    .col-s-0 {
        width: 0%;
        display: none;
    }
    .col-s-1 {
        width: 8.33%;
    }
    .col-s-2 {
        width: 16.66%;
    }
    .col-s-3 {
        width: 25%;
    }
    .col-s-4 {
        width: 33.33%;
    }
    .col-s-5 {
        width: 41.66%;
    }
    .col-s-6 {
        width: 50%;
    }
    .col-s-7 {
        width: 58.33%;
    }
    .col-s-8 {
        width: 66.66%;
    }
    .col-s-9 {
        width: 75%;
    }
    .col-s-10 {
        width: 83.33%;
    }
    .col-s-11 {
        width: 91.66%;
        margin-left: 4%
    }
    .col-s-12 {
        width: 100%;
        text-align: center;
    }
    h1 {
        margin-top: 0;
        margin-bottom: 0;
        font-weight: 500;
        font-size: 50px;
    }
    .logo {
        height: 4vh;
    }

}

.tab {
    font-size: 16px;
    border: none;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    display: inline-block;
    padding: 20px 16px;
    vertical-align: middle;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    background-color: inherit;
    text-align: center;
    cursor: pointer;
    white-space: nowrap;
}

.tab:hover{
    background-color: #ba852f;
    color: white;
}

.tab-bar a {
    padding: 20px 16px;
    color: black;
    text-decoration: none;
}

.active .tab {
    color: white;
    background-color: #ba852f;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

/* .tab-bar {
    border-bottom: 2px solid #A0A0A0;
} */

.message {
    font-family: Georgia, 'Times New Roman', Times, serif;
    color: #000000;
    font-size: 24px;
    text-align: center;
    margin-top:0;
    /* margin: 50px 20% 50px 20%; */
}

.message p {
    color: #000000;
    font-size: 16px;
}

.message img {
    border-radius: 50%;
    align-items: center;
    width: 300px;
    margin-top: 30px;
}

.footer {
    
    bottom: 0;
    width: 100%;
    height: 100px;
    background-color: #000000;
    color: #A0A0A0;
}

.logo2 {
    float: right;
    padding-top: 20px;
    padding-right: 5%;
    position: relative;
    height: 60%;
}

.credit {
    padding-top: 20px;
    padding-left: 5%;
}

.creditlink {
    text-decoration: none;
    color: #ffffff;
}

.main-content {
    padding-left: 5%;
    padding-right: 5%;
    overflow: auto;
    white-space: nowrap;
}

.importMessage {
    color: #68C840;
}

.importBtn {
    padding: 10px 24px 24px 24px;
    transition-duration: 0.4s;
    color: black;
    border: 2px solid #ba852f;
    background-color: #ffffff;
    border-radius: 4px;
    font-size: 16px;
}

.importBtn:hover {
    background-color: #ba852f;
    color: white;
}

* {
    box-sizing: border-box;
}

.submitBtn {
    padding: 6px 24px;
    font-size: 16px;
    background-color: #ba852f;
    color: #ffffff;
    border: 1px solid black;
    border-radius: 6px;
    margin-bottom: 0px;
}

.submitBtn:active {
    background-color: #ffffff;
    color: black;
}

label {
    font-weight: bold;
    display: block;
    width: 150px;
    float: left;
}

input{
    border-color: #AAAAAA;
    border-radius: 8px;
    border: 1px solid;
    height: 30px;
}

select{
    border-color: #AAAAAA;
    border-radius: 8px;
    border: 1px solid;
    height: 30px;
}
    </style>
</head>

<body>
    <!-- remove TA -->
    <h2>Remove TA from course</h2>
    <p style="color: #DA3739;">
        Find the student ID of a TA from the
        <b>Course TA History</b> Page.
    </p>
    <form method="post">
        <label for="browser">Term and year:</label><br>
        <input list="termyears" for="termyear" name="termyear" id="termyear" required>
        <datalist id="termyears">
            <option value="Fall2022">
            <option value="Winter2023">
        </datalist>
        <br><br>
        <label for="studentID">Student ID of the TA:</label><br>
        <input type="text" name="studentID" id="studentID" required>
        <br><br>
        <label for="coursenum">Course number (e.g. COMP307):</label><br>
        <input type="text" name="coursenum" id="coursenum" required>
        <br><br>
        <button class="submitBtn" type="submit" name="removeTA">Submit</button>
    </form>
    <?php
    if (isset($_POST["removeTA"])) {
        //open database session
        $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
        $conn  = new PDO($dir) or die("cannot open the database");

        $termyear = $_POST["termyear"];
        $studentID = $_POST["studentID"];
        $coursenum = $_POST["coursenum"];

        try {
        // add the assignment records to database
        $stmt = "DELETE FROM TA_course_assignment WHERE student_ID='$studentID' AND course_num='$coursenum' AND term_month_year='$termyear';";
        $conn->exec($stmt);
        echo "<span style='color: #66AC50;'>REMOVED</span>";

        }
        catch(PDOException $e)
        {
        echo "No record, please import files first!";
        }
        $conn->connection = null;
    }
    ?>
</body>

</html>