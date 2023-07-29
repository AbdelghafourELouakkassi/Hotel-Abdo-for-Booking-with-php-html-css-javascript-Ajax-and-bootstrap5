<?php
 require('inc/essentials.php');
 require('inc/db_config.php');
 adminLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-Users</title>
    <?php require('inc/links.php') ?>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden mt-4">
                <h3>Users</h3>


                <div class="card border-0 mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">    
                            <input type="text" oninput="search_user(this.value)" class="form-control w-25 m-auto " placeholder="type to search"  >
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover text-center border" style="min-width:1300px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">phone no</th>
                                    <th scope="col">location</th>
                                    <th scope="col">datebirth</th>
                                    <th scope="col">verified</th>
                                    <th scope="col">status</th>
                                    <th scope="col">datentime</th>
                                    <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody id="users-data">
                               
                                </tbody>
                                </table>
            
                        </div>
                      
                        </div>
               
                    </div>
            
                </div>
        
        </div>
     
    </div>
    




   





<?php require('inc/script.php') ?>
<script src="scripts_ajax_admin/users.js"></script>




 
</body>
</html>