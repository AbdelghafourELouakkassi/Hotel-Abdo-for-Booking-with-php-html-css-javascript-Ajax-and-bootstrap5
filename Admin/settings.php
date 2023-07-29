<?php
 require('inc/essentials.php');
 adminLogin();
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Settings</title>
    <?php require('inc/links.php') ?>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
             <!-- general settings -->
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class='mb-3'>Settings</h3>
                <!-- shutdown section -->
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex aling-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">shutdown website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown_toggle" >
                                </form>
                            </div>
                        </div>
                        <p class="card-text">
                            No Customers will be allowed to book hotel room , when shutdown mode is turend on.
                        </p>
                       
                    </div>
                </div>
                <!-- end shut down section -->


            </div>
            <!-- end general settings -->
           

        </div>
        <!-- end row -->
    </div>
    <!-- end container dyal settings -->




<?php require('inc/script.php') ?>

<script src="scripts_ajax_admin/settings.js"></script>

</body>
</html>