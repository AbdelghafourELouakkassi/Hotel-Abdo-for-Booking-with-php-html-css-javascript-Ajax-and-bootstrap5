
   
   
   
   <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Hotel Abdo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
            <li class="nav-item ">
            <a class="nav-link active me-2 " aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active me2" aria-current="page" href="rooms.php">Rooms</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active me2" aria-current="page" href="facilities.php">Facilities</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active me-2" aria-current="page" href="contact.php">Contact us</a>
            </li> 
            <li class="nav-item">
            <a class="nav-link active me-2" aria-current="page" href="about.php">About us</a>
            </li> 
        </ul>
        <div class="d-flex">

            <?php
             
             if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                 
                $path=USERS_IMG_PATH;
                echo<<<data
                     
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                          <img src="$path$_SESSION[upic]" style="width:25px ; height:25px ;" class="me-1 rounded-circle"  >
                          $_SESSION[uname]
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item"  href="profile.php" >Profile</a></li>
                            <li><a class="dropdown-item"  href="bookings.php" >Bookings</a></li>
                            <li><a class="dropdown-item"  href="logout.php" >logout</a></li>
                        </ul>
                    </div>
                data;

             }
             
             else{

                echo<<<data

                 <button type="button" class="btn btn-outline-dark me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#LoginModal">
                 Login
                 </button>
                 <button type="button" class="btn btn-outline-dark me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#RegisterModal">
                 Register
                 </button>

                 data;


             }


            ?>

        </div>
        </div>
    </div>
    </nav>
    <!-- close navbar -->

    <!-- container for log and register modal -->
    <div class="container-fluid">

    <div class="modal fade" id="LoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="login_form">

                        <div class="modal-header">
                            <h5 class="modal-title d-flex align-items-center" >
                            <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                            </h5>
                            <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email/mobile</label>
                            <input type="text" name="email_mob" required  class="form-control shadow-none" >
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="passw"  required  class="form-control shadow-none" >
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">Login</button>
                        <button class="btn btn-primary" data-bs-target="#ForgotModal" data-bs-toggle="modal" data-bs-dismiss="modal">
                        Forgot Password?
                        </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>


    <div class="modal fade" id="ForgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="forgot_form">

                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center" >
                        <i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password
                        </h5>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                           Note: a link will be sent to your email to reset yout password
                        </span>
                    <div class="mb-3">
                        <label class="form-label">email</label>
                        <input type="text" name="email" required  class="form-control shadow-none" >
                    </div>
    
                    <div class=" mb-2">
                    <button type="submit"  class="btn btn-dark shadow-none">Send link</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
</div>

    <div class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="register_form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center" >
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration
                        </h5>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                            Note: Your details must match with your ID(card,passport,driving,license,etc)
                            That will be required during check-in.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control shadow-none" required >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control shadow-none" required >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone number</label>
                                    <input name="phonenum" type="number" class="form-control shadow-none" required >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Picture of You</label>
                                    <input name="picture" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required >
                                </div>
                                <div class="col-md-12 ps-0 mb-3">
                                    <label class="form-label">Adresse</label>
                                    <textarea name="adresse"  class="form-control" id="exampleFormControlTextarea1" rows="1" required></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Pin Code</label>
                                    <input name="pincode" type="number" class="form-control shadow-none" required >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input name="datebirth" type="date" class="form-control shadow-none" required >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input name="passw" type="password" class="form-control shadow-none" required >
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input name="confirmpassw" type="password" class="form-control shadow-none" required >
                                </div>
                              
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-dark shadow-none">Register</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

     
   

    </div>
    <!-- close container for loginmodal and register modal -->