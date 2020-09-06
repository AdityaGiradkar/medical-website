<?php 
    include('includes/db.php');
    session_start();
    if(!isset($_SESSION['user_id'])) {
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $pass = mysqli_real_escape_string($con, $_POST['pass']);
            $qry = "SELECT * FROM `user` WHERE `email_id` = '$email' AND `password` = '$pass'";
            $run = mysqli_query($con, $qry);
            $row = mysqli_num_rows($run);
            $record = mysqli_fetch_array($run);
            
            if($row == 1){
                if($record['verified'] == 1){
                    //account is verified procced further
                    $_SESSION['user_id'] = $record['user_id'];
                    $_SESSION['name'] = $record['name'];
                    $_SESSION['email'] = $record['email_id'];
                    if($record['role'] == 'patient'){
                        header('location: index.php');
                    }else if($record['role'] == 'doctor') {
                        header('location: admin/index.php');
                    }
                }else{
                    //account is not verified
                    ?>
                        <script>
                            alert("Email is not verified please verify first. verification mail is sent on <?php echo date("d/m/Y", strtotime($record['creation_date'])); ?>");
                        </script>
                    <?php
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- Custom External StyleSheet -->
    <link rel="stylesheet" href="css/login.css">

    <title>Login</title>
</head>

<body>

    <div class="overlay">
        <div class="card centered" style="width: 25rem;">
            <div class="card-body">
                <img src="images/AtmaVeda Logo.png" class="mx-auto d-block" alt="AtmaVeda Logo" />
                <p class="card-title mx-auto brand-name">AtmaVeda Yog</p>
                <form method="post" action="">
                    <div class="form-group mt-5 mb-4">
                        <!-- <label for="exampleInputEmail1">Username</label> -->
                        <input type="text" class="form-control input-box" placeholder="Username or Email" name="email"
                            id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <!-- <label for="exampleInputPassword1">Password</label> -->
                        <input type="password" class="form-control input-box" placeholder="Password" name="pass"
                            id="exampleInputPassword1">
                    </div>
                    <a href="#"><small class="form-text text-muted text-right"><em>Forget Password ?</em></small></a>
                    <button type="submit" class="login-btn mt-5" name="submit">LOGIN</button>
                </form>
                <small class="form-text text-center mt-5"><em>Not an existing user ?</em> <a href="register.php">Create
                        New</a></small>
            </div>
        </div>
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