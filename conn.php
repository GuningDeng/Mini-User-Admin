<?php
    /**
     * link to database
     * mysqli()
     * Object-oriented
     */

    $servername = "localhost";
    $db_username = "root";
    $dbname = "bbs";
    
    // link to database
    $link = new mysqli($servername,$db_username,"",$dbname);
    mysqli_set_charset($link,"utf8");

    // to test link
    if ( $link ->connect_error ) {
        die("Connection failed: " . $link->connect_error);
    }
    // echo "Connected successfully";
    