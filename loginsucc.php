<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Log in successfully</title>
</head>
<body>
    <?php
        session_start();
        $username = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty

        $path = $_SERVER['PHP_SELF']; 
        $pageName = explode('/',$path)[3];

        if (!empty($username)) { ?>
            <div class="container">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"><b>Home</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userlist.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doLogout.php">Exit</a>
                    </li>
                </ul>

                <div class="card w-85">
                    <div class="card-body">
                        <h5 class="card-title">Log in successfully!</h5>
                        <p class="card-text">
                            welcome <b><?php echo $username; ?></b>!
                        </p>
                        <?php 
                            echo $pageName;
                        ?>
                        <!-- <a href="#" class="btn btn-primary">Button</a> -->
                    </div>
                </div>

            </div>
            
        <?php 
        } else {
            ?>
            <?php header('content-type:text/html;charset=uft-8'); echo "<script>url='login.php'; window.location.href=url</script>"; ?>
        <?php
        } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>