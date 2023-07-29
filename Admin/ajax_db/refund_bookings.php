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
      AND (bo.booking_status =? AND bo.refund=?) ORDER BY bo.booking_id ASC ";
      

      $res=select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%","cancelled",0],"ssssi");
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
                 <b>checkin:</b> $checkin
                 <br>
                 <b>checkout:</b> $checkout
                 <br>
                 <b>date:</b> $date
                 <br>  
              </td>
              <td>
                 <b>$data[trans_amount] Dh</b> 
              </td>
              <td>
                  <button type='button' onclick='refund_booking($data[booking_id])' class='btn text-white bg-success btn-sm  fw-boold' data-bs-toggle='modal'>
                  <i class='bi bi-cash-stack p-1'></i>refund
                  </button>
              </td>

            </tr>

          ";
        

        $i++;

      }


      echo  $table_data;



        
    }
    


   

    if(isset($_POST['refund_booking']))
    {
      
      $frm_data=filteration($_POST);

      $query= "UPDATE `booking_order` SET `refund`=? WHERE `booking_id`=?";
 
 
      $values=[1,$frm_data['booking_id']];
  
      $res=update($query,$values,'ii');
  
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
 