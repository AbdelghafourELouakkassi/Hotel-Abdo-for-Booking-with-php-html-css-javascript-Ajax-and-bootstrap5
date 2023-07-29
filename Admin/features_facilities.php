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
    <title>Admin Panel-features_facilities</title>
    <?php require('inc/links.php') ?>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden mt-4">
                <h3>Features and Facilities</h3>
        
                 <!-- fetures card -->
                <div class="card border-0 mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">   
                            <h5 class="card-title m-0">features</h5>
                            <button type="button" class="btn btn-dark text-light" data-bs-toggle="modal" data-bs-target="#feature_s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>     
                        </div>
                        
                        <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                            <table class="table table-hover  border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody id="features_data">
                               
                                </tbody>
                                </table>
            
                            </div>
                      
                        </div>
                </div>
                <!-- end features card -->


                <!-- facilities card -->

                <div class="card border-0 mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">   
                            <h5 class="card-title m-0">facilities</h5>
                            <button type="button" class="btn btn-dark text-light" data-bs-toggle="modal" data-bs-target="#facility_s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>     
                        </div>
                        
                        <div class="table-responsive-md" style="height:350px; overflow-y:scroll;">
                            <table class="table table-hover  border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                    <th scope="col">id</th>
                                    <th scope="col">icon</th>
                                    <th scope="col">name</th>
                                    <th scope="col" width="40%">description</th>
                                    <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities_data">
                               
                                </tbody>
                                </table>
            
                            </div>
                      
                        </div>
                </div>
                <!-- end fecilities card -->



            
             </div>
        
            </div>
     
        </div>


        <!-- features modal -->
  
        <div class="modal fade" id="feature_s" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form id="feature_s_form">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Feature</h5>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">name</label>
                            <input type="text" name="feature_name" id="feature_name_inp" class="form-control" required>
                        </div>                  
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">submit</button>
                </div>
              </div>
            </form>
            </div>
         </div>
        <!-- end features modal -->



         <!-- features modal -->

         <div class="modal fade" id="facility_s" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form id="facility_s_form">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Facility</h5>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">name</label>
                            <input type="text" name="facility_name" id="facility_name_inp" class="form-control" required>
                        </div>                  
                        <div class="mb-3">
                            <label class="form-label fw-bold">picture</label>
                            <input type="file" name="facility_icon" accept=".svg" class="form-control" required>
                        </div>                  
                        <div class="mb-3">
                            <label class="form-label fw-bold">description</label>
                            <textarea class="form-control" name="facility_desc" rows="3"></textarea>
                        </div>                  
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">submit</button>
                </div>
              </div>
            </form>
            </div>
         </div>
        <!-- end features modal -->




<?php require('inc/script.php') ?>
<script src="scripts_ajax_admin/features_facilities.js"></script>

   
</body>
</html>