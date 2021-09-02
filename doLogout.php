<?php
    session_start();
    // $user = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty
    session_destroy();
    // header('Loaction:login.php');
    header('content-type:text/html;charset=uft-8'); echo "<script>url='login.php'; window.location.href=url</script>";


