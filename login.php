<?php 
    include('includes/db.php');
    session_start();
    if(!isset($_SESSION['user_id'])) {
    if(isset($_POST['username']) && isset($_POST['pass'])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        $qry = "SELECT * FROM `user` WHERE `user_name` = '$username' AND `password` = '$pass'";
        $run = mysqli_query($con, $qry);
        $row = mysqli_num_rows($run);
        $record = mysqli_fetch_array($run);
        if($row == 1){
            $_SESSION['user_id'] = $record['user_id'];
            if($record['role'] == 'patient'){
                header('location: index.php');
            }else if($record['role'] == 'doctor') {
                header('location: admin/index.php');
            }
        }else{
            ?>
            <script>
                alert("User id or password wrong.")
            </script>
            <?php
        }
    }

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <title>login</title>
</head>

<body>

    <div class="container">
        <div>
            <h2>Login</h2>
        </div>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
    }else{
        header('location:index.php');
    }
?>