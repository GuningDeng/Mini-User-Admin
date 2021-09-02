<?php
    function dbConn ( $udb_name ) {
        try {
            //link to database

            // database type
            $dbms = 'mysql';
            $host = 'localhost';
            $user = 'root';
            $pass = '';

            $dsn = "$dbms:host=$host;dbname=$udb_name";

            // initialize a PDO object
            $dbh = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage() . "<br />");
        }
        return $dbh;
    }

    function sqlQuery($udb_name, $sql) {
        // initialize a PDO object
        $dbh = dbConn($udb_name);
        $shou = $dbh->query($sql);
        return $shou;
    }

    function sqlExce($udb_name, $sql) {
        // initialize a PDO object
        $dbh = dbConn($udb_name);
        $num = $dbh->exec($sql);
        return $num;
    }

