<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Log in</title>
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
    <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);    
            return $data;
        }
    ?>

    <div class="container container-login">
        <div class="row justify-content-center">
                <h2 class='page-header text-center'>Log In</h2>    
                <form action="doLogin.php" method="POST" class="validate">
                    <div class="mb-3">
                        <label for="inputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" title="The domain portion of the email adress is invalid 
                    (the portion after the@)." pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required />
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,}$" required />
                    </div>
                    <br>    
                    <div class="d-grid gap-2">
                        <button class="btn btn-info" id="loginBtn" type="submit">Log in</button>
                    </div>
                    <br>
                    <p>No account? Create one! <a href="register.php">Sign up</a></p>    
                    
                    <div class="text-warning">
                        <!-- Prompt information -->
                        <?php
                            $err = isset($_GET["err"]) ? $_GET["err"] : "";
                            switch ($err) {
                                case 1:
                                    echo "<br>E-mail & password are invalid.";
                                    break;
    
                                case 2:
                                    echo "<br>Username and password connot be empty.";
                                    break;                                
                            }
                        ?>
                    </div>    
                </form>
            </div>
        </div>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/inputValidation.js"></script>
</body>
</html>