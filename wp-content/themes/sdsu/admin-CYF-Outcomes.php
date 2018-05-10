<?php
function post_or_not() {
  if(!$_POST) {
    echo "This scripts can only be called from a form.";
    exit;
  }
}
function get_conn() {
  if( !(include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php') )
      die('<H1>Can\'t include config.</H1>');
  if(!($db =   mysqli_connect('theacademy.sdsu.edu',DB_USER, DB_PASSWORD,DB_NAME))) {
    echo "SQL ERROR: Connection failed1234:".mysqli_error($db);
  }
  return $db;
}
function close_conn($db) {
  mysqli_close($db);
}
function main_func() {
  if(isset($_POST["importCouponData"])){
    $file_extension = explode(".",$_FILES["file"]["name"])[1];
 		$filename=$_FILES["file"]["tmp_name"];
 		 if($_FILES["file"]["size"] > 0 && strtolower($file_extension)=='csv')
 		 {
       $db = get_conn();
 		  	$file = fopen($filename, "r");
        $duplicated_check=array();
        $insert_coupons=array();
 	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
 	         {
             if(!trim($getData[0])==''){
               $duplicated_check[]="'".trim($getData[0])."'";
               $insert_coupons[]="('".trim($getData[0])."')";
             }
 	         }
          $dup_sql= "select coupon_number from CYF_coupon_request where coupon_number in (".implode(',', $duplicated_check).");";
          $dup_coupon = mysqli_query($db,$dup_sql);
          while($row=mysqli_fetch_row($dup_coupon)) {
            echo "Duplicate Coupons not allowed";
            close_conn($db);
            exit;
          }
          $insert_sql="insert into CYF_coupon_request(coupon_number) values ".implode(',', $insert_coupons);
          $result=mysqli_query($db,$insert_sql);
          if($result){
            $num_rows = mysqli_affected_rows($db);
            echo $num_rows." Coupons inserted";
          }
          else{
              echo "No Coupons imported";
          }
 	        fclose($file);
          close_conn($db);
 		 }
      else echo "Not CSV format";
 	}
  else if(isset($_POST["exportCouponData"])){
    if(!strcmp($_POST["exportCouponData"],"usedCoupon")){
      $to=$_POST["to"];
      $from=$_POST["from"];
    $db = get_conn();
    $get_data="select coupon_number,first_name,last_name,email,agency_name,program_name,coupon_startdate,coupon_enddate from CYF_coupon_request where coupon_assignment_status=1 and coupon_startdate between '".$from."' and '".$to."'; ";
    $fetched_coupon = mysqli_query($db,$get_data);
    $tableContents="";
    while($row=mysqli_fetch_row($fetched_coupon)) {
      $tableContents=$tableContents."<tr>";
          foreach(array_slice($row,0) as $item){
            $tableContents=$tableContents."<td>".$item."</td>";
          }
      $tableContents=$tableContents."</tr>";
    }
      echo $tableContents;
          close_conn($db);
    }
    else if(!strcmp($_POST["exportCouponData"],"notUsedCoupon")){
      $db = get_conn();
      $get_data="select coupon_number from CYF_coupon_request where coupon_assignment_status=0; ";
      $fetched_coupon = mysqli_query($db,$get_data);
      $tableContents="";
      while($row=mysqli_fetch_row($fetched_coupon)) {
        $tableContents=$tableContents."<tr>";
            foreach(array_slice($row,0) as $item){
              $tableContents=$tableContents."<td>".$item."</td>";
            }
        $tableContents=$tableContents."</tr>";
      }
      echo $tableContents;
    close_conn($db);
    }
  }
  else if(isset($_POST["downloadCouponData"])){
    if(!strcmp($_POST["UsedOrNotUsedCouponForm"],"usedCoupon")){
      $to=$_POST["to"];
      $from=$_POST["from"];
      $get_data="select coupon_number,first_name,last_name,email,agency_name,program_name,coupon_startdate,coupon_enddate from CYF_coupon_request where coupon_assignment_status=1 and coupon_startdate between '".$from."' and '".$to."'; ";
    }
    else  if(!strcmp($_POST["UsedOrNotUsedCouponForm"],"notUsedCoupon")){
      $get_data="select coupon_number from CYF_coupon_request where coupon_assignment_status=0;";
      $to=$_POST["to"];
      $from=$_POST["from"];
    }
    else{
      exit;
    }
    $db = get_conn();
    $fetched_coupon = mysqli_query($db,$get_data);
    $f = fopen("php://memory", "w");
    if(!strcmp($_POST["UsedOrNotUsedCouponForm"],"usedCoupon")){
      fputcsv($f, array("Coupon No","First Name","Last Name","Agency Name","Program Name","Email"," coupon_startdate","coupon_enddate"),",");
      }
    else if(!strcmp($_POST["UsedOrNotUsedCouponForm"],"notUsedCoupon")){
      fputcsv($f, array("Coupon No"),",");
    }
    while($row=mysqli_fetch_row($fetched_coupon)) {
        fputcsv($f, $row,",");
    }
    fseek($f, 0);
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="export.csv";');
    fpassthru($f);
    close_conn($db);
  }
}
    post_or_not();
    main_func() ;
  ?>
