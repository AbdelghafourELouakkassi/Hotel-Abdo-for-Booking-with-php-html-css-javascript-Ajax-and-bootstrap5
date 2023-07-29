<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Merienda&family=PT+Sans&family=Poppins:ital,wght@0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/style.css">


<?php

session_start();
date_default_timezone_set('Africa/Casablanca');

require('Admin/inc/db_config.php');
require('Admin/inc/essentials.php');



$settings_q="SELECT * FROM `settings` WHERE `id_settings`=?";
$values=[1];
$settings_r=mysqli_fetch_assoc(select($settings_q,$values,'i'));

if($settings_r['shutdown']){

    echo<<<alertbar
      <div class="bg-danger text-center p-2 fw-bold">
         Bookings are temporarily closed!

      </div>


    alertbar;

}



?>