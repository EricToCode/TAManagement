<?php

    // MAIN PROGRAM
    displayActive("matter/header.txt", $_GET["Page"]);
    if ($_GET["Page"] == "" || $_GET["Page"] == "Welcome") {
        display("matter/Welcome.txt");
    } else if ($_GET["Page"] == "UserManagement") {
        include 'UserManagement.php';
    } else if ($_GET["Page"] == "Import") {
        display("matter/Import.txt");
        include 'Import.php';
    } else if ($_GET["Page"] == "ManualAddition") {
        include 'ManualAddition.php';
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
        $file = fopen($path, "r");
        if ($target=="") {$target = "Page=Welcome";}
        else $target = "Page=" . $target;
        while (!feof($file)) {
            $line = fgets($file);
            if (strstr($line, $target)) $line = str_replace("class=\"empty\"", "class=\"active\"", $line);
            else $line = str_replace("class=\"active\"", "class=\"empty\"", $line);
            echo $line;
        }
        fclose($file);
    }
?>