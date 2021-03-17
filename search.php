<?php
  include("includes/db.php");

  if (isset($_GET['query'])) {
    $inpText = '\'%' . $_GET['query'] . '%\'';

    $sql = "SELECT * FROM `search_treatment` WHERE `name` LIKE " . $inpText;
    $sql_run = mysqli_query($con, $sql);
  
    $data = array();
    while($result = mysqli_fetch_assoc($sql_run)){
        $data[] = $result;
    }

    echo json_encode($data);
  }

?>
