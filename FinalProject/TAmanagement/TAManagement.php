<?php

    // MAIN PROGRAM
    displayActive("matter/header.txt", $_GET["Page"]);
    if ($_GET["Page"] == "" || $_GET["Page"] == "Welcome") {
        display("matter/Welcome.txt");
        include "SelectCourse.php";
    } else if ($_GET["Page"] == "OfficeHours") {
        include 'OfficeHours.php';
    } else if ($_GET["Page"] == "Channel") {
        display("matter/Channel.txt");
    } else if ($_GET["Page"] == "PerformanceLog") {
        include 'PerformanceLog.php';
    } else if ($_GET["Page"] == "WishList") {
        include 'WishList.php';
    } else if ($_GET["Page"] == "TAReport") {
        display("matter/TAReport.txt");
        
    } else {
        echo "404: Invalid Page!";
    }
    display("matter/footer.txt");
    
    // END MAIN

    function display($path)
    {
        $file = fopen($path, "r");

        while (!feof($file)) {
            $line = fgets($file);
            echo $line;
        }
        fclose($file);
    }

    function displayActive($path, $target)
    {
        if ($target=="") {$target = "Page=Welcome";}
        else{
            $file = fopen($path, "r");
            if (sizeof($target) == 0) $target = "Page=Welcome";
            else $target = "Page=" . $target;
            while (!feof($file)) {
                $line = fgets($file);
                if (strstr($line, $target)) $line = str_replace("class=\"empty\"", "class=\"active\"", $line);
                else $line = str_replace("class=\"active\"", "class=\"empty\"", $line);
                echo $line;
            }
            fclose($file);
        }

        
    }
?>