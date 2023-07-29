<?php
    require('../Admin/inc/db_config.php');
    require('../Admin/inc/essentials.php');
    require('../inc/sendgrid/sendgrid-php.php');
    date_default_timezone_set('Africa/Casablanca');

    

    function send_mail($uemail,$token,$type)
    {


        if($type == "email_confirmation"){
          $page='email_confirm.php';
          $subject='Account verification link';
          $content='confirm your email';
        }


        else{
          $page='index.php';
          $subject='Account reset link';
          $content='reset your account';
        }


        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("realvsmadrid2016@gmail.com", "HotelAbdo");
        $email->setSubject("$subject");
        $email->addTo($uemail);
        $email->addContent(
            "text/html",
             "click the link to $content:<br>
             <a href='".SITE_URL."$page?$type&email=$uemail&token=$token"."'>click me</a>"
        );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $sendgrid->send($email);
            return 1;

        } catch (Exception $e) {
            return 0;
        }
          
    }
        
    



    if(isset($_POST['register']))
    {

         $data=filteration($_POST);

        //  match password
       
        if($data['passw'] != $data['confirmpassw'] ){

            echo "pass_missmatch";
            exit;
        }


        //check user if already exist

        $u_exist=select("SELECT * FROM `user_info` WHERE `email` =? OR `phonenum`=? LIMIT 1 ",[$data['email'],$data['phonenum']],"ss");

        if(mysqli_num_rows($u_exist)!=0){
           $u_exist_fetch=mysqli_fetch_assoc($u_exist);
           echo ($u_exist_fetch['email']==$data['email'])? 'email_already' : 'phone_already';
           exit;

        }

        // upload image to server

        $img=uploaduserimage($_FILES['picture']);

        if($img=='inv_img'){
            echo 'inv_img';
            exit;
        }

        else if($img=='upd_failed'){
            echo 'upd_failed';
            exit;

        }


        //send confirmation link to user email

        $token=bin2hex(random_bytes(16));

        if(!send_mail($data['email'],$token,'email_confirmation')){
            echo "mail_failed";
            exit;
        }

        $enc_pass=password_hash($data['passw'],PASSWORD_BCRYPT);

        $query=" INSERT INTO `user_info` (`name`, `email`, `adresse`, `phonenum`, `pincode`, `datebirth`, `picture`, `password`,`token`) VALUES (?,?,?,?,?,?,?,?,?)";

        $values=[$data['name'],$data['email'],$data['adresse'],$data['phonenum'],$data['pincode'],$data['datebirth'],$img,$enc_pass,$token];

        if(insert($query,$values,"sssssssss")){
           echo 1; 
        }
        
        else{
            echo "ins_failed";
        }

    }









    if(isset($_POST['login']))
    {

      
      
       $data=filteration($_POST);

       //check user if already exist

       $u_exist=select("SELECT * FROM `user_info` WHERE `email`=? OR `phonenum`=? LIMIT 1 ",
       [$data['email_mob'],$data['email_mob']],"ss");

       if(mysqli_num_rows($u_exist)==0)
       {
       
          echo 'inv_email_mob';
          exit;
         
       }

       else
       { 

            $u_fetch=mysqli_fetch_assoc($u_exist);

            if($u_fetch['is_verified']==0)
            {
                echo 'not_verified';
                exit;

            }

            else if($u_fetch['status']==0)
            {
                echo 'inactive';
                exit;

            }

            else
            {
                if(!password_verify($data['passw'],$u_fetch['password']))
                {
                    echo 'invalid_passw';
                    exit;

                }

                else
                {
                    session_start();
                    $_SESSION['login']=true;
                    $_SESSION['uid'] = $u_fetch['id'];
                    $_SESSION['uname'] = $u_fetch['name'];
                    $_SESSION['upic'] = $u_fetch['picture'];
                    $_SESSION['uphone'] = $u_fetch['phonenum'];
                    echo 1;
                    exit;
            

                }
               
            }
        }
      
    }






    if(isset($_POST['forgot_passw'])){
          
        $data=filteration($_POST);

        //check user if already exist
 
        $u_exist=select("SELECT * FROM `user_info` WHERE `email`=? LIMIT 1",
        [$data['email']],"s");
 
        if(mysqli_num_rows($u_exist)==0)
        {
        
           echo 'inv_email';
           exit;
          
        }
 
        else
        { 
 
             $u_fetch=mysqli_fetch_assoc($u_exist);
 
             if($u_fetch['is_verified']==0)
             {
                 echo 'not_verified';
                 exit;
 
             }
 
             else if($u_fetch['status']==0)
             {
                 echo 'inactive';
                 exit;
 
             }
 
             else
             {
                $token=bin2hex(random_bytes(16));
                if(!send_mail($data['email'],$token,'account_recovery')){
                   echo'mail_failed';
                   exit;
                }

                else{
                    $date = date('Y-m-d');
                    $query= mysqli_query($con,"UPDATE `user_info` SET `token`='$token', `token_expire`='$date' WHERE `id`='$u_fetch[id]'");
                    
                    if($query){
                        echo 1;
                    }
                    else{
                        echo 'upd_failed';
                        exit;
                    }
                }
                 
                
             }
         }


    }

    

    if(isset($_POST['recover_user'])){
        
        $data=filteration($_POST);

        $enc_pass=password_hash($data['passw'],PASSWORD_BCRYPT);

        
        $t_date = date('Y-m-d');

        $query="UPDATE `user_info` SET `password`=?, `token`=?, `token_expire`=? WHERE `email`=? AND `token`=?";

        $values=[$enc_pass,null,null,$data['email'],$data['token']];

        if(update($query,$values,'sssss')==1)
        {
           echo 1;
        
        }

        else{
            echo 'failed';
            exit;
        }

    }
?>    

