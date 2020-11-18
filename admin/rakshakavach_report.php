<?php 
    include("../includes/db.php");
    session_start();

    //checking if user logged in 
    //if session is set means user logged in then show this page otherwise redirect to login page
    if(isset($_SESSION['user_id'])){
        $pay_id = $_GET['pay_id'];
        $payment_details = "SELECT * FROM `test_payments` WHERE `pay_id`='$pay_id' AND `test_id` IS NOT NULL";
        $payment_details_run = mysqli_query($con, $payment_details);
        $payment_details_rows = mysqli_num_rows($payment_details_run);

        //checking if user present for perticular
        //if not then redirect to user page
        if($payment_details_rows > 0){
            $record = mysqli_fetch_assoc($payment_details_run);
            $user_id = $record['user_id'];
            $test_id = $record['test_id'];

            $user_info = "SELECT *, TIMESTAMPDIFF(YEAR, `dob`, CURDATE()) AS age FROM `user` WHERE `user_id`='$user_id'";
            $user_info_run = mysqli_query($con, $user_info);
            $user_detail = mysqli_fetch_assoc($user_info_run);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap-4.5.2-dist/css/bootstrap.min.css">

    <!-- fontawesome link-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

     <!-- Custom css File -->
    <link rel="stylesheet" href="../css/index.css">

    <title>REPORT-<?php echo $user_detail['name']; ?></title>

</head>
<body>
    <div class="container pt-3">
        <!-- &larr; <a onClick="javascript: window.close()" href="test_submissions.php" >Close Receipt</a>    -->
        <input type="button" class="btn btn-sm mt-3 btn-primary d-flex ml-auto" onclick="printDiv('printableArea')" value="Print Report" />   
    </div>
    <?php
        $test_details = "SELECT * FROM `test_rakshakavach` WHERE `test_id`='$test_id'";
        $test_details_run = mysqli_query($con, $test_details);
        $test_details_res = mysqli_fetch_assoc($test_details_run);

        $answer_value_count = array('right'=>0, 'ap'=>0, 'left'=>0, 'an'=>0, 'pr'=>0, 'sa'=>0, 'vy'=>0, 'ud'=>0, 'ma'=>0, 'sw'=>0, 'vi'=>0, 'mu'=>0, 're'=>0, 'st'=>0, 'de'=>0, 'ax'=>0, 'lo'=>0, 'ts'=>0, 'kf'=>0, 'vt'=>0, 'pt'=>0, 'pi'=>0, 'id'=>0, 'sm'=>0, 'fe'=>0);       
        // print_r($answer_value_count);

        // loop through each question
        for($i=1; $i<26; $i++){
            $col_name = "test".$i;
            $test[$i] = unserialize($test_details_res[$col_name]);

            //for question 7 special case 
            if($i == 7){
                $pr = 0;
                $ap = 0;
                $test7 = [['right side','pr','1'], ['left side', 'pr', '1'], ['right side','pr','2'], ['left side', 'pr', '2'], ['right side','ap','3'], ['left side', 'ap', '3']];
                if($test[7] != ""){
                    foreach($test[7] as $seventh){
                        $seventh--;
                        if($test7[$seventh][2] == '1' || $test7[$seventh][2] == '2'){
                            $pr++;
                        }else if($test7[$seventh][2] == 3){
                            $ap++;
                        }
                    }
                }

                //taking value for question 7 which is not selected
                if(array_key_exists('pr', $answer_value_count)){
                    $answer_value_count['pr'] = $answer_value_count['pr'] + (4 - $pr);
                }else{
                    $answer_value_count['pr'] = 4 - $pr;
                }

                if(array_key_exists('ap', $answer_value_count)){
                    $answer_value_count['ap'] = $answer_value_count['ap'] + (2 - $ap);
                }else{
                    $answer_value_count['ap'] = 2 - $ap;
                }
                //print_r($test7);
                // print_r($answer_value_count);
            }

            if($i !== 7){
                $count = 0;

                //loop through each selected option of perticular question
                foreach($test[$i] as $single_option){
                    // remove brackets 1st and last(substr)
                    // then split remaning string between each comma and add to an array 
                    $test[$i][$count] = explode(',', substr($single_option, 1, -1));

                    //loop through each value of perticular option of perticular question
                    $singleValue = 0;
                    foreach($test[$i][$count] as $single_val){
                        $test[$i][$count][$singleValue] = substr($single_val, 1, -1);

                        if($singleValue != 0){      //ignoring 1st as it is actual ans 
                            $val = $test[$i][$count][$singleValue];     //$val contain code like pr, ap, lo, etc
                            
                            if(array_key_exists($val, $answer_value_count)){
                                $answer_value_count[$val]++; 
                            }else{
                                $answer_value_count[$val] = 1;
                            }
                        }
                        $singleValue++;
                    }
                    $count++;
                }
            }

                
        }
        // print("<pre>".print_r($test)."</pre>");
        // print("<pre>".print_r($test,true)."</pre>");
        print("<pre>".print_r($answer_value_count,true)."</pre>");
        // $myArray = explode(',', substr($test[1][0], 1, -1));
        // print_r($myArray);


        //loop through each answer value count 
        $preliminary_inference_chart = array('right'=>0, 'ap'=>0, 'left'=>0, 'an'=>0, 'pr'=>0, 'sa'=>0, 'vy'=>0, 'ud'=>0, 'ma'=>0, 'sw'=>0, 'vi'=>0, 'mu'=>0, 're'=>0, 'st'=>0, 'de'=>0, 'ax'=>0, 'lo'=>0, 'ts'=>0, 'kf'=>0, 'vt'=>0, 'pt'=>0, 'pi'=>0, 'id'=>0, 'sm'=>0, 'fe'=>0);
        
        //for lungs(pr)
        if($answer_value_count['pr'] >= 0 && $answer_value_count['pr'] <= 2){
            $preliminary_inference_chart['pr'] = "NO DOSHA";
        }else if($answer_value_count['pr'] >= 3 && $answer_value_count['pr'] <= 4){
            $preliminary_inference_chart['pr'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['pr'] >= 5 && $answer_value_count['pr'] <= 7){
            $preliminary_inference_chart['pr'] = "FUNCTIONAL";
        }else if($answer_value_count['pr'] >= 8 && $answer_value_count['pr'] <= 11){
            $preliminary_inference_chart['pr'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['pr'] >= 12 && $answer_value_count['pr'] <= 16){
            $preliminary_inference_chart['pr'] = "PATHOLOGICAL";
        }

        //for MUSCULOSKELETAL(vy)
        if($answer_value_count['vy'] >= 0 && $answer_value_count['vy'] <= 2){
            $preliminary_inference_chart['vy'] = "NO DOSHA";
        }else if($answer_value_count['vy'] >= 3 && $answer_value_count['vy'] <= 5){
            $preliminary_inference_chart['vy'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['vy'] >= 6 && $answer_value_count['vy'] <= 8){
            $preliminary_inference_chart['vy'] = "FUNCTIONAL";
        }else if($answer_value_count['vy'] >= 9 && $answer_value_count['vy'] <= 10){
            $preliminary_inference_chart['vy'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['vy'] >= 11 && $answer_value_count['vy'] <= 13){
            $preliminary_inference_chart['vy'] = "PATHOLOGICAL";
        }

        //for HEAD SINUSES (ud)
        if($answer_value_count['ud'] == 0){
            $preliminary_inference_chart['ud'] = "NO DOSHA";
        }else if($answer_value_count['ud'] >= 1 && $answer_value_count['ud'] <= 2){
            $preliminary_inference_chart['ud'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['ud'] >= 3 && $answer_value_count['ud'] <= 4){
            $preliminary_inference_chart['ud'] = "FUNCTIONAL";
        }else if($answer_value_count['ud'] >= 5 && $answer_value_count['ud'] <= 7){
            $preliminary_inference_chart['ud'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['ud'] >= 8 && $answer_value_count['ud'] <= 9){
            $preliminary_inference_chart['ud'] = "PATHOLOGICAL";
        }

        //for HEART(an)
        if($answer_value_count['an'] >= 0 && $answer_value_count['an'] <= 1){
            $preliminary_inference_chart['an'] = "NO DOSHA";
        }else if($answer_value_count['an'] == 2){
            $preliminary_inference_chart['an'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['an'] >= 3 && $answer_value_count['an'] <= 4){
            $preliminary_inference_chart['an'] = "FUNCTIONAL";
        }else if($answer_value_count['an'] >= 5 && $answer_value_count['an'] <= 6){
            $preliminary_inference_chart['an'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['an'] >= 7 && $answer_value_count['an'] <= 8){
            $preliminary_inference_chart['an'] = "PATHOLOGICAL";
        }

        //for SMALL INTESTINE(ma)
        if($answer_value_count['ma'] >= 0 && $answer_value_count['ma'] <= 1){
            $preliminary_inference_chart['ma'] = "NO DOSHA";
        }else if($answer_value_count['ma'] >= 2 && $answer_value_count['ma'] <= 3){
            $preliminary_inference_chart['ma'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['ma'] == 4){
            $preliminary_inference_chart['ma'] = "FUNCTIONAL";
        }else if($answer_value_count['ma'] == 5){
            $preliminary_inference_chart['ma'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['ma'] >= 6 && $answer_value_count['ma'] <= 7){
            $preliminary_inference_chart['ma'] = "PATHOLOGICAL";
        }

        

        //for STOMACH LIVER GB(ap)
        if($answer_value_count['ap'] >= 0 && $answer_value_count['ap'] <= 2){
            $preliminary_inference_chart['ap'] = "NO DOSHA";
        }else if($answer_value_count['ap'] >= 3 && $answer_value_count['ap'] <= 5){
            $preliminary_inference_chart['ap'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['ap'] >= 6 && $answer_value_count['ap'] <= 9){
            $preliminary_inference_chart['ap'] = "FUNCTIONAL";
        }else if($answer_value_count['ap'] >= 10 && $answer_value_count['ap'] <= 12){
            $preliminary_inference_chart['ap'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['ap'] >= 13 && $answer_value_count['ap'] <= 17){
            $preliminary_inference_chart['ap'] = "PATHOLOGICAL";
        }

        //for COLON  (sw)
        if($answer_value_count['sw'] == 0){
            $preliminary_inference_chart['sw'] = "NO DOSHA";
        }else if($answer_value_count['sw'] >= 1 && $answer_value_count['sw'] <= 2){
            $preliminary_inference_chart['sw'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['sw'] >= 3 && $answer_value_count['sw'] <= 4){
            $preliminary_inference_chart['sw'] = "FUNCTIONAL";
        }else if($answer_value_count['sw'] >= 5 && $answer_value_count['sw'] <= 7){
            $preliminary_inference_chart['sw'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['sw'] >= 8 && $answer_value_count['sw'] <= 11){
            $preliminary_inference_chart['sw'] = "PATHOLOGICAL";
        }

        //for THORAT HORMONE(vi)	
        if($answer_value_count['vi'] == 0){
            $preliminary_inference_chart['vi'] = "NO DOSHA";
        }else if($answer_value_count['vi'] == 1){
            $preliminary_inference_chart['vi'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['vi'] == 2){
            $preliminary_inference_chart['vi'] = "FUNCTIONAL";
        }else if($answer_value_count['vi'] == 3){
            $preliminary_inference_chart['vi'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['vi'] == 4){
            $preliminary_inference_chart['vi'] = "PATHOLOGICAL";
        }

        //for CIRCULATION(sa)
        if($answer_value_count['sa'] >= 0 && $answer_value_count['sa'] <= 1){
            $preliminary_inference_chart['sa'] = "NO DOSHA";
        }else if($answer_value_count['sa'] >= 2 && $answer_value_count['sa'] <= 4){
            $preliminary_inference_chart['sa'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['sa'] >= 5 && $answer_value_count['sa'] <= 8){
            $preliminary_inference_chart['sa'] = "FUNCTIONAL";
        }else if($answer_value_count['sa'] >= 9 && $answer_value_count['sa'] <= 11){
            $preliminary_inference_chart['sa'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['sa'] >= 12 && $answer_value_count['sa'] <= 14){
            $preliminary_inference_chart['sa'] = "PATHOLOGICAL";
        }

        //for PELVIS(mu)
        if($answer_value_count['mu'] == 0){
            $preliminary_inference_chart['mu'] = "NO DOSHA";
        }else if($answer_value_count['mu'] >= 1 && $answer_value_count['mu'] <= 3){
            $preliminary_inference_chart['mu'] = "PRE-FUNCTIONAL";
        }else if($answer_value_count['mu'] >= 4 && $answer_value_count['mu'] <= 6){
            $preliminary_inference_chart['mu'] = "FUNCTIONAL";
        }else if($answer_value_count['mu'] >= 7 && $answer_value_count['mu'] <= 8){
            $preliminary_inference_chart['mu'] = "PRE-PATHOLOGICAL";
        }else if($answer_value_count['mu'] >= 9 && $answer_value_count['mu'] <= 10){
            $preliminary_inference_chart['mu'] = "PATHOLOGICAL";
        }

        // for STRESS(st)
        if($answer_value_count['st'] >= 0 && $answer_value_count['st'] <= 1){
            $preliminary_inference_chart['st'] = "NO";
        }else if($answer_value_count['st'] >= 2 && $answer_value_count['st'] <= 4){
            $preliminary_inference_chart['st'] = "MILD";
        }else if($answer_value_count['st'] >= 5 && $answer_value_count['st'] <= 6){
            $preliminary_inference_chart['st'] = "NEURASTHENIA";
        }else if($answer_value_count['st'] >= 7 && $answer_value_count['st'] <= 8){
            $preliminary_inference_chart['st'] = "SOMATIC EFFECT";
        }

        //for DEPRESSION(de)
        if($answer_value_count['de'] == 0){
            $preliminary_inference_chart['de'] = "NO";
        }else if($answer_value_count['de'] >= 1 && $answer_value_count['de'] <= 2){
            $preliminary_inference_chart['de'] = "MILD";
        }else if($answer_value_count['de'] >= 3 && $answer_value_count['de'] <= 4){
            $preliminary_inference_chart['de'] = "NEURASTHENIA";
        }else if($answer_value_count['de'] >= 5 && $answer_value_count['de'] <= 6){
            $preliminary_inference_chart['de'] = "SOMATIC EFFECT";
        }

        //for ANXIETY(ax)
        if($answer_value_count['ax'] == 0){
            $preliminary_inference_chart['ax'] = "NO";
        }else if($answer_value_count['ax'] >= 1 && $answer_value_count['ax'] <= 2){
            $preliminary_inference_chart['ax'] = "MILD";
        }else if($answer_value_count['ax'] == 3){
            $preliminary_inference_chart['ax'] = "NEURASTHENIA";
        }else if($answer_value_count['ax'] == 4){
            $preliminary_inference_chart['ax'] = "SOMATIC EFFECT";
        }

        //for RELAXED(re)
        if($answer_value_count['re'] >= 0 && $answer_value_count['re'] <= 7){
            $preliminary_inference_chart['re'] = "YES. BALANCED";
        }else if($answer_value_count['re'] >= 8 && $answer_value_count['re'] <= 14){
            $preliminary_inference_chart['re'] = "YES. COMFORTABLE";
        }

        //for METABOLISM(lo)
        if($answer_value_count['lo'] == 1){
            $preliminary_inference_chart['lo'] = "DOSHA";
        }else if($answer_value_count['lo'] == 2){
            $preliminary_inference_chart['lo'] = "AGNI DOSHA";
        }

        print_r($preliminary_inference_chart);

        //2nd table
        $health_status = array('PRE-FUNCTIONAL'=>0, 'FUNCTIONAL'=>0, 'PRE-PATHOLOGICAL'=>0, 'PATHOLOGICAL'=>0);
        //$lung_to_pelvis_code = ['pr', 'vy', 'ud', 'an', 'ma', 'ap', 'sw', 'vi', 'sa', 'mu'];
        //print_r($health_status);
        foreach($preliminary_inference_chart as $val){
            if(array_key_exists($val, $health_status)){
                $health_status[$val]++;
            }
        }

        print_r($health_status);
        //condition for table values
        //condition for healthy column
        if($health_status['FUNCTIONAL'] == 0 && $health_status['PRE-PATHOLOGICAL'] == 0 && $health_status['PATHOLOGICAL'] == 0){
            $healthy = 'YES';
        }else{
            $healthy = 'NO';
        }

        //condition for hralth alert column
        if($health_status['PRE-FUNCTIONAL'] >= 6 && $health_status['FUNCTIONAL'] >= 1 && $health_status['PRE-PATHOLOGICAL'] >= 1 && $health_status['PATHOLOGICAL'] >= 1){
            $health_alert = 'YES';
        }else{
            $health_alert = 'NO';
        }

        //condition for health risk column
        if($health_status['FUNCTIONAL'] >= 5 && $health_status['PRE-PATHOLOGICAL'] >= 1 && $health_status['PATHOLOGICAL'] >= 1){
            $health_risk = 'YES';
        }else{
            $health_risk = 'NO';
        }

        //condition for high risk column
        if($health_status['PRE-PATHOLOGICAL'] >= 2 && $health_status['PATHOLOGICAL'] >= 1){
            $high_risk = 'YES';
        }else{
            $high_risk = 'NO';
        }
        //print_r($health_status);


        //3rd table
        //metabolism(lo)
        if($answer_value_count['lo'] == 0){
            $metabolism = 'NO DOSHA';
        }else if($answer_value_count['lo'] == 1){
            $metabolism = 'DOSHA';
        }else if($answer_value_count['lo'] == 2){
            $metabolism = 'AGNI DOSHA';
        }


        //4th table
        //Stress, depression, anxiety, relaxed
        /************* See above ***********/


        //5th table
        //	Annamaya Kosha, Manomaya Kosha, Pranamanya Kosha
        //	Annamaya Kosha
        if($health_status['PRE-FUNCTIONAL'] == 0 && $health_status['FUNCTIONAL'] == 0 && $health_status['PRE-PATHOLOGICAL'] == 0 && $health_status['PATHOLOGICAL'] == 0){
            $annamaya_kosha = "NO DOSHA";
        }else if($health_status['PRE-PATHOLOGICAL'] == 0 && $health_status['PATHOLOGICAL'] == 0){
            $annamaya_kosha = "SAUMYA DOSHA";
        }else if($health_status['PRE-PATHOLOGICAL'] >= 1 && $health_status['PRE-PATHOLOGICAL'] <= 3 && $health_status['PATHOLOGICAL'] <= 1){
            $annamaya_kosha = "MADHYAM DOSHA";
        }else if($health_status['PRE-PATHOLOGICAL'] >= 4 || $health_status['PATHOLOGICAL'] >= 2){
            $annamaya_kosha = "TIVRA DOSHA";
        }

        //Manomaya kosha
        if($preliminary_inference_chart['ax'] == 'NO' && $preliminary_inference_chart['de'] == 'NO' && $preliminary_inference_chart['st'] == 'NO'){
            $manomaya_kosha = "NO DOSHA";
        }else if(($preliminary_inference_chart['ax'] == 'MILD' || $preliminary_inference_chart['ax'] == 'NEURASTHENIA') && ($preliminary_inference_chart['de'] == 'MILD' || $preliminary_inference_chart['de'] == 'NEURASTHENIA') && ($preliminary_inference_chart['st'] == 'MILD' || $preliminary_inference_chart['st'] == 'NEURASTHENIA')){
            $manomaya_kosha = "MADHYAM DOSHA";
        }else if($preliminary_inference_chart['ax'] == 'SOMATIC EFFECT' || $preliminary_inference_chart['de'] == 'SOMATIC EFFECT' || $preliminary_inference_chart['st'] == 'SOMATIC EFFECT'){
            $manomaya_kosha  = "TIVRA DOSHA";
        }

        //Pranamaya kosha 
        if($preliminary_inference_chart['pr'] == 'NO DOSHA'){
            $pranamaya_kosha = 'NO DOSHA' ;
        }else if($preliminary_inference_chart['pr'] == 'PRE-FUNCTIONAL' || $preliminary_inference_chart['pr'] == 'FUNCTIONAL'){
            $pranamaya_kosha = 'SOUMYA DOSHA';
        }else if($preliminary_inference_chart['pr'] == 'PRE-PATHOLOGICAL'){
            $pranamaya_kosha = 'MADHYAM DOSHA';
        }else if($preliminary_inference_chart['pr'] == 'PATHOLOGICAL'){
            $pranamaya_kosha = 'TIVRA DOSHA';
        }

        //6th table
        //Strength of Raksha Kavach
        if($healthy == 'YES' || $health_alert == 'YES'){
            $strong_raksha_kavach = 'YES';     
        }else{
            $strong_raksha_kavach = 'NO';
        }

        if($high_risk == 'YES'){
            $moderate_raksha_kavach = 'YES';
        }else{
            $moderate_raksha_kavach = 'NO';
        }

        if($high_risk == 'YES'){
            $weak_raksha_kavach = 'YES';
        }else{
            $weak_raksha_kavach = 'NO';
        }

        //7th table
        //Possibility of COVID risk 
        if($preliminary_inference_chart['pr'] == 'PATHOLOGICAL'){
            if($preliminary_inference_chart['ud'] == 'PATHOLOGICAL' && ($preliminary_inference_chart['vy'] == 'PATHOLOGICAL' || $preliminary_inference_chart['vy'] == 'PRE-PATHOLOGICAL') && $answer_value_count['fe'] == 3 && $answer_value_count['sm'] == 1){
                $covid_risk = "HIGH";
            }else if(($preliminary_inference_chart['ud'] == 'FUNCTIONAL' || $preliminary_inference_chart['ud'] == 'PATHOLOGICAL' || $preliminary_inference_chart['ud'] == 'PRE-PATHOLOGICAL') && $answer_value_count['fe'] == 1){
                $covid_risk = "MODERATE";
            }else if($answer_value_count['fe'] == 1){
                $covid_risk = "LOW";
            }
        }

        //Healthy Immune Warrior, Susceptible, Carrier, Active (Super Spreader) 
        if($health_risk == 'NO' && $high_risk == 'NO'){
            $healthy_immune_warrior = 'YES'; 
        }else{
            $healthy_immune_warrior = 'NO';
        }

        //Susceptible
        $sucess_count = 0;
        if($preliminary_inference_chart['pr'] == 'PATHOLOGICAL' || $preliminary_inference_chart['pr'] == 'PRE-PATHOLOGICAL'){
            $sucess_count++;
        }
        if($preliminary_inference_chart['vy'] == 'PATHOLOGICAL' || $preliminary_inference_chart['vy'] == 'PRE-PATHOLOGICAL'){
            $sucess_count++;
        }
        if($preliminary_inference_chart['ud'] == 'PATHOLOGICAL' || $preliminary_inference_chart['ud'] == 'PRE-PATHOLOGICAL'){
            $sucess_count++;
        }
        if($sucess_count >= 2){
            $susceptible = 'YES';
        }else{
            $susceptible = 'NO';
        }

        //Carrier
        $sucess_count = 0;
        if($preliminary_inference_chart['ud'] == 'FUNCTIONAL' || $preliminary_inference_chart['ud'] == 'PATHOLOGICAL' || $preliminary_inference_chart['ud'] == 'PRE-PATHOLOGICAL'){
            $sucess_count++;
        }
        if($preliminary_inference_chart['ap'] == 'PATHOLOGICAL' || $preliminary_inference_chart['ap'] == 'PRE-PATHOLOGICAL'){
            $sucess_count++;
        }
        if($answer_value_count['sm'] == 1){
            $sucess_count++;
        }

        if($answer_value_count['ts'] == 1 || $answer_value_count['fe'] > 0){
            $sucess_count++;
        }
        if($preliminary_inference_chart['pr'] == 'FUNCTIONAL' || $preliminary_inference_chart['pr'] == 'PATHOLOGICAL' || $preliminary_inference_chart['pr'] == 'PRE-PATHOLOGICAL'){
            $sucess_count++;
        }
        if($preliminary_inference_chart['vy'] == 'FUNCTIONAL' || $preliminary_inference_chart['vy'] == 'PATHOLOGICAL' || $preliminary_inference_chart['vy'] == 'PRE-PATHOLOGICAL'){
            $sucess_count++;
        }
        if($sucess_count >= 4){
            $carrier = 'YES';
        }else{
            $carrier = 'NO';
        }

        //Active (Super-spreader)
        if($covid_risk = 'HIGH' && $answer_value_count['sm'] == 1 && $answer_value_count['ts'] == 1 && $answer_value_count['lo'] > 0 && $answer_value_count['st'] > 0 && $answer_value_count['fe'] == 3){
            $active_super_spreader = 'YES';
        }else{
            $active_super_spreader = 'NO';
        }


        //8th table
        //RISK OF POSSIBLE COMPLICATION
        if($preliminary_inference_chart['pr'] == 'PATHOLOGICAL' && $preliminary_inference_chart['ud'] == 'PATHOLOGICAL'){
            $lungs = 'YES';
        }else{
            $lungs = 'NO';
        }

        //Liver abdomen
        if($preliminary_inference_chart['ma'] == 'PATHOLOGICAL' && $preliminary_inference_chart['ap'] == 'PATHOLOGICAL' && $preliminary_inference_chart['sw'] == 'PATHOLOGICAL'){
            $liver_abdomen = 'YES';
        }else{
            $liver_abdomen = 'NO';
        }

        //Kidney
        if($preliminary_inference_chart['mu'] == 'PATHOLOGICAL' && $preliminary_inference_chart['sw'] == 'PATHOLOGICAL'){
            $kideny = 'YES';
        }else{
            $kideny = 'NO';
        }

        //Cardio-vascular system
        if($preliminary_inference_chart['sa'] == 'PATHOLOGICAL' && $preliminary_inference_chart['an'] == 'PATHOLOGICAL'){
            $cardio_vascular_system = 'YES';
        }else{
            $cardio_vascular_system = 'NO';
        }

        //9th table
        //Recovery from illness
        if($health_risk == 'NO' && $high_risk == 'NO' && ($healthy == 'YES' || $health_alert = 'YES')){
            $early_recovery = 'YES';
        }else{
            $early_recovery = 'NO';
        }

        if($health_risk = 'YES'){
            $weeks = 'YES'; 
        }else{
            $weeks = 'NO';
        }

        if($high_risk = 'YES'){
            $long_time_recovery ='YES';                 
        }else{
            $long_time_recovery ='NO';
        }

    ?>
    <div class="container p-3 border mt-3 mb-3">
        <div class="printableArea" id="printableArea">
            <div class="header">
                <img src="../images/brand.png"  width="250">
                <hr style="height:1px; background-color:#50A6C2">
            </div>
            <div class="user_details  mr-3 ml-4">
                <div class="row">
                    <div class="col-6">
                        <p>ID : <strong>RAKT<?php echo $test_details_res['rakshakavach_test_no']; ?></strong></p>
                        <p>Age : <strong><?php echo $user_detail['age']; ?> Yrs.</strong></p>
                        <p>Tested On : <strong><?php echo date("d-m-Y h:ia", strtotime($record['created_at'])); ?></strong></p>
                        <p>Test Name : <strong>YOG-E @Rakshakavach Test</strong></p>
                    </div>
                    <div class="col-6">
                        <p>Name : <strong><?php echo $user_detail['name']; ?></strong></p>
                        <p>Sex : <strong><?php echo $user_detail['gender']; ?></strong></p>
                        <p>Reported On : <strong><?php echo date("d-m-Y h:ia", strtotime($record['created_at'])); ?></strong></p>
                        <p>Refer By : <strong>Yogesh Speciality Clinic &amp; Research centre</strong></p>
                    </div>
                </div> 
            </div>
            
            <hr style="height:3px; background-color:#50A6C2">
            <br>

            <h4 class="text-center">Preliminary Inference Of YOG-E@RAKSHAKAVACH TEST</h4>
            
            <div class="mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-muted">Sr. No.</th>
                            <th scope="col" class="text-muted">DOSHA’S<small>(Chakra/Vayu/Nadi/Kosha)</small></th>
                            <th scope="col" class="text-muted">COMMENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"  class="text-muted">1</th>
                            <td>Lungs</td>
                            <td><?php echo $preliminary_inference_chart['pr']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">2</th>
                            <td>Musculoskeletal</td>
                            <td><?php echo $preliminary_inference_chart['vy']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">3</th>
                            <td>Head Sinuses</td>
                            <td><?php echo $preliminary_inference_chart['ud']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">4</th>
                            <td>Heart</td>
                            <td><?php echo $preliminary_inference_chart['an']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">5</th>
                            <td>Small Intestine</td>
                            <td><?php echo $preliminary_inference_chart['ma']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">6</th>
                            <td>Stomach Liver</td>
                            <td><?php echo $preliminary_inference_chart['ap']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">7</th>
                            <td>Colon Pancreas</td>
                            <td><?php echo $preliminary_inference_chart['sw']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">8</th>
                            <td>Throat Hormone</td>
                            <td><?php echo $preliminary_inference_chart['vi']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">9</th>
                            <td>Circulation</td>
                            <td><?php echo $preliminary_inference_chart['sa']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row"  class="text-muted">10</th>
                            <td>Pelvis</td>
                            <td><?php echo $preliminary_inference_chart['mu']; ?></td>
                        </tr>
                        
                        
                        
                    </tbody>
                </table>
                <small><p>(<strong>Info :</strong> Our body functions, organs and system working depends on the Chakra, 
                    Vayu, Nadi and Kosha. Disturbance in any on it is presented in form of illness. Modern medicine 
                    can only diagnose the illness once it is detectable in pathological form or chemically. Yog has 
                    the power to detect event he pre-functional and functional stage of derangements along with pre-pathological 
                    and pathological states<br>
                    DOSHA: Disturbance within caused by changes in Vayu, Chakra, Nodi, Kosha. <br>
                    PRE-FUNCTIONAL: Temporary disturbance due to mind, food, lifestyle. This cannot be detected by modern diagnostic tools. <br>
                    FUNCTIONAL: Disturbance affecting function of organs presented mostly by subjective symptoms. These happen if 
                    pre-functional causes are not solved or can be effects of medication, addictions. These effects very seldom can be detected
                    with modern diagnostic tools. <br>
                    PRE-PATHOLOGICAL: Untreated functional disturbances cause changes in the organ or system or part of body which can be
                    detected by modern diagnostic tools. This is where modern medicine considers the disease has started. But yoga thinks
                    this is result of Dosha. <br>
                    PATHOLOGICAL: If pre-pathological changes are not treated or solved then changes in structure of organ will happen and
                    modern test will find pathological finding suggesting disease. At this stage complete reversal is not always possible.)</p>
                </small>
                
                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">HEALTH STATUS ASSESMENT</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>Healthy</td>
                                    <td><?php echo $healthy; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">2</th>
                                    <td>Health alert</td>
                                    <td><?php echo $health_alert; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">3</th>
                                    <td>Health Risk</td>
                                    <td><?php echo $health_risk; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">4</th>
                                    <td>High Risk</td>
                                    <td><?php echo $high_risk; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> Health is an outcome of the state of functioning of organs, 
                            systems and functions. Yoga helps to understand the state of health, alerts and risk)
                        </p>    
                </small>

                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">METABOLIC ASSESMENT</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>Metabolism</td>
                                    <td><?php echo $metabolism; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> Modern science looks at metabolism from the point of view of BMR, Calories etc. But yoga considers metabolism as a
                        result of the fire within which is called the Agni. The derangement of it is called Agni Dosha)
                        </p>    
                </small>

                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">PSYCHOLOGICAL ASSESMENT</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>Stress</td>
                                    <td><?php echo $preliminary_inference_chart['st']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">2</th>
                                    <td>Depression</td>
                                    <td><?php echo $preliminary_inference_chart['de']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">3</th>
                                    <td>Anxiety</td>
                                    <td><?php echo $preliminary_inference_chart['ax']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">4</th>
                                    <td>Relaxed</td>
                                    <td><?php echo $preliminary_inference_chart['re']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> Mind plays a important role in health and happiness. Yog helps to diagnose the state of mental health and also to
                            understand the effect of derangement of mind on body. Somatic effect if long term are responsible for causing disturbance in organs. The
                            Neurasthenia effect is responsible for the functional derangement.)
                        </p>    
                </small>

                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">KOSHA DOSHA</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>Annamaya Kosha</td>
                                    <td><?php echo $annamaya_kosha; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">2</th>
                                    <td>Manomaya Kosha</td>
                                    <td><?php echo $manomaya_kosha; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">3</th>
                                    <td>Pranamanya Kosha</td>
                                    <td><?php echo $pranamaya_kosha; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> In Yog existence of body is considered in five layers called kosha’s. In this test we assess the derangement of outer
                            three kosha’s. Annamaya kosha represents the body, Manomaya kosha the mind and Pranamanya kosha represents the
                            energy from prana)
                        </p>    
                </small>

                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">STRENGTH OF RAKSHAKAVACH</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>Strong Rakshakavach</td>
                                    <td><?php echo $strong_raksha_kavach; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">2</th>
                                    <td>Moderate Rakshakavach</td>
                                    <td><?php echo $moderate_raksha_kavach; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">3</th>
                                    <td>Weak Rakshakavach</td>
                                    <td><?php echo $weak_raksha_kavach; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> Immunity of a person is the Rakshakavach or protective shield. The strength of Rakshakavach protects the person
                            from illnesses and also plays a major role in recovery from diseases. Yog helps to understand the strength of Rakshakavach)
                        </p>    
                </small>

                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">STATUS OF COVID 19 RISK probability</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>Healthy Immune Warrior</td>
                                    <td><?php echo $healthy_immune_warrior; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">2</th>
                                    <td>Susceptible</td>
                                    <td><?php echo $susceptible; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">3</th>
                                    <td>Carrier</td>
                                    <td><?php echo $carrier; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">4</th>
                                    <td>Active (Super Spreader)</td>
                                    <td><?php echo $active_super_spreader; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> COVID19 has brought in front in front of the world the limitations of diagnostic scientific tools to
                            diagnose/identify/screen. We have applied principles of Yog to help in this aspect to detect the probable COVID 19 related
                            risk , it applies to SARS as well as other virulent viruses from this family)
                        </p>    
                </small>

                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">RISK OF POSSIBLE COMPLICATION</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>LUNGS</td>
                                    <td><?php echo $lungs; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">2</th>
                                    <td>LIVER ABDOMEN</td>
                                    <td><?php echo $liver_abdomen; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">3</th>
                                    <td>KIDNEY</td>
                                    <td><?php echo $kideny; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">4</th>
                                    <td>CARDIO-VASCULAR</td>
                                    <td><?php echo $cardio_vascular_system; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> COVID19 causes serious complications in body both in active phase and also in post covid phase . If we can analyse
                        the risk of possible complication , the management can be made to reduce the mortality. Yog helps to pre-determine the
                        risk and therefore give time to offer solutions to prevent it or treat it)
                        </p>    
                </small>

                <br><hr><br>
                <div class="row">
                    <div class="col-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-muted">Sr. No.</th>
                                    <th scope="col" class="text-muted">RECOVERY TIME FROM ILLNESS</th>
                                    <th scope="col" class="text-muted">COMMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"  class="text-muted">1</th>
                                    <td>Early Recovery</td>
                                    <td><?php echo $early_recovery; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">2</th>
                                    <td>Delayed Recovery</td>
                                    <td><?php echo $weeks; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row"  class="text-muted">3</th>
                                    <td>Long Duration for Recovery</td>
                                    <td><?php echo $long_time_recovery; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
                <small><p>(<strong>Info:</strong> Early recovery mean recovery within 3 weeks, Delayed means recovery period more than 4 weeks, long duration for
                            recovery means were time for the recovery cannot be assessed and generally means duration over 3 months)
                        </p>    
                </small>

                <br>
                <em>NOTE: This present report is based on the consideration of yogic interpretation and we have made an
                    attempt to present it in the form of modern medical diagnostic terminology and clinical significance.
                    Because yoga see&#39;s disease right from the point of changes in Vayu, Chakra and Nadi. And this
                    changes in earliest form cannot be detected by any modern gadgets or techniques of modern
                    diagnostic science.
                </em>
                <br><br>
                <hr>

                <h6>Doctor's Comment:</h6>
                <?php
                    $check_comment = "SELECT `comment` FROM `test_rakshakavach` WHERE `test_id`='$test_id'";
                    $check_comment_run = mysqli_query($con, $check_comment);
                    $check_comment_res = mysqli_fetch_assoc($check_comment_run);
                    if($check_comment_res['comment'] == ""){
                ?>
                
                <form method="post" onsubmit="javascript: return confirm('Are you sure, you want to submit?');">
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="Comment" class="btn btn-primary">Submit</button>
                </form>

                <?php 
                    }else{
                        echo $check_comment_res['comment'];
                    }
                    
                    if(isset($_POST['Comment'])){
                        $comment = mysqli_real_escape_string($con, $_POST['comment']);
                        $update_comment = "UPDATE `test_rakshakavach` SET `comment`='$comment' WHERE `test_id`='$test_id'";
                        $update_comment = mysqli_query($con, $update_comment);

                        $update_status = "UPDATE `test_payments` SET `status`='checked' WHERE `pay_id`='$pay_id'";
                        $update_status_run = mysqli_query($con, $update_status);
                        echo "<script>
                                window.location.href = 'rakshakavach_report.php?pay_id=$pay_id';
                            </script>";
                    }
                ?>
                <div  style="margin-left:65%;">
                    <img src="../images/sign.png" width="200" class="">
                    <h5 class=" text-muted mt-3"><b>Dr. Sadanand Rasal</b></h5>
                    <p>
                        Regd.No.25118<br>
                        B.H.M.S., Yog Practitioner, PGDMLT.
                    </p>
                </div>
            </div>

            
        </div>

        
    </div>

            
            <script>
                function printDiv(divName) {
                    var printContents = document.getElementById(divName).innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }
            </script>

 
        <div class="bg-dark pt-4 pb-3" style="paddig:2%; margin-bottom:-24px;color:white;">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-md-4 mt-3 ">
                        <p class="text-center" style=" font-size:12px;color:#bfbfbf">&copy; 2020 by AtmaVeda Yog Pvt. Ltd. All rights reserved &nbsp;<a target="blank" href="../images/Privacy Policy.pdf">Privacy Policies</a></p>
                    </div>
                    <div class="col-md-4">
                        <img src="../images/AtmaVeda(334,273).png" width="80" class="img-fluid  d-block mx-auto" >
                    </div>
                    <div class="col-md-4" style="font-family: 'Roboto', sans-serif;">
                        <p class="text-ceter d-inline-block" style=" font-size:13px; color:#bfbfbf">enquiry@atmavedayog.com &nbsp; &nbsp;|&nbsp; &nbsp; 
                            <ul class="list-unstyled text-center d-inline-block" style="font-size: 2em">
                                <li class="d-inline"><a target="_blank" href="https://www.facebook.com/drsadanand.ke.yodhas/"><i class="fab fa-facebook-square fa-2x facebook"></i></a></li>
                                <li class="d-inline pl-3"><a target="_blank" href="https://www.instagram.com/drsadanand.atmavedayog"><i class="fab fa-instagram fa-2x instagram"></i></a></li>
                                <li class="d-inline pl-3"><a target="_blank" href="https://twitter.com/ForSadanand?s=09"><i class="fab fa-twitter-square fa-2x tweter"></i></a></li>
                            </ul>
                        </p>
                    </div>
                </div>
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
    <script type="text/javascript" src="../bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
        }else{
            //else part if
            echo "<script>
                    alert('No record found');
                    window.location.href='test_submissions.php';
                </script>";
        }
    }else{
        //else part if session is not set
        echo "<script>
                window.location.href='../error/login_error.html';
            </script>";
    }


?>


