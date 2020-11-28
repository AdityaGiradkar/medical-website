<!-- all its treatment history  -->
<div class="border border-primary rounded-lg p-3 mt-4">
  <h1 class="h4 mb-2 text-gray-800">Treatment History</h1>
  <?php 
        $pre_treatments = "SELECT * FROM `treatment` WHERE `user_id`='$user_id' AND `treat_status`='ongoing' GROUP By `treat_number` ORDER BY `date` DESC";
        $pre_treatments_run = mysqli_query($con, $pre_treatments);
        $treat_no = 1;

        //loop through main treatments
        while($pre_treatments_res = mysqli_fetch_assoc($pre_treatments_run)){
          //print_r($pre_treatments_res)
            $treatment_number = $pre_treatments_res['treat_number'];
            $all_subtreatment = "SELECT * FROM `treatment` WHERE `user_id`='$user_id' AND `treat_number`='$treatment_number' ORDER BY `date`";
            $all_subtreatment_run = mysqli_query($con, $all_subtreatment);
    ?>

  <div class="card border-left-primary shadow h-100 py-2 mb-3">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="h6 mb-0 font-weight-bold text-gray-800">
            <?php //echo date("d/m/Y", strtotime($pre_treatments_res['date'])); ?>
            <?php echo $pre_treatments_res['treatment_for']; ?>
          </div>
          <div class="text-xs font-weight-bold text-primary mt-2 mb-1">
            start Date : <?php echo date("d/m/Y", strtotime($pre_treatments_res['date'])); ?> | status : <?php echo $pre_treatments_res['treat_status'] == 'ongoing'?'<span style="color:green;">ongoing</span>':'closed'; ?>
          </div>
        </div>
        <div class="col-auto">
          <a class="up-down-arrow p-4" onClick="showDetails('d_<?php echo $treat_no; ?>')"><i
              class="fas arrow fa-angle-right fa-2x" id="d_<?php echo $treat_no; ?>_arrow"></i></a>
        </div>
      </div>
    </div>
    <div class="card-body pt-2" style="display:none" id="d_<?php echo $treat_no; ?>">
      <b>Details : </b><br>
      <?php 
          $sr_no = 1;
          //loop through subtreatments under main treatments
          
          while($all_subtreatment_res = mysqli_fetch_assoc($all_subtreatment_run)){
              $subtreatment_number = $all_subtreatment_res['sub_treat_number'];
              $treat_id = $all_subtreatment_res['treat_id'];
              $discount = (int)$all_subtreatment_res['discount'];
              $courer_charges = (int)$all_subtreatment_res['courier_charge'];
              $prescribed_medi_details = array();
              $prescribed_session_details = array();
              $total_price = 0;

              //first take all medicines from prescribed_medicine table which matches treatment_no, user_id, subtreat_number
              $all_prescribed_medi = "SELECT `medicine_id`, `quantity` FROM `prescribed_medicine` WHERE `user_id`='$user_id' AND `treat_number`='$treatment_number' AND `sub_treat_number`='$subtreatment_number'";
              if($all_prescribed_medi_run = mysqli_query($con, $all_prescribed_medi)){
                  $all_prescribed_medi_row = mysqli_num_rows($all_prescribed_medi_run);
                  if($all_prescribed_medi_row > 0){
                      $prescribed_medi_idQuantity_array = array();
                      $medi_count =0; 
                      while ($prescribed_medi_idQuantity = mysqli_fetch_assoc($all_prescribed_medi_run)){
                          $prescribed_medi_idQuantity_array[$medi_count] = $prescribed_medi_idQuantity;
                          $medi_count++;
                      }

                      //after that take price and dose for prescribed medicine from actual medicine table 
                      $medi_count =0;
                      foreach($prescribed_medi_idQuantity_array as $medi_Id_quantity){
                          $tempid = $medi_Id_quantity['medicine_id'];
                          $medicine_detail = "SELECT * FROM `medicines` WHERE `medicine_id`='$tempid'";
                          $medicine_detail_run = mysqli_query($con, $medicine_detail);
                          $medicine_detail_res = mysqli_fetch_assoc($medicine_detail_run);
                          $temp = array(
                              "name" => $medicine_detail_res['Name'],
                              "type" => $medicine_detail_res['type'],
                              "price" => $medicine_detail_res['price'],
                              "medi_quantity" => $medicine_detail_res['quantity'], //quantity from medicine table
                              "quantity" => $medi_Id_quantity['quantity'],    //quantity multiple of medicine table
                              "price" => $medicine_detail_res['price'],
                              "total_price" => $medi_Id_quantity['quantity'] * $medicine_detail_res['price']
                          );

                          $total_price = $total_price + (int)$temp['total_price'];
                          $prescribed_medi_details[$medi_count] = $temp;
                          $medi_count++;
                      }
                      //print_r($prescribed_medi_details);
                      //print_r($total_price);
                  }
              }


              //first take all sessions from prescribed_session table which matches treatment_no, user_id, subtreat_number
              $all_prescribed_session = "SELECT * FROM `prescribed_session` WHERE `user_id`='$user_id' AND `treat_number`='$treatment_number' AND `sub_treat_number`='$subtreatment_number'";
              if($all_prescribed_session_run = mysqli_query($con, $all_prescribed_session)){
                  $all_prescribed_session_row = mysqli_num_rows($all_prescribed_session_run);
                  if($all_prescribed_session_row > 0){
                      $prescribed_session_idQuantity_array = array();
                      $session_count =0;
                      while ($prescribed_session_idQuantity = mysqli_fetch_assoc($all_prescribed_session_run)){
                          $prescribed_session_idQuantity_array[$session_count] = $prescribed_session_idQuantity;
                          $session_count++;
                      }

                      //after that take price and quantity for prescribed sessions from actual session table 
                      $session_count =0;
                      foreach($prescribed_session_idQuantity_array as $session_Id_quantity){
                          $tempid = $session_Id_quantity['session_id'];
                          $session_detail = "SELECT * FROM `sessions` WHERE `session_id`='$tempid'";
                          $session_detail_run = mysqli_query($con, $session_detail);
                          $session_detail_res = mysqli_fetch_assoc($session_detail_run);
                          $temp = array(
                              "name" => $session_detail_res['session_name'],
                              "price" => $session_detail_res['price'],
                              "quantity" => $session_Id_quantity['session_per_month'],
                              "price" => $session_detail_res['price'],
                              "total_price" => $session_Id_quantity['session_per_month'] * $session_detail_res['price']
                          );
                          $total_price = $total_price + (int)$temp['total_price'];
                          $prescribed_session_details[$session_count] = $temp;
                          $session_count++;
                      }
                      //print_r($prescribed_session_details);
                      //print_r($total_price);
                  }
              }

              $total_payble_amount = $total_price -  $discount;
              $total_payble_amount = (int)($total_payble_amount + $courer_charges);

            ?>

      <!-- subtreatment fields -->
       month <?php echo $all_subtreatment_res['sub_treat_number']; ?> : <a
        data-target="#t_<?php echo $treatment_number; ?>_d_<?php echo $all_subtreatment_res['sub_treat_number']; ?>" href="" data-toggle="modal">View
        Details</a> |
      Total : Rs. <?php echo $total_payble_amount; ?>
      (<?php echo $all_subtreatment_res['fees_status']=='pending'?"<span style='color:red'>Pending</span>":"<span style='color:green'>Paid</span>"; ?>)<br>
      <!-- subtreatment fields -->

      <!-- modal for each Subtreatments -->
      <div class="modal fade bd-example-modal-lg" id="t_<?php echo $treatment_number; ?>_d_<?php echo $all_subtreatment_res['sub_treat_number']; ?>"
        tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content pt-3">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Treatment Name : <?php echo $pre_treatments_res['treatment_for']; ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>  
            </div>

            <div class="modal-body pl-4">
              <!-- content here -->
              <lable>Date : <b><?php echo date("d/m/Y", strtotime($pre_treatments_res['date'])); ?></b></lable>
              <br><br>

              <label for=""><strong>Prescribed Medicines:</strong></label><br>
              <table class="table table-bordered table-striped table-responsive-md">
                <thead>
                  <tr>
                    <th scope="col">sr. no.</th>
                    <th scope="col">Medicine Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price (Rs.)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $medi_count = 1;
                      foreach($prescribed_medi_details as $single_medi_detail){
                    ?>
                  <tr>
                    <th scope="col"><?php echo $medi_count; ?></th>
                    <td><?php echo $single_medi_detail['name']; ?></td>
                    <td><?php echo $single_medi_detail['type']; ?></td>
                    <td><?php echo $single_medi_detail['medi_quantity']. " * " .$single_medi_detail['quantity']; ?></td>
                    <td>
                      <?php echo $single_medi_detail['price']. " * ". $single_medi_detail['quantity']. " = " .$single_medi_detail['total_price']; ?>
                    </td>
                  </tr>
                  <?php 
                        $medi_count++;
                      }
                    ?>

                </tbody>
              </table>
              <br>

              <label for=""><strong>Prescribed Sessions:</strong></label><br>
              <table class="table table-bordered table-striped table-responsive-md">
                <thead>
                  <tr>
                    <th scope="col">sr. no.</th>
                    <th scope="col">Session Name</th>
                    <th scope="col">Times per month</th>
                    <th scope="col">Total Price (Rs.)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $session_count = 1;
                      foreach($prescribed_session_details as $single_session_detail){
                        //print_r($single_session_detail);
                    ?>
                  <tr>
                    <th scope="col"><?php echo $session_count; ?></th>
                    <td><?php echo $single_session_detail['name']; ?></td>
                    <td><?php echo $single_session_detail['quantity']; ?></td>
                    <td>
                      <?php echo $single_session_detail['price']. " * " .$single_session_detail['quantity']. " = " .$single_session_detail['total_price']; ?>
                    </td>
                  </tr>
                  <?php 
                      $session_count++;
                    }
                    
                    ?>
                </tbody>
              </table>
              <br>

              <div class="row">
                <div class="col-md-4">
                  <strong>Diet Plan : </strong><a <?php if($all_subtreatment_res['diet'] != "" && $pre_treatments_res['fees_status'] == 'paid'){ ?> target="_blank"
                    href="admin/<?php echo $all_subtreatment_res['diet']; ?>" <?php } ?> >view</a>
                </div>
                <div class="col-md-4">
                  <strong>E - Precription : </strong><a <?php if($all_subtreatment_res['e_prescription'] != "" && $pre_treatments_res['fees_status'] == 'paid'){ ?> target="_blank"
                    href="admin/<?php echo $all_subtreatment_res['e_prescription']; ?>"  <?php } ?>>view</a>
                </div>
                <div class="col-md-4">
                  <strong>Exercise/Report : </strong> <a <?php if($all_subtreatment_res['report'] != "" && $pre_treatments_res['fees_status'] == 'paid'){ ?> target="_blank"
                    href="admin/<?php echo $all_subtreatment_res['report']; ?>" <?php } ?>>view</a>
                </div>
              </div>

              <br>
              <p><strong>Extra Note : </strong> <?php echo $all_subtreatment_res['extra_note']; ?></p>
            
              <hr>
              <div class="Actions">
                <h5><b>Total price : Rs. <?php echo $total_payble_amount; ?></b></h5>
              <?php 
                if($all_subtreatment_res['fees_status'] == 'pending'){
              ?>
                <form method="post" action="view_recipt.php?treat_id=<?php echo $treat_id; ?>&user_id=<?php echo $all_subtreatment_res['user_id']; ?>&treat_no=<?php echo $treatment_number; ?>&sub_treat_no=<?php echo $all_subtreatment_res['sub_treat_number']; ?>">
                  <button type="submit" class="btn btn-success mt-3">Proccede To Enroll</button>
                </form>
              <?php 
                }else{
              ?>
                <a target="_blank" href="view_recipt.php?treat_id=<?php echo $treat_id; ?>&user_id=<?php echo $all_subtreatment_res['user_id']; ?>&treat_no=<?php echo $treatment_number; ?>&sub_treat_no=<?php echo $all_subtreatment_res['sub_treat_number']; ?>">View Recipt</a>
              <?php
                }
              ?>
              

              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- modal for each Subtreatments -->
      <?php
          }
      ?>
      
      

    </div>
  </div>


  <?php 
        $treat_no++;
        }
    ?>
</div>
<!-- all its treatment history  -->