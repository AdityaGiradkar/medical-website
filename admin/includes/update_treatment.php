<?php 
    if(isset($_GET['user']) && isset($_GET['treatNo'])){
        include("../../includes/db.php");
        $user_id = (int)$_GET['user'];
        $treat_id = (int)$_GET['treatNo'];
        $treatment_name = $_GET['treat_name'];

        $get_sub_treat_id = "SELECT max(`sub_treat_number`) AS maxSubId FROM `treatment` WHERE `user_id`='$user_id' AND `treat_number`='$treat_id'";
        $get_sub_treat_id_run = mysqli_query($con, $get_sub_treat_id);
        $get_sub_treat_id_res = mysqli_fetch_assoc($get_sub_treat_id_run);
        $sub_treat_id = $get_sub_treat_id_res['maxSubId'] + 1;


        $diet = $_FILES['diet'];
        $report = $_FILES['report'];
        $e_prescription = $_FILES['e-prescription'];
        $extra_note = $_POST['note'];
        $discount = (int)$_POST['dicount'];
        $courier = (int)$_POST['courier'];

        // print_r($diet);
        // print_r($report);

        //firse check if doctor has added medicines or not 
        //if not then do not run query for insertion of data into database
        $query_medicine_insert = "";
        if(isset($_POST['medicine_name'])){
            $prescribed_medi = $_POST['medicine_name'];
            $prescribed_medi_quantity = $_POST['quantityMed'];

            foreach($prescribed_medi as $key => $val){
                if($val != 0){  //check if something is selected or not
                    $Idprice = explode(',', $val);
                    //$total_medi_cost = $total_medi_cost + (float)$Idprice[1] * (float)$prescribed_medi_quantity[$key];
                    $query_medicine_insert = $query_medicine_insert."('" . $user_id ."','". $treat_id ."',". (int)$sub_treat_id ."," . (int)$Idprice[0] . "," . (int)$prescribed_medi_quantity[$key] . "),";
                }
            }
            if($query_medicine_insert != ""){ // if doctor just added rows but didn't select any medicine then also do not run query
                $query_medicine_insert = substr($query_medicine_insert, 0, -1);

                $insert_medicines = "INSERT INTO `prescribed_medicine`(`user_id`, `treat_number`, `sub_treat_number`, `medicine_id`, `quantity`) 
                                    VALUES ".$query_medicine_insert;
                $insert_medicines_run = mysqli_query($con, $insert_medicines);
            }
        }

        $query_instru_insert = "";
        if(isset($_POST['instrument_name'])){
            $prescribed_session = $_POST['instrument_name'];
            $prescribed_session_quantity = $_POST['quantityInstru'];

            foreach($prescribed_session as $key => $val){
                if($val != 0){  //check if something is selected or not
                $Idprice = explode(',', $val);
                //$total_session_cost = $total_session_cost + (float)$Idprice[1] * (float)$prescribed_session_quantity[$key];
                $query_instru_insert = $query_instru_insert."('" . $user_id ."','". $treat_id ."',". (int)$sub_treat_id ."," . (int)$Idprice[0] . "," . (int)$prescribed_session_quantity[$key] . "),";
                }
            }
            if($query_instru_insert != ""){
                $query_instru_insert = substr($query_instru_insert, 0, -1);

                $insert_instru = "INSERT INTO `prescribed_session`(`user_id`, `treat_number`, `sub_treat_number`, `session_id`, `session_per_month`)
                                VALUES ". $query_instru_insert;
                $insert_instru_run = mysqli_query($con, $insert_instru);
                
            }
        }
        
        //print_r("INSERT INTO `prescribed_medicine`(`test_id`, `treat_number`, `medicine_id`, `quantity`) 
        //           VALUES ".$query_medicine_insert);


        //$total_price = $total_medi_cost + $total_session_cost;

        $database_name_diet   = "";
        $database_name_report ="";
        $database_name_prescription ="";
        // if($diet != "" || $report != "" || $e_prescription != ""){
        if($diet != ""){
            $diet_original = $_FILES['diet']['name'];
            $diet_tmp_name = $_FILES['diet']['tmp_name'];
            $diet_error = $_FILES['diet']['error'];
            $diet_type = $_FILES['diet']['type'];

            $diet_ext_seprate = explode('.', $diet_original);
            $diet_ext = strtolower(end($diet_ext_seprate));

            if($diet_error === 0){
                $diet_new_name = uniqid('', true).".".$diet_ext;
                $diet_destination = "../files/diet/".$diet_new_name;
                $database_name_diet = "files/diet/".$diet_new_name;
                move_uploaded_file($diet_tmp_name, $diet_destination);
            }
        }

        if($report != ""){
            $report_original = $_FILES['report']['name'];
            $report_tmp_name = $_FILES['report']['tmp_name'];
            $report_error = $_FILES['report']['error'];
            $report_type = $_FILES['report']['type'];

            $report_ext_seprate = explode('.', $report_original);
            $report_ext = strtolower(end($report_ext_seprate));

            if($report_error === 0){
                $report_new_name = uniqid('', true).".".$report_ext;
                $report_destination = "../files/report/".$report_new_name;
                $database_name_report = "files/report/".$report_new_name;
                move_uploaded_file($report_tmp_name, $report_destination);  
            }
        }

        if($e_prescription != ""){
            $prescription_original = $_FILES['e-prescription']['name'];
            $prescription_tmp_name = $_FILES['e-prescription']['tmp_name'];
            $prescription_error = $_FILES['e-prescription']['error'];
            $prescription_type = $_FILES['e-prescription']['type'];

            $prescription_ext_seprate = explode('.', $prescription_original);
            $prescription_ext = strtolower(end($prescription_ext_seprate));

            if($prescription_error === 0){
                $prescription_new_name = uniqid('', true).".".$prescription_ext;
                $prescription_destination = "../files/prescription/".$prescription_new_name;
                $database_name_prescription = "files/prescription/".$prescription_new_name;
                move_uploaded_file($prescription_tmp_name, $prescription_destination);
            }
        }

        date_default_timezone_set('Asia/Kolkata');
        $date_time_store = date('Y-m-d H:i:s');
        
        // fetch bill number
        $last_bill_no = "SELECT max(`bill_number`) AS lastest FROM `bill_number`";
        $last_bill_no_run = mysqli_query($con, $last_bill_no);
        $last_bill_no_res = mysqli_fetch_assoc($last_bill_no_run);
        $lastest_bill = $last_bill_no_res['lastest'];

        $this_bill_no = $lastest_bill + 1;
        $insert_bill_no = "INSERT INTO `bill_number`(`bill_number`, `date`) VALUES ('$this_bill_no', '$date_time_store')";
        mysqli_query($con, $insert_bill_no);
          

        $insert_test ="INSERT INTO `treatment`(`user_id`, `treatment_for`, `date`, `treat_number`, `sub_treat_number`, `diet`, `report`, `extra_note`, `e_prescription`, `discount`, `courier_charge`, `bill_number`) 
                        VALUES ('$user_id', '$treatment_name', '$date_time_store', '$treat_id','$sub_treat_id','$database_name_diet','$database_name_report','$extra_note', '$database_name_prescription', '$discount', '$courier', '$this_bill_no')";         

        if(mysqli_query($con, $insert_test)) {
            echo "<script>
                        alert('Treatment updated sucessfully');
                        window.location.href='../user_details.php?uid=$user_id';
                    </script>";
        }
            
      
    }else{
        echo "<script>
                alert('Invalid Access');
                window.location.href='../../index.php';
            </script>";
    }

?>