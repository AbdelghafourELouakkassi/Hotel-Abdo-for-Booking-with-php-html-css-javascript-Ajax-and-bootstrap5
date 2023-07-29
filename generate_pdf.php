<?php
    require('Admin/inc/db_config.php');
    require('Admin/inc/essentials.php');
    require('Admin/inc/mpdf/vendor/autoload.php');
    session_start();

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
        redirect('index.php');
      }


    if(isset($_GET['gen_pdf']) && isset($_GET['id'])){
        $frm_data=filteration($_GET);

        $query="SELECT bo.*, bd.*,ui.email FROM  `booking_order` bo
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            INNER JOIN `user_info` ui ON bo.user_id=ui.id      
            WHERE (bo.booking_status ='pending' AND bo.arrival=1)
            OR (bo.booking_status ='cancelled' AND bo.refund=1)
            AND bo.booking_id= '$frm_data[id]'";

        $res=mysqli_query($con,$query);

        $total_rows= mysqli_num_rows($res);

        if($total_rows==0){   
            header('location: index.php');
            exit;
        }

        $data =mysqli_fetch_assoc($res);

        $date= date("h:ia | d-m-Y",strtotime($data['datentime']));
        $checkin= date("d-m-Y",strtotime($data['check_in']));
        $checkout= date("d-m-Y",strtotime($data['check_out']));
        
        $table_data=" 
        <h2>BOOKING RECIEPT</h2>
        <table border='1'>
            <tr>
                <td>Order Id: $data[order_id]</td>
                <td>Booking Date: $date</td>
            </tr>
            <tr>
                <td colspan='2'>Status: $data[booking_status]</td>
            </tr>
            <tr>
                <td>Name: $data[user_name]</td>
                <td>Email: $data[email]</td>
            </tr>
            <tr>
                <td>Room Name: $data[user_name]</td>
                <td>Cost: $data[price] DH Per Night</td>
            </tr>
            <tr>
                <td>Check-in: $checkout</td>
                <td>Check-out:$checkin</td>
            </tr>
        
        ";

        if($data['booking_status']=='cancelled')
        {
            $refund =($data['refund']) ? "amount refunded" : "not yet refunded";

            $table_data.="<tr>
            <td>amount paid: $data[trans_amount]</td>
            <td>refund: $refund</td>
            </tr>"; 
        }
        else if($data['booking_status']=='payment failed'){
            $table_data.="<tr>
            <td>transaction amount: $data[trans_amount]</td>
            <td>Failure Response: $data[trans_resp_msg]</td>
            </tr>"; 
        }
        else{
            $table_data.="<tr>
            <td>Room Number: $data[room_no]</td>
            <td>Amount Paid: $data[trans_amount] DH</td>
            </tr>"; 
        }
            $table_data.="</table>";

            $mpdf=new \Mpdf\Mpdf();

            $mpdf->WriteHTML($table_data);

            $mpdf->Output($data['order_id'].'.pdf','D');

            echo  $table_data;

    }

    else{
        header('location: index.php');
    }

    ?>