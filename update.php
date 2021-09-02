<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
    <style>
        .error-message {
            font-style: italic;
            margin-bottom: 1em;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty

        // get 'id' value
        // $id = $_GET['id'];
        $id = isset($_GET['id']) ? $_GET['id'] : "";

        if (!$id) {
            header('content-type:text/html;charset=uft-8'); 
            echo "<script>url='login.php'; window.location.href=url</script>";
            // exit;

        }

        include "conn.php";

        // ------------ database operation ----------
        $sql = "select * from bbs_user where id=$id";
        $obj = mysqli_query($link, $sql);
        $rows = mysqli_fetch_assoc($obj);

        // ------------ database operation end ----------


        if ( !$obj ) {
            exit("Failed to execute sql query. error: " . mysqli_error($link));
        }

        if (!empty($user)) { ?>
            <div class="container" style="max-width: 550px">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="loginsucc.php" href="loginsucc.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userlist.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doLogout.php">Exit</a>
                    </li>
                </ul>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update</h5>
                        <p class="card-text">
                            welcome <?php echo $user; ?>!
                        </p>
                        <!-- <a href="#" class="btn btn-primary">Button</a> -->
                    </div>
                </div>
                <br>

                <div class="row justify-content-center" style="padding: 15px;">
                    <!-- <h1 class='page-header text-center'>Sign UP</h1> -->    
                    <form class="validate" action="doUpdate.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <div class="mb-3">
                            <label for="inputEmail1" class="form-label">Email address </label>
                            <input type="email" name="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="<?php echo $rows['email']; ?>" title="The domain portion of the email adress is invalid 
                        (the portion after the@)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" />
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="inputUsername" value="<?php echo $rows['username']; ?>" pattern="^[A-Za-z_ ]*$" />
                            <div class="form-text">Including letters (upper and lowercase), space and underscore.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputAge" class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" id="inputAge" value="<?php echo $rows['age']; ?>" pattern="^(?:[1-9][0-9]?|1[01][0-9]|120)$" />
                            <div class="form-text">Between 10 and 120.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputGender" class="form-label">Gender</label>
                            <input type="number" name="gender" class="form-control" id="inputGender" value="<?php echo $rows['gender']; ?>" pattern="" />
                            <div class="form-text">Female = 2. Male = 1.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="inputAddress" value="<?php echo $rows['address']; ?>" pattern="^[A-Za-z ]*$" />
                            <div class="form-text">Including letters (upper and lowercase) and space.</div>
                        </div>
                        
                        
                        <div class="text-warning">
                            <!-- Prompt information -->
                            <?php
                                $err = isset($_GET["err"]) ? $_GET["err"] : "";
                                switch ($err) {
                                    case 1:
                                        echo "email is required.";
                                        break;

                                    case 2:
                                        echo "invalid email.";
                                        break;
                                    
                                    case 3:
                                        echo "password and re_password are required.";
                                        break;
                                    case 4:
                                        echo "password invalid.";
                                        break;
                                    case 5:
                                        echo "passwords do not match.";
                                        break;
                                    case 6:
                                        echo "user already exists.";
                                        break;
                                    case 7:
                                        echo "registration success.";
                                        break;
                                }
                            ?>
                        </div>
                        <br>
                        <div class="d-grid gap-2">
                            <button class="btn btn-info" type="submit">Update</button>
                        </div>
                        <br>
                        <p>All correct? <a href="userlist.php">Return</a></p>    

                    </form>    
                </div>


            </div>    
        <?php 
        } else {
            ?>
            <?php header('Loaction:login.php'); ?>
        <?php
        } ?>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/inputValidation.js"></script>
</body>
</html>