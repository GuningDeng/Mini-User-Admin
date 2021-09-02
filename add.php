<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add</title>
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
        $gender = "";
        session_start();
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty
        
        // if logged in
        if (!empty($user)) { ?>
            <div class="container">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="userlist.php" href="loginsucc.php">Home</a>
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
                        <h5 class="card-title">Add an new user</h5>
                        <p class="card-text">
                            Welcome <b><?php echo $user; ?></b>!
                        </p>
                    </div>
                </div>
                <br>

                <div class="row justify-content-center" style="padding: 15px;">    
                    <p>* Required.</p>    
                    <form class="validate" action="doAdd.php" method="POST">
                        <div class="mb-3">
                            <label for="inputEmail1" class="form-label">Email address *</label>
                            <input type="email" name="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="" title="The domain portion of the email adress is invalid 
                        (the portion after the@)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required />
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword1" class="form-label">Password *</label>
                            <input type="password" name="password" class="form-control" id="inputPassword1" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,20}$" required />
                            <div class="form-text">The password must have at least 8 letters, including numbers, letters (upper and lower case), characters and symbols.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword2" class="form-label">Repeat password *</label>
                            <input type="password" name="re_password" class="form-control" id="inputPassword2" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,20}$" required />
                            <div class="form-text">The password must have at least 8 letters, including numbers, letters (upper and lower case), characters and symbols.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="inputUsername" value="" pattern="^[A-Za-z_ ]*$" />
                            <div class="form-text">Including letters (upper and lowercase), space and underscore.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputAge" class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" id="inputAge" value="" pattern="" />
                            <div class="form-text">Between 10 and 120.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="inputAddresss" value="" pattern="^[a-zA-Z ]*$" />
                            <div class="form-text">Including letters (upper and lowercase), space and number.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputGender" class="form-label">Gender</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="2" <?php if ( isset($gender) && $gender == "female" ) echo "checked" ?> />
                            <label class="form-check-label" for="flexRadioDefault1">
                                Female
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="1" <?php if ( isset($gender) && $gender == "male" ) echo "checked" ?> />
                            <label class="form-check-label" for="flexRadioDefault2">
                                Male
                            </label>
                        </div>
                        
                        <div class="text-warning">
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
                            <button class="btn btn-info" type="submit">Add</button>
                        </div>
                        <br>
                        <p>Do not add new users? <a href="userlist.php">Return</a></p>    

                    </form>    
                </div>
            </div>    
        <?php 
        } else {
            ?>
            <?php header('content-type:text/html;charset=uft-8'); echo "<script>url='login.php'; window.location.href=url</script>"; ?>
        <?php
        } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/inputValidation.js"></script>

</body>
</html>


