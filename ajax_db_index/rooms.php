<?php
use Mpdf\Tag\H3;
require('../Admin/inc/db_config.php');
require('../Admin/inc/essentials.php');
date_default_timezone_set('Africa/Casablanca');


session_start();

if(isset($_GET['fetch_rooms']))
{

    $check_avail=json_decode($_GET['check_avail'],true);


    //checkin and checkout filter validations

    if( $check_avail['checkin']!='' &&  $check_avail['checkout']!='')
    {
    $today_date= new Datetime(date("Y-m-d"));
    $checkin_date= new Datetime($check_avail['checkin']);
    $checkout_date= new Datetime($check_avail['checkout']);

        if($checkin_date==$checkout_date)
        {
        
            echo "<h3 class='text-center text-danger'>Invalid Dates</h3>";
            exit;

        }

        else if($checkout_date < $checkin_date )
        {
            echo "<h3 class='text-center text-danger'>Invalid Dates</h3>";
            exit;
        }

        else if($checkin_date < $today_date)
        {
            echo "<h3 class='text-center text-danger'>Invalid Dates</h3>";
            exit;
        }
    }



    $guests=json_decode($_GET['guests'],true);
    $adults=($guests['adults']!='') ? $guests['adults'] : 0 ;
    $children=($guests['children']!='') ? $guests['children'] : 0 ;


    //facilities data decode

    $facility_list=json_decode($_GET['facility_list'],true);

    //count number of rooms
    $count_rooms=0;
    $output="";

    //fetch settings table to check website is shutdown
    $settings_q="SELECT * FROM `settings` WHERE `id_settings`=1";
    $settings_r=mysqli_fetch_assoc(mysqli_query($con,$settings_q));

    //query for room cards with guest filter

    $room_res=select("SELECT * FROM `rooms` WHERE `adult`>=? AND `children`>=? AND `status`=? AND `removed`=?",[$adults,$children,1,0],'iiii');

    while($room_data=mysqli_fetch_assoc($room_res)){

        //check availability filter 

        if( $check_avail['checkin']!='' &&  $check_avail['checkout']!='')
        {
            $tb_query="SELECT COUNT(*) AS `total_bookings` FROM `booking_order`
            WHERE booking_status=? AND room_id=?
            AND check_out > ? AND check_in < ?";
    
            $values=['pending',$room_data['id'],$check_avail['checkin'],$check_avail['checkout']];
    
            $tb_fetch=mysqli_fetch_assoc(select($tb_query,$values,'siss'));
           
    
            if(($room_data['quantity']-$tb_fetch['total_bookings'])==0){
    
              continue;
            }


        }

            
      //get facilities of room with filter

       $faci_count=0; 

        $faci_q=mysqli_query($con, "SELECT f.name, f.id FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
        WHERE rfac.room_id= '$room_data[id]' " );
        
        $facilities_data= "";
        while($faci_row=mysqli_fetch_assoc($faci_q))
        {
            if(in_array($faci_row['id'],$facility_list['facilities'])){
                $faci_count++;
            }
            $facilities_data.="<span class='badge rounded-pill text-dark bg-light text-wrap'>
            $faci_row[name]
            </span>";
        }

        if(count($facility_list['facilities'])!=$faci_count){
            continue;
        }





        //get features
     
        $feat_q=mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id
        WHERE rfea.room_id= '$room_data[id]' " );
       
       $features_data= "";
        while($feat_row=mysqli_fetch_assoc($feat_q)){
          $features_data.="<span class='badge rounded-pill text-dark bg-light text-wrap'>
          $feat_row[name]
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
              
              $book_btn="<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm w-100 btn-primary'>Book Now</button>" ;

          }

      $output.="
          <div class='card mb-4 border-1 border-dark shadow p-2'>
          <div class='row'>
          <div class='col-md-5'>
              <img src='$room_thumb' class='img-fluid rounded h-100 w-100 '>
          </div>

          <div class='col-md-3 '>
                  <h4>$room_data[name]</h4>
                  <div class='features mb-4 '>
                      <h6 class='mb-2'>Features</h6>
                      $features_data
                  </div>
                  <div class='facilities mb-4'>
                  <h6 class='mb-1'>Facilities</h6>
                      $facilities_data
                  
                  </div>

                  <div class='Guests mb-0'>
                      <h6 class='mb-1'>Guests</h6>
                          <div class='d-flex fs-5 p-2 flex-wrap'>
                          <span class='badge rounded-pill bg-light text-dark text-wrap'>
                          $room_data[adult] Adults
                          </span>
                          <span class='badge rounded-pill bg-light text-dark text-wrap'>
                          $room_data[children] Children
                          </span>
                          </div>
                  </div>
          </div>

          <div class='col-md-3'>
                  <div class='align-items-center mt-3 pt-5 ''>
                  <h5 class='mb-4'>$room_data[price] dh Per Night</h5>
                  $book_btn                             
                  </div>
                  <a href='rooms_details.php?id=$room_data[id]' class='btn btn-sm w-100 btn-light text-dark border border-dark my-3'>More details</a>                                </div>
          </div>

        </div>
      

         ";
        $count_rooms++;


        }

        if($count_rooms>0){
            echo $output;
        }

        else {
            echo "<h3 class='text-center text-danger'>no rooms to show !</h3>";
        }

}


?>