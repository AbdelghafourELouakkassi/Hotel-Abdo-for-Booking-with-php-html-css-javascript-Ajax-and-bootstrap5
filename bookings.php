<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php');
    
    if(!isset($_SESSION['login']) && $_SESSION['login'] == true){
        redirect("index .php");
    }
    
    ?>
       
 

    <!-- container rooms and availability -->

        <div class="container-fluid">
            <div class="row ">
               
                <div class="fs-5 mb-4">
                    <h2 class="mt-5 pt-4 mb-4 fw-bold h-font fs-1">BOOKINGs<h2>
                    <div class="fs-5">
                        <a href="index.php" class="text-secondary text-decoration-none ">HOME</a>
                        <span class="text-secondary"> > </span>
                        <a href="#" class="text-decoration-none text-secondary">BOOKINGS</a>
                    </div>
                </div>
               
                
             <?php
   
                $query="SELECT bo.*, bd.* FROM  `booking_order` bo
                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                WHERE (bo.booking_status ='pending')
                OR (bo.booking_status ='cancelled')
                AND (bo.user_id=?)
                ORDER BY bo.booking_id DESC ";


                $result=select($query,[$_SESSION['uid']],'i');

                while($data =mysqli_fetch_assoc($result))
                {
                   $date= date("d-m-Y",strtotime($data['datentime']));
                   $checkin= date("d-m-Y",strtotime($data['check_in']));
                   $checkout= date("d-m-Y",strtotime($data['check_out']));
                   

                   $status_bg="";
                   $btn="";


                   if($data['booking_status']=='pending')
                   {
                    $status_bg='bg-success';

                        if($data['arrival']==1){
                            $btn= "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>
                            Download</a>";
                        }
                        else{
                            $btn="<button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-outline-dark btn-sm fw-bold '>
                            Cancel
                            </button>";
                        }
                   }

                   else if($data['booking_status']=='cancelled')
                   {
                       $status_bg='bg-danger';
                        if($data['refund']==0){
                            $btn= "<span class='badge-primary-'>Refund in process !</span>";
                            
                        }
                        else{
                            $btn= "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>
                            Download</a>
                            ";
                            
                        }

                    }
                    
 
                   else
                   {
                        $status_bg='bg-warning';
                        $btn= "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>
                        Download</a>";
                        

                    }
                    

                    echo<<<bookings
                      <div class='col-md-4 px-4 mb-4'>
                        <div class='bg-white p-3 rounded shadow-sm'>
                            <h5 class='fw-bold'>$data[room_name]</h5>
                            <p>
                                $data[price] Dh per night</p>
                                <p><b>checkin: </b>$checkin<br>
                                <b>checkout: </b>$checkout<br>
                            </p>
                            <p>
                               amount: $data[price] DH per night</p>
                                <p><b>order id: </b>$data[order_id]<br>
                                <b>date:</b> $date
                            </p>
                            <p>
                              <span class='badge $status_bg'>$data[booking_status]</span>
                            </p>
                            $btn

                         </div>
                      </div>
                    bookings;  

                
    
                }





             ?>

                

              

            </div>
            
               
        </div>
                
     <?php

    if(isset($_GET['cancel_status']))
    {
        alert('success','booking cancelled !');
    }

    ?>
     
    
    <?php require('inc/footer.php') ?>


    <script>
        function cancel_booking(id)
        {
           if(confirm('are you sure to cancel booking?'))
           {
                
            let xhr= new XMLHttpRequest();
            xhr.open("POST","ajax_db_index/cancel_booking.php",true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


            xhr.onload=function()
            {
                if(this.responseText==1){
                    window.location.href="bookings.php?cancel_status=true";
                }   

                else{
                    alert('error','cancellation failed');
                }
       

            }

            xhr.send('cancel_booking&id='+id);
             
            }


           }


        
    </script>

      
</body>
</html>