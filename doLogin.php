<?php
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

if ( !empty($email) && !empty($password) ) {
    $conn = mysqli_connect('localhost','root','','bbs');
    $sql = "select email, password from `bbs_user` where email = '$email'";
    $ret = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($ret); 

    if ( $email == $row['email'] && password_verify($password, $row['password'] ) ) {
        if ($rememberme == "on") {
            setcookie("", $email, time() + 7 * 24 * 3600);
        }
        // set up session
        session_start();

        // write $username to session
        $_SESSION['user'] = $email;
        // redirect to loginsucc.php
        header("Location:loginsucc.php");
        mysqli_close($conn);
    } else {
        // email & password incorrect
        header("Location:login.php?err=1");
    }
    
} else {
    // email & passwor empty
    header("Location:login.php?err=2");

}
