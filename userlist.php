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
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : ""; // or 'session' is empty

        include "conn.php";

        $page = empty($_GET['page']) ? 1 : $_GET['page'];

        // ------------pagination start----------
        // totaal list
        $sql = "SELECT COUNT(*) AS count FROM bbs_user";
        $result = mysqli_query($link, $sql);
        $paggeRes = mysqli_fetch_assoc($result);
        $count = $paggeRes['count'];
        // 5 lists per page
        $num = 5;
        // totaal page's
        $pageCount = ceil($count/$num);
        $offset = ($page - 1) * $num;
        // ------------pagination end----------
        $sql = "select * from bbs_user limit " . $offset . ',' . $num;
        $obj = mysqli_query($link, $sql);
        if ( !$obj ) {
            exit("Failed to execute sql query. error: " . mysqli_error($link));
        }
        if (!empty($user)) { ?>
            <div class="container">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="loginsucc.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="userlist.php"><b>Users</b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doLogout.php">Exit</a>
                    </li>
                </ul>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users list</h5>
                        <p class="card-text">
                            welcome <b><?php echo $user; ?></b>!
                        </p>
                    </div>
                </div>
                <br>
                <table class="table">
                    <a href="add.php" class="btn btn-outline-primary">Add a user</a>
                    <thead>
                        <tr>
                        <th scope="col">id</th>
                        <th scope="col">User name</th>
                        <th scope="col">email</th>
                        <!-- <th scope="col">Password</th> -->
                        <th scope="col">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age</th>
                        <th scope="col">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ( $rows = mysqli_fetch_assoc($obj) ) {
                                echo '<tr>';
                                    echo '<td>' . $rows['id'] . '</td>';
                                    echo '<td>' . $rows['username'] . '</td>';
                                    echo '<td>' . $rows['email'] . '</td>';
                                    // echo '<td>' . $rows['password'] . '</td>';
                                    echo '<td>' . $rows['address'] . '</td>';
                                    echo '<td>' . ($rows['gender']==1 ? 'male' : 'female') . '</td>';
                                    echo '<td>' . $rows['age'] . '</td>';
                                    echo '<td><a href="delete.php?id=' . $rows['id'] . '">Delete</a>/<a href="update.php?id=' . $rows['id'] . '">Update</a></td>';
                                echo '</tr>';
                            }
                            $prev = $page - 1;
                            $next = $page + 1;
                            if ($prev < 1) {
                                $prev = 1;
                            }
                            if ($next > $pageCount) {
                                $next = $pageCount;
                            }
                            mysqli_close($link);
                        ?>
                    </tbody>
                </table>
                <!-- pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                        <a class="page-link" href="userlist.php?page=<?=$prev ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>
                        <?php 
                            for ($i=1; $i<=$pageCount; $i++) {
                                if ($page==$i) {
                                    echo   '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="userlist.php?page='.$i.'">' . $i . '</a></li>'; 
                                }
                            }
                            
                        ?>
                        <li class="page-item">
                        <a class="page-link" href="userlist.php?page=<?=$next ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>
                    </ul>
                </nav>
                <!-- pagination -->
                <br>
                <br>
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
                                echo "invalid username.";
                                break;
                            case 4:
                                echo "age invalid.";
                                break;
                            case 5:
                                echo "gender invalid.";
                                break;
                            case 6:
                                echo "Successfully updated!";
                                break;
                            case 7:
                                echo "Fail to update!";
                                break;
                            case 8:
                                echo "Passwords are required.";
                                break;
                            case 9:
                                echo "password invalid.";
                                break;
                            case 10:
                                echo "User already exists.";
                                break;
                            case 11:
                                echo "Successfully added!";
                                break;
                            case 12:
                                echo "Failed to add!";
                                break;
                            case 13:
                                echo "passwords nit match.";
                                break;
                            case 14:
                                echo "email is required";
                                break;
                        }
                    ?>
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