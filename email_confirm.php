<?php
    require('Admin/inc/db_config.php');
    require('Admin/inc/essentials.php');

  
    if(isset($_GET['email_confirmation'])){
      
      $data=filteration($_GET);

      $query=select("SELECT * FROM `user_info` Where `email`=? AND  `token`=? LIMIT 1",[$data['email'],$data['token']],'ss');

      if(mysqli_num_rows($query)==1)
      {

            $fetch=mysqli_fetch_assoc($query);

            if($fetch['is_verified']==1){
                echo "<script>alert('email already verified')</script>";
                redirect('index.php');
            }
            else{
                $update=update("UPDATE `user_info` SET `is_verified` =? WHERE `id` =? ",[1,$fetch['id']],'ii');

                if($update){
                    echo "<script>alert('email verification successful!')</script>";
                }

                else{
                    echo "<script>alert('email verification failed! server down')</script>";

                }

            }
            redirect('index.php');
            
      }

      else{
        echo "<script>alert('invalid link')</script>";
        redirect('index.php');

      }


    }






?>