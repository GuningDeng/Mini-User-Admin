<?php
    header("Content-typ: text/html; charset=utf8");
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $re_password = isset($_POST["re_password"]) ? $_POST["re_password"] : "";

    if ( $password == $re_password ) {
        // link to database
        $conn = mysqli_connect("localhost","root","","bbs");
        mysqli_set_charset($conn,"uth=8");
        $sql_select = "SELECT email FROM bbs_user WHERE email = '$email'";
        $res = mysqli_query($conn, $sql_select);
        // or user already exists
        $row = mysqli_fetch_array($res);

        if ( $email == $row["email"] ) {
            header("Location:register.php?err=1");
        } else {
            // user does not exist
            $sql_insert = "INSERT INTO `bbs_user`(`password`, `email`) VALUES('$password','$email')";
            mysqli_query($conn, $sql_insert);
            header("Location:register.php?err=3");
        }
        mysqli_close($conn);


    } else {
        header("Location:register.php?err=2");
    }
    

