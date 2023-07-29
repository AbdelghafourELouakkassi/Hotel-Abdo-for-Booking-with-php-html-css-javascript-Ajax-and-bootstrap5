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
    <title>Admin Panel-Bookings Records</title>
    <?php require('inc/links.php') ?>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden mt-4">
                <h3>bookings Records</h3>


                <div class="card border-0 mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">    
                            <input type="text" id="search_input" oninput="get_bookings(this.value)" class="form-control w-25 m-auto " placeholder="type to search"  >
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border" style="min-width:1200px;">
                                <thead>
                                    <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">user details</th>
                                    <th scope="col">room details</th>
                                    <th scope="col">bookings details</th>
                                    <th scope="col">status</th>
                                    <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                               
                                </tbody>
                                </table>
            
                        </div>
                
                        
                    </div>
                        
                    <nav">
                        <ul class="pagination mt-3" id="table-pagination">

                    
                        
                        </ul>
                    </nav>
                    </div>
                    
                </div>
        
        </div>
     
    </div>


      <!-- assing room number modal -->
  
      <div class="modal fade" id="assign_room" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form id="assign_room_form">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Assign Room</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Room Number</label>
                        <input type="text" name="room_no" id="feature_name_inp" class="form-control" required>
                    </div>                  
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                               Note: assign room number only when user has been arrived! 
                    </span>
                    <input type="hidden" name="booking_id">
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">submit</button>
                </div>
              </div>
            </form>
            </div>
         </div>
        <!-- end assign room number modal -->

    




   





<?php require('inc/script.php') ?>
<script src="scripts_ajax_admin/bookings_records.js"></script>




 
</body>
</html>