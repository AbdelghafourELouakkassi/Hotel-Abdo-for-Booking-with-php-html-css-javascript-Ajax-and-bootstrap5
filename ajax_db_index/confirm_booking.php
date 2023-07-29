<?php
    require('../Admin/inc/db_config.php');
    require('../Admin/inc/essentials.php');
    require('../inc/sendgrid/sendgrid-php.php');
    date_default_timezone_set('Africa/Casablanca');
    

    if(isset($_POST['check_availability']))
    {

     $frm_data=filteration($_POST);

     $status="";
     $result="";

    //  check out and in validation 
    
    

    $today_date= new Datetime(date("Y-m-d"));
    $checkin_date= new Datetime($frm_data['check_in']);
    $checkout_date= new Datetime($frm_data['check_out']);

     if($checkin_date==$checkout_date)
     {
        $status='check_in_out equal' ;

        $result=json_encode(["status"=>$status]);
        

     }

     else if($checkout_date < $checkin_date )
     {
        $status="check_out_earlier";
        $result=json_encode(["status"=>$status]);
     }

     else if($checkin_date < $today_date)
     {
        $status="check_in_earlier";
        $result=json_encode(["status"=>$status]);
     }
     

     //check booking availability if status is blank else return the error
    
     if($status!=''){
        echo $result;
     }

     else{
        session_start();
    

        //run query to check room is available or not

        $tb_query="SELECT COUNT(*) AS `total_bookings` FROM `booking_order`
        WHERE booking_status=? AND room_id=?
        AND check_out > ? AND check_in < ?";

        $values=['pending',$_SESSION['room']['id'],$frm_data['check_in'],$frm_data['check_out']];

        $tb_fetch=mysqli_fetch_assoc(select($tb_query,$values,'siss'));
        
        $rq_result= select("SELECT `quantity` FROM `rooms` WHERE `id`=?",[$_SESSION['room']['id']],'i');

        $rq_fetch=mysqli_fetch_assoc($rq_result);

        if(($rq_fetch['quantity']-$tb_fetch['total_bookings'])==0){

         $status='unavailable';
         $result=json_encode(['status'=>$status]);
         echo $result;
         exit;

        }

        $count_days= date_diff($checkin_date,$checkout_date)->days;
        
        $payment=$_SESSION['room']['price'] * $count_days;


        $_SESSION['room']['payment']= $payment;

        $_SESSION['room'] ['available'] = true;

        $result =json_encode(["status"=>'available',"days"=>$count_days, "payment"=>$payment]);
        
        echo $result ;

     }
  

    }


?>