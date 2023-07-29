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
    <title>Admin Panel-Rooms</title>
    <?php require('inc/links.php') ?>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden mt-4">
                <h3>Rooms</h3>


                <div class="card border-0 mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">    
                            <button type="button" class="btn btn-dark text-light" data-bs-toggle="modal" data-bs-target="#add_room">
                                <i class="bi bi-plus-square"></i> Add
                            </button>     
                        </div>

                        <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                            <table class="table table-hover text-center border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">area</th>
                                    <th scope="col">guests</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">status</th>
                                    <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">
                               
                                </tbody>
                                </table>
            
                        </div>
                      
                        </div>
               
                    </div>
            
                </div>
        
        </div>
     
    </div>
    




    <!-- add rom modal -->
    
    <div class="modal fade" id="add_room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
              <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
            
                    <div class="modal-header">
                    <h5 class="modal-title">Add room</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">name</label>
                                <input type="text" name="name" class="form-control">
                            </div>  

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">area</label>
                                <input type="number" min="1" name="area" class="form-control" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">price</label>
                                <input type="number" min="1" name="price" class="form-control" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">quantity</label>
                                <input type="number" min="1" name="quantity" class="form-control">
                            </div>          

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">adult(Max.)</label>
                                <input type="number" min="1" name="adult" class="form-control" >
                            </div>   

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">children(Max.)</label>
                                <input type="number" min="1" name="children" class="form-control" >
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">features</label>
                                <div class="row">
                                    <?php
                                    $res=selectAll('features');
                                    while($opt= mysqli_fetch_assoc($res)){
                                        echo "
                                        <div class='col-md-3 mb-4'>
                                            <label>
                                            <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                            $opt[name]
                                        </label> 
                                        </div>
                                        ";}
                                        ?>
                                </div>
                                
                            </div>
                            

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">facilities</label>
                                <div class="row">
                                    <?php
                                    $res=selectAll('facilities');
                                    while($opt= mysqli_fetch_assoc($res)){
                                        echo "
                                        <div class='col-md-3 mb-3'>
                                            <label>
                                            <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                            $opt[name]
                                            </label> 
                                        </div>
                                        ";
                                    }
                                    ?>
                                </div>
                                    
                           </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">description</label>
                                    <textarea name="description" class="form-control" rows="4" ></textarea>
                               </div>                  
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
      
    <!-- end add room modal -->





      <!-- add image rom modal -->
    
      <div class="modal fade" id="room_images" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">room name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="mb-3">
                            <form id="add_image_form">
                                <label class="form-label fw-bold">add image</label>
                                <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control mb-3" required>
                                <button class="btn btn-primary">add</button>
                                <input type="hidden" name="room_id">
                            </form>     
                        </div>  

                        <div class="table-responsive-md" style="height:350px; overflow-y:scroll;">
                            <table class="table table-hover text-center border">
                                <thead>
                                    <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">image</th>
                                    <th scope="col">thumb</th>
                                    <th scope="col">delete</th>
                                    </tr>
                                </thead>
                                <tbody id="room-image-data">
                               
                                </tbody>
                                </table>
            
                        </div>
                      

                    </div>
               </div>
       </div>
   </div>
      
    <!-- end image room modal -->
    






<?php require('inc/script.php') ?>
<script src="scripts_ajax_admin/rooms.js"></script>




 
</body>
</html>