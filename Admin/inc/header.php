<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
        <h3 class="mb-0">Hotel Abdo </h3>
       <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
    </div>

   
   <!-- dashboard side bar column -->
    <div class="col-lg-2 bg-dark border-top border-1 border-secondary dashboard-menu">
        <div class="container-fluid">
           

            <!-- dashboart-navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
                <div class="container-fluid flex-lg-column  align-items-stretch">
                    <h5 class="mt-2 text-light  ">ADMIN PANEL</h5>
                    <button class="navbar-toggler bg-light ml-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                    </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav d-flex flex-column">
                    <li class="nav-item ms-2">
                        <a class="nav-link text-white" href="users.php">Users</a>
                      </li>
                      <li class="nav-item ms-2">
                         <a class="nav-link text-white" href="user_queries.php">Users Queries</a>
                       </li> 
                      <li class="nav-item ms-1">
                        <button class="btn text-white" type="button" data-bs-toggle="collapse" data-bs-target="#bookinglinks">
                          <span>Bookings</span>
                          <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>  
                        <div class="collapse" id="bookinglinks">
                            <ul class="nav nav-pills ms-3">
                              <div class="col-4">
                              <li class="nav-item">
                                <a class="nav-link text-white" href="new_bookings.php">New bookings</a>
                              </li>     
                              <li class="nav-item">
                                <a class="nav-link text-white" href="refund_bookings.php"> Refund bookings</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link text-white" href="bookings_records.php">bookings Record</a>
                              </li>
                              </div>
                        
                            </ul>
                        </div>                    
                      </li>
                    
                      <li class="nav-item ms-2">
                        <a class="nav-link text-white" href="rooms.php">Rooms</a>
                      </li>
                      <li class="nav-item ms-2">
                        <a class="nav-link text-white" href="features_facilities.php">features and facilities </a>
                      </li>
                      <li class="nav-item ms-2">
                        <a class="nav-link text-white" href="settings.php">Settings</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            <!-- end dashboard-navbar -->
                   
                

      </div>
    </div>
    <!-- end dashboard sidebar -->