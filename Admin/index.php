<?php
    require('inc/db_config.php');
    require('inc/essentials.php');

    session_start();
    if((isset($_SESSION['adminLogin'] ) && $_SESSION['adminLogin']==true )){
       redirect('dashboard.php');
    }

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php') ?>
    <style>
     .form{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50% ,-50%);
        text-align: center;
     }
    </style>
</head>
<body class="bg-light">
    
        <div class="container-fluid">
            <div class=" text-center form">
            <form method="POST">
                <h4 class="p-2">ADMIN LOGIN PANEL</h4>
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none w-100 text-center border-1 border-dark" placeholder="Admin Name" >
                </div>
                <div class="mb-4">
                    <input name="admin_password" required type="password" class="form-control shadow-none w-100 text-center border-1 border-dark" placeholder="password" >
                </div>
                <button name="login" type="submit" class="btn text-white bg-primary border-1 border-dark">Login</button>
            </form>
            </div>
        </div>

<?php

if(isset($_POST['login']))
{

   $frm_data=filteration($_POST);
   $query= "SELECT * FROM `admin_panel` WHERE `admin_name`=? AND `admin_password`=? " ;
   $values=[$frm_data['admin_name'],$frm_data['admin_password']];

   $res = select($query,$values,"ss");
   if($res->num_rows==1){
      $row=mysqli_fetch_assoc($res);
      $_SESSION['adminLogin']=true;
      $_SESSION['adminId']=$row['id_admin'];
      redirect('dashboard.php');


   }

   else{
    alert('error','login failed-invalid credentials !');
   }
}

?>

<?php require('inc/script.php') ?>
</body>
</html>