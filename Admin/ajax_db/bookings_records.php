<?php
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();



    

    if(isset($_POST['get_bookings']))
    {
      $frm_data=filteration($_POST);


      $limit=2;
      $page=$frm_data['page'];
      $start=($page-1 ) * $limit;

      $query="SELECT bo.*, bd.* FROM  `booking_order` bo
      INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
      WHERE (bo.booking_status ='pending' AND bo.arrival=1)
      OR (bo.booking_status ='cancelled' AND bo.refund=1)
      OR (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?)
      ORDER BY bo.booking_id DESC ";

      $res=select($query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%"],"sss");
      
      $limit_query=$query."LIMIT $start,$limit";
      $limit_res=select($limit_query,["%$frm_data[search]%","%$frm_data[search]%","%$frm_data[search]%"],"sss");
      
      $i=1;
      $table_data="";

      $total_rows= mysqli_num_rows($res);

      if($total_rows==0){
        $output=json_encode(["table_data"=>"<b>no data found!</b>","pagination"=>'']);
        echo $output;
        exit;
      }

      $i=$start+1;

      $table_data="";

      while($data =mysqli_fetch_assoc($limit_res))
      {
         $date= date("d-m-Y",strtotime($data['datentime']));
         $checkin= date("d-m-Y",strtotime($data['check_in']));
         $checkout= date("d-m-Y",strtotime($data['check_out']));
         
         if($data['booking_status']=='pending'){
          $status_bg='bg-success';
         }

         else if($data['booking_status']=='cancelled'){
          $status_bg='bg-danger';
         }

         else{
          $status_bg='bg-warning text-dark';
         }
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
                 <b>price:</b> $data[price] Dh
                 <br>
              </td>
              <td>
                <b>amount: </b>$data[trans_amount] Dh
                <br>  
                <b>date:</b> $date
              </td>
              <td>
                 <span class='badge $status_bg'>$data[booking_status]</span>
              </td>
              <td>
              <button type='button' onclick='download($data[booking_id])' class='btn btn-outline-dark btn-sm fw-bold '><i class='bi bi-file-earmark-arrow-down-fill'></i>
              </button>

              </td>

            </tr>

          ";
        

        $i++;
       
      }

      
       
      $pagination="";

      if($total_rows>$limit)
      {

        $total_pages=ceil($total_rows/$limit);

          
        if($page!=1){
          $pagination.="<li class='page-item'>
          <button class='page-link' onclick='change_page(1)'>first</button></li>";
        }

        $disabled=($page==1) ? "disabled" : "";
        $prev=$page-1;
        $pagination .="<li class='page-item $disabled' >
        <button class='page-link' onclick='change_page($prev)'>Prev</button></li>";
        
        $disabled=($page==$total_pages) ? "disabled" : "";
        $next=$page+1;        
        $pagination .="<li class='page-item'>
        <button class='page-link' onclick='change_page($next)' >Next</button></li>";
        
        if($page!=$total_pages){
          $pagination.="<li class='page-item'>
          <button class='page-link' onclick='change_page($total_pages)'>Last</button></li>";
        }

      }



      $output=json_encode(["table_data"=>$table_data,"pagination"=>$pagination]);
      echo  $output;



        
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
 