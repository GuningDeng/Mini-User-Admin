<?php
include "conn.php";
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$re_password = isset($_POST["re_password"]) ? $_POST["re_password"] : "";
$age = isset($_POST["age"]) ? $_POST["age"] : "";
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$address = isset($_POST["address"]) ? $_POST["address"] : "";

// ---------- validate input -----------------
function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    
    return $data;
}

if (!empty($user)) { 
    if ( !empty( $_POST["email"]) ) {
        if ( !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) ) {
            header("Location:userlist.php?err=2"); // invalid email
        } else { 
            if ( empty( $_POST["password"]) && empty( $_POST["re_password"] ) ) {
                header("Location:userlist.php?err=8"); // password require 
            } else {
                if ( !preg_match("/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,}/",$password ) ) {
                    header("Location:userlist.php?err=9"); // invalide password format
                } else {
                    if ( $password == $re_password ) {
                        // operate database
                        // link to database
                        $u_email = test_input($email);
                        $conn = mysqli_connect("localhost","root","","bbs");
                        mysqli_set_charset($conn,"uth=8");
                        $sql_select = "SELECT email FROM bbs_user WHERE email = '$u_email'";
                        $res = mysqli_query($conn, $sql_select);
                        // or user already exists
                        $row = mysqli_fetch_array($res);

                        if ( $u_email == $row["email"] ) {
                            header("Location:userlist.php?err=10"); // user already exists
                        } else {
                            // user does not exist
                            if ( !preg_match("/[A-Za-z_ ]*/",$username) ) {
                                header("Location:userlist.php?err=3"); // invalid username
                            }
                            if ( !preg_match("/(?:[1-9][0-9]?|1[01][0-9]|120)/",$age) ) {
                                header("Location:userlist.php?err=4"); // invalid age
                            }
                            if ( $gender != "1" && $gender != "2" ) {
                                header("Location:userlist.php?err=5"); // invalid gender
                            }

                            if ( !preg_match("/[A-Za-z_ ]*/",$address) ) {
                                header("Location:userlist.php?err=4"); // invalid age
                            }

                            $u_email = test_input($email);
                            $u_username = test_input($username);
                            $u_age = test_input($age);
                            $u_gender = test_input($gender);
                            $u_address = test_input($address);

                            $cost = 9; //iteration
                            // $u_password = test_input($password);
                            $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => $cost]); // password encryption
                            $sql = "INSERT INTO `bbs_user`(`username`, `password`, `age`, `email`, `address`, `gender`) 
                            VALUES ('$u_username','$hash',$u_age,'$u_email','$u_address',$u_gender)";
                            
                            $result = mysqli_query($conn, $sql); // execute sql query!!!

                            $id = mysqli_insert_id($conn);

                            if ($id) {
                                // echo 'Successfully added! <a href="userlist.php">Return user list</a>';
                                header("Location:userlist.php?err=11"); // success added
                            } else {
                                // echo 'Failed to add!';
                                header("Location:userlist.php?err=12"); // faild to add!
                            }
                            // header("Location:register.php?err=7"); // registration success
                            mysqli_close($link);

                        }

                    } else {
                        // echo 'passwords not match';
                        header("Location:userlist.php?err=13"); // passwords nit match
                    }
                }
            }
        }

    } else {
        // echo 'email is required';
        header("Location:userlist.php?err=14"); // email is required
    }

} else {

    header('content-type:text/html;charset=uft-8'); echo "<script>url='login.php'; window.location.href=url</script>"; 

}
