<?php

    $dir = 'sqlite:/home/2021/hchen172/public_html/TAManagement/FinalProject/307.sqlite'; // with you path to db
    $conn  = new PDO($dir) or die("cannot open the database");
    $query =  "SELECT * FROM users";
    $results = $conn->query( "SELECT * FROM users;");
        
    foreach ($results as $row)
    {
        echo $row[0];
        echo "<br>";
    }
    $dbh = null;
    $haystack = 'How are you?';
    $needle   = 'are';
    if (strpos($haystack, $needle) !== false) {
        echo "hello";
    }
    
  ?>
