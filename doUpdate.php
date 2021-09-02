<?php
$id = $_POST["id"];
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$age = isset($_POST["age"]) ? $_POST["age"] : "";
$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
$address = isset($_POST["address"]) ? $_POST["address"] : "";

session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty

// ---------- validate input -----------------
function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);    
    return $data;
}
// ---------- validate input -----------------

// link to datebase
include "conn.php";

if (!empty($user)) { 
    
        if ( !empty( $_POST["email"]) ) {
            if ( !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email) ) {
                header("Location:userlist.php?err=2"); // invalid email
            } else {
                if ( !preg_match("/[A-Za-z_ ]*/",$username) ) {
                    header("Location:userlist.php?err=3"); // invalid username
                }
                if ( !preg_match("/(?:[1-9][0-9]?|1[01][0-9]|120)/",$age) ) {
                    header("Location:userlist.php?err=4"); // invalid age
                }
                if ( $gender != "1" && $gender != "2" ) {
                    header("Location:userlist.php?err=5"); // invalid gender
                }

                $u_email = test_input($email);
                $u_username = test_input($username);
                $u_age = test_input($age);
                $u_gender = test_input($gender);
                $u_address = test_input($address);

                $sql = "update bbs_user set email='$u_email', username='$u_username', gender='$u_gender', age='$u_age', address='$u_address' where id=$id";
                $res = mysqli_query($link, $sql);
                
                if ($res && mysqli_affected_rows($link)) {
                    // echo 'Successfully updated! <a href="userlist.php"> Return to user list.</a>';
                    header("Location:userlist.php?err=6"); // Successfully updated
                    
                } else {
                    // echo 'Fail to update!';
                    header("Location:userlist.php?err=7"); // Fail to updated
                }                
                mysqli_close($link);

            }
            
        } else {
            header("Location:userlist.php?err=1"); // email is required
        }

} else {
    header('content-type:text/html;charset=uft-8'); echo "<script>url='login.php'; window.location.href=url</script>"; 

} 
