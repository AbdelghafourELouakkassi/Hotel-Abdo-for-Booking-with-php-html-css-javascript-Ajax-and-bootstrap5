<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php') ?>
       
    <!-- check room id if present or not shutdown mode is active or not user is logged in or not -->

    <?php
    if(!isset($_GET['id']) || $settings_r['shutdown']==true){
       redirect("rooms.php");
    }


    else if(!isset($_SESSION['login']) && $_SESSION['login'] == true){
        redirect("rooms.php");
    }
    


    
    $data=filteration($_GET);

    $room_res=select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
        redirect("rooms.php");
    }

    $room_data=mysqli_fetch_assoc($room_res);

    $_SESSION['room']=[
      "id"=>$room_data['id'],
      "name"=>$room_data['name'],
      "price"=>$room_data['price'],
      "payment"=>null,
      "avilable"=>false,

    ];

    $user_res=select("SELECT * FROM `user_info` WHERE `id`=? LIMIT 1 ",
    [$_SESSION['uid']],"i");

    $user_data=mysqli_fetch_assoc($user_res);

    ?>

    <!-- container rooms and availability -->

        <div class="container-fluid">
            <div class="row ">
               
                <div class="fs-5 mb-4">
                    <h2 class="mt-5 pt-4 mb-4 fw-bold h-font fs-1">CONFITM BOOKING<h2>
                    <div class="fs-5">
                        <a href="index.php" class="text-secondary text-decoration-none ">HOME</a>
                        <span class="text-secondary"> > </span>
                        <a href="rooms.php" class="text-decoration-none text-secondary">ROOMS ></a>
                        <a href="#" class="text-decoration-none text-secondary">CONFIRM</a>
                    </div>
                </div>
               
                
                <div class="col-lg-7 col-md-12 mt-2  ">
                    
                   <?php
                      
                    $room_thumb=ROOMS_IMG_PATH."thumbnail.jpg";

                    $thumb_q=mysqli_query($con,"SELECT * FROM `room_images` 
                    WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                    if(mysqli_num_rows($thumb_q)>0){
                        $thumb_res=mysqli_fetch_assoc($thumb_q);
                        $room_thumb=ROOMS_IMG_PATH.$thumb_res['image'];
                    }

                    echo<<<data

                       <div class="card p-3 shadow-sm rounded">
                         <img src="$room_thumb" class="img-fluid rounded mb-3">
                         <h5>$room_data[name]</h5>
                         <h6>$room_data[price] DH per night</h6>
                       </div>
                  

                    data;


                   ?>

                </div>
               
             

                <div class="col-lg-5 col-md-12 px-4 mt-2">
                     
                      <div class="card p-3 shadow-sm rounded ">
                         <div class="card-body">
                            <form action="pay_now.php" method="post" id="booking_form">
                               <h6>BOOKING DETAILS</h6>
                               <div class="row">
                                   <div class="col-md-6  mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="name" type="text" value="<?php echo $user_data['name']  ?>" class="form-control shadow-none" required >
                                    </div>

                                    <div class="col-md-6  mb-3">
                                        <label class="form-label ">phone number</label>
                                        <input name="phonenum" type="number"  value="<?php echo $user_data['phonenum']  ?>"  class="form-control shadow-none" required >
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">address</label>
                                        <textarea name="adresse"  class="form-control"  rows="1" required><?php echo $user_data['adresse']?></textarea>

                                    </div>

                                    <div class="col-md-6  mb-3">
                                        <label class="form-label ">check-in</label>
                                        <input name="checkin" type="date" onchange="check_availability()"  class="form-control shadow-none" required >
                                    </div>

                                    <div class="col-md-6  mb-3">
                                        <label class="form-label ">check-out</label>
                                        <input name="checkout" type="date" onchange="check_availability()"  class="form-control shadow-none" required >
                                    </div>

                                    <div class="col-12">
                                        <div class="spinner-border text-info mb-3 d-none " id="info_loader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>

                                    <h6 class="text-danger" id="pay_info">provide check in & check out date !</h6>
                                    <div class="col-md-12  mt-2">
                                        <button name="pay_now" class=" btn btn-primary  w-100  text-white" disabled>Pay Now</button>
                                    </div>


                               </div>

                            </form>

                         </div>

                      </div>


                </div>

              
            
               
        </div>
                
     
     
    
    <?php require('inc/footer.php') ?>

    <script>

        
        let booking_form=document.getElementById('booking_form');
        let info_loader=document.getElementById('info_loader');
        let pay_info=document.getElementById('pay_info');

        function check_availability()
        {
            let checkin_val=booking_form.elements['checkin'].value;
            let checkout_val=booking_form.elements['checkout'].value;


            booking_form.elements['pay_now'].setAttribute('disabled',true);

            if(checkin_val!='' && checkout_val!='')
            {
                pay_info.classList.add('d-none')
                pay_info.classList.replace('text-dark','text-danger');
                info_loader.classList.remove ('d-none')

                let data=new FormData();

                data.append('check_availability','');
                data.append('check_in',checkin_val);
                data.append('check_out',checkout_val);


                let xhr= new XMLHttpRequest();
                xhr.open("POST","ajax_db_index/confirm_booking.php",true);
                
                xhr.onload=function()
                {

                    let data=JSON.parse(this.responseText);

                    if(data.status=='check_in_out equal'){
                        pay_info.innerText="you cannot check-out on the same day! ";
                    }

                    else if(data.status=="check_out_earlier"){
                        pay_info.innerText="check-out date is earlier than check-in date! ";
                    }

                    else if(data.status=="check_in_earlier"){
                        pay_info.innerText="check-in date is earlier than today's date! ";
                    }

                    else if(data.status=='unavailable'){
                        pay_info.innerText="room not available for this check-in date! ";
                    }

                    else{
                        pay_info.innerHTML="Number of Days "+data.days+"<br>Total Amount to Pay:"+data.payment+" "+"DH";
                        pay_info.classList.replace('text-danger','text-dark');
                        booking_form.elements['pay_now'].removeAttribute('disabled');

                    }


                    pay_info.classList.remove('d-none');
                    info_loader.classList.add('d-none');
              

                

                }
                xhr.send(data);


            }


            }
                

        



    </script>

   
   
</body>
</html>