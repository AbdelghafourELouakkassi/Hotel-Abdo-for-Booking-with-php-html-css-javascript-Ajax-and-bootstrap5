<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Abdo-Rooms_Details</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php') ?>
       


    <?php
    if(!isset($_GET['id'])){
       redirect("rooms.php");
    }
    
    $data=filteration($_GET);

    $room_res=select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
        redirect("rooms.php");
    }

    $room_data=mysqli_fetch_assoc($room_res);

    ?>

    <!-- container rooms and availability -->

        <div class="container-fluid">
            <div class="row ">
               
                <div class="fs-5 mb-4">
                    <h2 class="mt-5 pt-4 mb-4 fw-bold h-font fs-1"><?php echo $room_data['name'] ?><h2>
                    <div class="fs-5">
                        <a href="index.php" class="text-secondary text-decoration-none ">HOME</a>
                        <span class="text-secondary"> > </span>
                        <a href="rooms.php" class="text-decoration-none text-secondary">ROOMS</a>
                    </div>
                </div>
               
                
                <div class="col-lg-7 col-md-12  ">
                    <div id="roomCarousel" class="carousel slide" data-bs-ride="carouse">
                        <div class="carousel-inner">
                            <?php
                                $room_img=ROOMS_IMG_PATH."thumbnail.jpg";

                                $img_q=mysqli_query($con,"SELECT * FROM `room_images` 
                                WHERE `room_id`='$room_data[id]' ");
            
                                if(mysqli_num_rows($img_q)>0)
                                {
                                   $active_class='active';

                                   while($img_res=mysqli_fetch_assoc($img_q))
                                   {
                                       echo "<div class='carousel-item $active_class'>
                                       <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded-1'>
                                       </div>";
                                       $active_class='';
                                   }

                                }

                                else{
                                    echo "<div class='carousel-item active'>
                                            <img src='$room_img' class='d-block w-100'>
                                         </div>";
                                   }
                              
                            ?>

                            

                        </div>
                      </div>
                </div>
               
             

               
                <div class="col-lg-5 col-md-12 px-4">
                     
                      <div class="card border-0 shadow-sm ">
                         <div class="card-body">
                            <?php
                            echo<<<price
                            <h4 class="mb-4">$room_data[price] dh Per Night</h4>
                            price;
                            
                            echo<<<rating

                            <div class="mb-2">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>


                            rating;

                            $feat_q=mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                             WHERE rfea.room_id= '$room_data[id]' " );
                                             
                            $features_data= "";
                                while($feat_row=mysqli_fetch_assoc($feat_q)){
                                  $features_data.="<span class='badge rounded-pill text-dark bg-light text-wrap'>
                                  $feat_row[name]
                                  </span>";
                              }

                            echo<<<features
                                <div class=" mb-4">
                                    <h6 class="mb-1">Features</h6>
                                    $features_data
                               </div>

                            features;

                            $faci_q=mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                            WHERE rfac.room_id= '$room_data[id]' " );
                   
                            $facilities_data= "";
                                while($faci_row=mysqli_fetch_assoc($faci_q)){
                                  $facilities_data.="<span class='badge rounded-pill text-dark bg-light text-wrap'>
                                  $faci_row[name]
                                  </span>";
                            }

                            echo<<<facilities
                            <div class="mb-4">
                                <h6 class="mb-1">Facilities</h6>
                                $facilities_data
                            </div>

                            facilities;
 
                            echo<<<guest
                            <div class="mb-0">
                                <h6 class="mb-1">Guests</h6>
                                <div class="d-flex fs-5 p-2 flex-wrap">
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    $room_data[adult] Adults
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    $room_data[children] Children
                                    </span>
                                </div>
                            </div>

                            guest;
                            
                            echo<<<area
                            <div class="mb-2">
                            <h6 class="mb-1">Area</h6>
                            $room_data[area]
                            </div>
                            area;


                            $book_btn="";

                            if(!$settings_r['shutdown']){

                                $login=0;

                                if(isset($_SESSION['login'])&& $_SESSION['login']==true){
                                    $login=1;
                                }
                                
                                $book_btn="<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm w-100 btn-primary'>Book Now</a>" ;

                            }

                            echo<<<book
                                $book_btn
                            book;

                            ?>

                         </div>

                      </div>


                </div>

              
            
                <div class="col-lg-12 mt-4 px-4">
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p>
                        <?php  echo $room_data['description']?>
                        </p>
                        

                    </div>
                </div>
        </div>
                
     
     
    
    <?php require('inc/footer.php') ?>

   
   
</body>
</html>