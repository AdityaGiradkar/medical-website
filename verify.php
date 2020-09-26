<?php 
    include("includes/db.php");
    if(isset($_GET['vkey'])){
        //process verification
        $vkey = mysqli_real_escape_string($con, $_GET['vkey']);
        $search_for_account = "SELECT `vkey`, `verified` FROM `user` WHERE `vkey`='$vkey' AND `verified`=0 LIMIT 1";
        $search_for_account = mysqli_query($con, $search_for_account);
        $row = mysqli_num_rows($search_for_account);
        if($row == 1){
            $update_verification = "UPDATE `user` SET `verified`=1,`vkey`='0' WHERE `vkey`='$vkey' LIMIT 1";
            if(mysqli_query($con, $update_verification)){
                echo "Account verified sucessfully. Go back to home page <a href='index.php'>click here</a>";
            }
        } else {
            echo "<script> 
                    alert('This account is Invalid or already verified.');
                    window.location.href='index.php';
                </script>";
        }
    }else{
        die("something went worng");
    }

?>