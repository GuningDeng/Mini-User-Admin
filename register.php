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
        .container-login{
            max-width: 550px; 
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container container-login">
        <div class="row justify-content-center" style="padding: 15px;">
            <h1 class='page-header text-center'>Sign UP</h1>
            <p>* Required.</p>    
            <form class="validate" action="doRegister_1.php" method="POST">
                <div class="mb-3">
                    <label for="inputEmail1" class="form-label">Email address *</label>
                    <input type="email" name="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" title="The domain portion of the email adress is invalid 
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
                    <button class="btn btn-info" type="submit">Sign up</button>
                </div>
                <br>
                <p>Already have an account? <a href="login.php">Log in</a></p>    
    
            </form>    
        </div>
    </div>    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/inputValidation.js"></script>
</body>
</html>