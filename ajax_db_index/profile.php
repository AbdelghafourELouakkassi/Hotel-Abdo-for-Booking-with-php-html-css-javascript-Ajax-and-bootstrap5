<?php
    require('../Admin/inc/db_config.php');
    require('../Admin/inc/essentials.php');
    require('../inc/sendgrid/sendgrid-php.php');

    date_default_timezone_set('Africa/Casablanca');

    
    if(isset($_POST['info_form']))
    {

        $frm_data=filteration($_POST);
        session_start();
        
       //check user if already exist

       $u_exist=select("SELECT * FROM `user_info` WHERE `phonenum`=? AND `id` !=? LIMIT 1 ",
       [$data['phonenum'],$_SESSION['uid']],"ss");

       if(mysqli_num_rows($u_exist)!=0)
       {
       
          echo 'phone_already';
          exit;
         
       }

       $query="UPDATE `user_info` SET `name`=? ,`adresse` =?, `phonenum`=?, `pincode`=?, `datebirth`=? WHERE `id`=? ";

       $values=[$frm_data['name'],$frm_data['adresse'],$frm_data['phonenum'],$frm_data['pincode'],$frm_data['datebirth'],$_SESSION['uid']];
    
       
       if(update($query,$values,'ssssss')){
           $_SESSION['uname']=$frm_data['name'];
           echo 1;
       }

       else{
           echo 0;
       }
        
    }


    


    if(isset($_POST['picture_form']))
    {

       session_start();

       $img=uploaduserimage($_FILES['picture']);

       if($img=='inv_img'){
           echo 'inv_img';
           exit;
       }

       else if($img=='upd_failed'){
           echo 'upd_failed';
           exit;

       }

        
       //check user if already exist

       $u_exist=select("SELECT picture FROM `user_info` WHERE `id`=? LIMIT 1 ",[$_SESSION['uid']],"s");

       $u_fetch=mysqli_fetch_assoc($u_exist);

     
       $query="UPDATE `user_info` SET `picture`=? WHERE `id`=? ";

       $values=[$img,$_SESSION['uid']];
    
       
       if(update($query,$values,'ss')){
           $_SESSION['upic']=$img;
           echo 1;
       }

       else{
           echo 0;
       }
        
    }




    

?>    

