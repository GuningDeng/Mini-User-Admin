<?php
// get 'id' value
$id = $_GET['id'];
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty

// ---------- validate input -----------------
function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);    
    return $data;
}

if ( !empty($user) ) {
    $u_id = test_input($id);
    $link = mysqli_connect('localhost', 'root');
    if (!$link) {
        exit('Faild to connect to database!');
    }

    mysqli_set_charset($link, 'utf8');
    mysqli_select_db($link, 'bbs');

    $sql = "delete from bbs_user where id=$u_id";
    $boolean = mysqli_query($link, $sql);

    if ($boolean && mysqli_affected_rows($link)) {
        echo 'Successfully deleted!<a href="userlist.php">returnto user list</a>';
    } else {
        echo 'Faild to delete!';
    }

    mysqli_close($link);

} else {
    header('content-type:text/html;charset=uft-8'); echo "<script>url='login.php'; window.location.href=url</script>"; 
}
