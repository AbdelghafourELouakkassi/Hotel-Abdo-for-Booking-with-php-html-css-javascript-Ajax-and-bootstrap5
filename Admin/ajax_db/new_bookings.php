<?php
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();



    

    if(isset($_POST['get_bookings']))
    {
      $frm_data=filteration($_POST);

      $query="SELECT bo.*, bd.* FROM  `booking_order` bo
      INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
      WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)  
      AND (bo.booking_status =? AND bo.arrival=?) ORDER BY bo.booking_id ASC ";
      

      $res=select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","pending",0],"ssssi");
      $i=1;
      $table_data="";

      if(mysqli_num_rows($res)==0){
        echo"<b> no data found!</b>";
        exit;
      }

      while($data =mysqli_fetch_assoc($res))
      {
         $date= date("d-m-Y",strtotime($data['datentime']));
         $checkin= date("d-m-Y",strtotime($data['check_in']));
         $checkout= date("d-m-Y",strtotime($data['check_out']));

         $table_data.="

            <tr>
              <td>$i</td>
              <td>
                 <span class='badge bg-primary'>
                    order id: $data[order_id]
                 </span>
                 <br>
                 <b>name:</b> $data[user_name]
                 <br>
                 <b>phone number:</b> $data[phonenum]
                 <br>
              </td>
              <td>
                 <b>room:</b> $data[room_name]
                 <br>
                 <b>price:</b> $data[price] dh
                 <br>
              </td>
              <td>
                 <b>checkin:</b> $checkin
                 <br>
                 <b>checkout:</b> $checkout
                 <br>
                 <b>paid:</b> $data[trans_amount]
                 <br>
                 <b>date:</b> $date
              </td>
              <td>
                  <button type='button' onclick='assign_room($data[booking_id])' class='btn text-white bg-info btn-sm fw-boold mb-2' data-bs-toggle='modal' data-bs-target='#assign_room'>
                    <i class='bi bi-check2-square pe-2'></i>Assign room
                  </button><br>
                  <button type='button' onclick='cancel_booking($data[booking_id])' class='btn text-white bg-danger btn-sm fw-boold' data-bs-toggle='modal'>
                    <i class='bi bi-trash pe-2'></i>Cancel Booking
                  </button>
              </td>

            </tr>

          ";
        

        $i++;

      }


      echo  $table_data;



        
    }
    


    if(isset($_POST['assign_room']))
    {
     
    $frm_data=filteration($_POST);

    $query= "UPDATE `booking_order` bo INNER JOIN `booking_details` bd
    ON bo.booking_id=bd.booking_id SET bo.arrival=?,bd.room_no=?
    WHERE bo.booking_id=?";

    $values=[1,$frm_data['room_no'],$frm_data['booking_id']];

    $res=update($query,$values,'isi');

    echo ($res==2) ? 1 : 0 ;
  
     
    }


   





    



     
    if(isset($_POST['cancel_booking']))
    {
      
      $frm_data=filteration($_POST);

      $query= "UPDATE `booking_order` SET `booking_status`=?, `refund`=? WHERE `booking_id`=?";
 
 
      $values=['cancelled',0,$frm_data['booking_id']];
  
      $res=update($query,$values,'sii');
  
      echo $res;

    }


   
     
     
      
  
  





    if(isset($_POST['search_user']))
    {
          
        $frm_data=filteration($_POST);
        
        $query="SELECT * FROM `user_info` WHERE `name` LIKE ?";

        $res=select($query,["%$frm_data[name]%"],'s');
        $i=1;

        $path=USERS_IMG_PATH;

        $data="";

        while($row=mysqli_fetch_assoc($res)){


        $delbtn=  "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger text-light btn-sm'>
        <i class='bi bi-trash'></i>
        </button>" ; 

        $verified="<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";

        if($row['is_verified']){

          $verified="<span class='badge bg-success'><i class='bi bi-check-lg'></i></i></span>";
          $delbtn="";

        }

        $status="<button onclick='toggle_status($row[id],0)' class='btn btn-dark text-light'>active</button>";

        if(!$row['status']){

          $status="<button onclick='toggle_status($row[id],1)' class='btn btn-danger text-light'>inactive</button>";

        }


        $date=date("d-m-Y",strtotime($row['datentime']));
   
        $data.="
        <tr>
         <td>$i</td>
         <td><img src='$path$row[picture]' width='40px'></img><br>$row[name]</td>
         <td></td>
         <td>
          $row[phonenum]
         </td>
         <td>$row[adresse] | $row[pincode]</td>
         <td>$row[datebirth]</td>
         <td>$verified</td>
         <td>$status</td>
         <td>$date</td>
         <td>$delbtn</td>
         </tr>
         ";
         $i++;
  
        }
  
        echo $data;
        
    }

   
      
      
 ?>
 