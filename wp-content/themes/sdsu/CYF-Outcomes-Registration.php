<?php

function post_or_not() {
  if(!$_POST) {
    echo "This scripts can only be called from a form.";
    exit;
  }
}
function get_conn() {
  if( !(include $_SERVER['DOCUMENT_ROOT'].'/wp-config.php') )
      die("<H1>Can\'t include config.</H1>");
  if(!($db =   mysqli_connect('theacademy.sdsu.edu',DB_USER, DB_PASSWORD,DB_NAME))) {
    echo "SQL ERROR: Connection failed1234:".mysqli_error($db);
    exit;
  }
  return $db;
}
function close_db($db) {
  mysqli_close($db);
}
function main_func() {
  $coupon='';
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $visitor_email = $_POST['email'];
  $agency = $_POST['agency'];
  $program = $_POST['program'];
  $admin= 'pd121193@gmail.com';
  $email_subject = "CYF Outcomes";
  $db = get_conn();
  $todays_date =date("Y-m-d");
  $check_duplicate_entry = $db->prepare("select coupon_number,email,first_name,last_name from CYF_coupon_request where (email=? or (first_name=? and last_name=?)) and coupon_enddate>? and coupon_assignment_status=1;");
  $check_duplicate_entry->bind_param("ssss",$visitor_email,$fname,$lname,$todays_date);
  $check_duplicate_entry->bind_result($db_coupon,$db_email,$db_fname,$db_lname);
  if($check_duplicate_entry->execute()){
    while ($row = $check_duplicate_entry->fetch()) {
      if(!strcmp($visitor_email,$db_email)){
            echo $db_lname.", ".$db_fname."(".$visitor_email.") has received coupon:".$db_coupon;
              close_db($db);
            exit;
          }
      echo "Sorry, an error has occurred please contact the BHETA at 619 594-0923 or bheta@sdsu.edu.";
        close_db($db);
      exit;
    }
  }
  else{
    echo "Sorry, an error has occurred please contact the BHETA at 619 594-0923 or bheta@sdsu.edu.";
      close_db($db);
    exit;
  }
 $get_valid_coupon=" SELECT coupon_number
 FROM CYF_coupon_request
 WHERE coupon_assignment_status =0
 LIMIT 0 , 1;";
 $fetched_coupon = mysqli_query($db,$get_valid_coupon);
 while($row=mysqli_fetch_row($fetched_coupon)) {
   foreach(array_slice($row,0) as $item){
     $coupon=$item;
   }
 }
 if(mysqli_affected_rows($db)==1 && $coupon!="" )
 {
   $allocate_coupon = $db->prepare("  update CYF_coupon_request
   set last_name=?,
   first_name=?,
   email=?,
   agency_name =? ,
   program_name=?,
   coupon_startdate= DATE(NOW()),
   coupon_enddate=  DATE_ADD(DATE(NOW()), INTERVAL 1 YEAR),
   coupon_assignment_status=1
   where coupon_number=?; " );
   $allocate_coupon->bind_param("ssssss",$lname,$fname,$visitor_email,$agency,$program,$coupon);
   $allocate_coupon->execute();
   $allocate_coupon->store_result();
   $alloted_or_not = $allocate_coupon->affected_rows;
   if($alloted_or_not==1){
     $email_body = "Congratulations $fname $lname.\n"."Your coupon code is: $coupon";
     $headers = "From: Academy for Professional Excellence $admin \r\n";
    $retval =  mail($visitor_email,$email_subject,$email_body,$headers);
     if(@mail($visitor_email,$email_subject,$email_body))
     {
       $email_body = " $fname $lname ($visitor_email)"."has been assigned coupon code: $coupon";
       echo "Congratulations! You have been registered successfully. A mail will be sent to you shortly with your coupon details. (Please check the Spam folder too for the mail.)";
       mail($admin,$email_subject,$email_body);
     }else{
       echo "Mail Not Sent";
     }
   }
 }
 else{
   echo "No Coupons available. Please contact the BHETA at 619 594-0923 or bheta@sdsu.edu.";
 }
  close_db($db);
}
post_or_not();
main_func();
?>
