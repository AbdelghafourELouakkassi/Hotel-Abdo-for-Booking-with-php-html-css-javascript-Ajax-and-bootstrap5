<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Abdo-Home</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php') ?>

    <!-- carousel -->
    <div class="container-fluid px-lg-4 mt-2">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item ">
            <img src="images/carousel/IMG_93127.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item active">
            <img src="images/carousel/IMG_99736.png" class="d-block w-100" alt="...">
            </div>
            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>
    <!-- end corousel -->

    <!-- check availability form -->
     <div class="container availability-form">
         <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded ">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form action='rooms.php'>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500 ;">Check-in</label>
                            <input type="date" class="form-control shadow-none" name="checkin" required>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500 ;">Check-out</label>
                            <input type="date" class="form-control shadow-none " name="checkout" required>
                        </div>

                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500 ;"required>Adult</label>
                            <select class="form-select shadow-none" name="adult">
                                <?php
                                $guests_q=mysqli_query($con,"SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children` 
                                FROM `rooms` WHERE `status`='1' AND `removed`='0'");
                                $guests_res=mysqli_fetch_assoc($guests_q);

                                for($i=1;$i<=$guests_res['max_adult'];$i++){

                                    echo"<option value='$i'>$i</option>";

                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight:500 ;">Children</label>
                            <select class="form-select shadow-none" name="children">
                                <?php        
                                for($i=1;$i<=$guests_res['max_children'];$i++){
                                    echo"<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="check_availability">
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow custom-bg bg-primary ">submit</button>
                        </div>

                    </div>
                </form>

            </div>
         </div>
     </div>
    
    <!-- close check availability form -->

    <!-- our rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS<h2>
    <div class="container">
        <div class="row">

        
                    <?php
                            $room_res=select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?  ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

                            while($room_data=mysqli_fetch_assoc($room_res)){

                            $feat_q=mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                            WHERE rfea.room_id= '$room_data[id]' " );

                            //get features
                            
                            $features_data= "";
                            while($feat_row=mysqli_fetch_assoc($feat_q)){
                                $features_data.="<span class='badge rounded-pill text-dark bg-light text-wrap'>
                                $feat_row[name]
                                </span>";
                            }
                            

                            
                            //get facilities

                            $faci_q=mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                            WHERE rfac.room_id= '$room_data[id]' " );
                        
                           $facilities_data= "";
                            while($faci_row=mysqli_fetch_assoc($faci_q)){
                            $facilities_data.="<span class='badge rounded-pill text-dark bg-light text-wrap'>
                            $faci_row[name]
                            </span>";
                        }
                    

                            //get thumbnail of image

                            $room_thumb=ROOMS_IMG_PATH."thumbnail.jpg";

                            $thumb_q=mysqli_query($con,"SELECT * FROM `room_images` 
                            WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                            if(mysqli_num_rows($thumb_q)>0){
                                $thumb_res=mysqli_fetch_assoc($thumb_q);
                                $room_thumb=ROOMS_IMG_PATH.$thumb_res['image'];
                            }


                         
                        $book_btn="";

                        if(!$settings_r['shutdown']){
                            
                            $login=0;

                            if(isset($_SESSION['login'])&& $_SESSION['login']==true){
                                $login=1;
                            }
                            
                            $book_btn="<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-md btn-primary'>Book Now</button>";

                        }


                    





                        //print room data; 
                          echo<<<data
                            <div class="col-lg-4 col-md-6 my-3 fs-4">
                                 <div class="card border-0 shadow" style="max-width: 350px; margin:auto;">
                                    <img src="$room_thumb" class="card-img-top">
                                    <div class="card-body">
                                        <h5>$room_data[name]</h5>
                                        <h6 class="mb-4">$room_data[price] dh Per Night</h6>
                                        <div class="features mb-4">
                                            <h6 class="mb-2">Features</h6>
                                            <div class="d-flex flex-row justify-content-between flex-wrap row-lg-6">
                                            <span class="badge rounded-pill bg-light text-dark">
                                            $features_data
                                            </span>
                                            </div>
                                        </div>
                                        <div class="facilities mb-4">
                                        <h6 class="mb-1">Facilities</h6>
                                            <div class="d-flex flex-row justify-content-between row-lg-6 flex-wrap">
                                            <span class="badge rounded-pill bg-light text-dark">
                                            $facilities_data
                                            </span>
                                            </div>
                                        </div>
                                        <div class="Guests mb-4">
                                            <h6 class="mb-1">Guests</h6>
                                                <div class="d-flex flex-row flex-wrap">
                                                <span class="badge rounded-pill bg-light text-dark">
                                                $room_data[adult] Adults
                                                </span>
                                                <span class="badge rounded-pill bg-light text-dark">
                                                $room_data[children] Children
                                                </span>
                                                </div>
                                        </div>
                
                                        <div class="rating mb-4">
                                            <h6 class="mb-1">Rating</h6>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        
                                        </div>
                
                                        <div class="d-flex justify-content-evenly mb-2">
                                        $book_btn
                                        <a href="rooms_details.php?id=$room_data[id]" class="btn btn-md  btn-outline-dark rounded fw-bold shadow-none">More details</a>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
            
                        
                                
                                   
        
                            data;
        
                            }
        
                            ?>
                    
                   
                                    

            <div class="col-lg-12 text-center mt-5">
              <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded fw-bold shadow-none">More Rooms >>></a>
            </div>
            
        </div>
    </div>
    <!-- close our rooms -->
    
    <!-- our facilities -->
    <div id="facilities"></div>
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES<h2>


  
        <div class="container">

            <div class="row justify-content-evenly">

            <?php
                $res=mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
                $path=FACILITIES_IMG_PATH;


                while($row=mysqli_fetch_assoc($res)){
                    echo <<<data
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                        <img src="$path$row[icon]" width="40px">
                        <h5 class="mt-3">$row[name]</h5>
                    </div>
                
                    data ;

                    }

                ?>
                    
        <div class="col-lg-12 text-center mt-5">
              <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded fw-bold shadow-none">More Facilities >>></a>
        </div>
        </div>
        </div>
    <!-- close our facilities -->
    
 
    <!--TESTIMONIAL-->
    <h2 class="my-5 text-center fw-bold h-font">What Our Clients Say About Us<h2>

    <div class="container-fluid d-flex flex-wrap justify-content-center mb-5">
        <div class="card col-lg-2 m-1" style="width: 35rem; ">
            <img src="images/testmonials/1.png" class="card-img-top">
        </div>
        <div class="card col-lg-2 m-1" style="width: 35rem;">
            <img src="images/testmonials/2.png" class="card-img-top">
        </div>
        <div class="card col-lg-2 m-1" style="width: 35rem;">
            <img src="images/testmonials/3.png" class="card-img-top">
        </div>
        <div class="card col-lg-2 m-1" style="width: 35rem;">
            <img src="images/testmonials/4.png" class="card-img-top">
        </div>
    </div>
    
    
    <!-- END TETIMONIAL -->


        <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="recovery_form">

                        <div class="modal-header">
                            <h5 class="modal-title d-flex align-items-center" >
                            <i class="bi bi-shield-lock fs-3 me-2"></i> Set up a new password
                            </h5>
                            <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">new password</label>
                            <input type="password" name="passw" required  class="form-control shadow-none" >
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>
        
                        <div class=" mb-2">
                        <button type="submit"  class="btn btn-dark shadow-none">Submit</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
   
    
    <?php require('inc/footer.php') ?>

    <?php
        if(isset($_GET['account_recovery'])){
        
            $data=filteration($_GET);
            
            $t_date = date('Y-m-d');

            $query=select("SELECT * FROM `user_info` WHERE `email`=? AND `token`=? AND `token_expire`=? LIMIT 1",
            [$data['email'],$data['token'],$t_date],"sss");
    
            if(mysqli_num_rows($query)==1)
            {
            echo<<<showModal
                <script>
                    var myModal=document.getElementById('recoveryModal');
                    
                    myModal.querySelector("input[name='email']").value = '$data[email]';
                    myModal.querySelector("input[name='token']").value = '$data[token]';


                    var modal=bootstrap.Modal.getOrCreateInstance(myModal);
                    modal.show();
            
                </script> 

            showModal;
            
            }

            else{
                alert('error','invalid or expired link');
            }
    
        }



        
        
        ?>


    <script>

        let recovery_form=document.getElementById('recovery_form');

        recovery_form.addEventListener('submit',(e)=>{
            e.preventDefault();

            let data =new FormData();
            data.append('email',recovery_form.elements['email'].value);
            data.append('token',recovery_form.elements['token'].value);
            data.append('passw',recovery_form.elements['passw'].value);
            data.append('recover_user','');

            var myModal=document.getElementById('recoveryModal');
            var modal=bootstrap.Modal.getInstance(myModal);
            modal.hide();
                

            let xhr= new XMLHttpRequest();
            xhr.open("POST","ajax_db_index/login_register.php",true);
            
            xhr.onload=function()
            {

    
            if(this.responseText == "failed")
            {
            alert ('error','account reset failed ');
            }

            else{
            alert ('success','account recover successful');
            recovery_form.reset();

            }

            

        }
        xhr.send(data);


        });

    </script>

   
   
</body>
</html>