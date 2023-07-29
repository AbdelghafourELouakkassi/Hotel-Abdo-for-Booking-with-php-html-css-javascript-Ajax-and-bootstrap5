<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php');
    
    if(!isset($_SESSION['login']) && $_SESSION['login'] == true){
        redirect("index .php");
    }
    

    $u_exist=select("SELECT * FROM `user_info` WHERE `id` =? LIMIT 1 ",[$_SESSION['uid']],"s");

    if(mysqli_num_rows($u_exist)==0){
        redirect('index.php');
    }

    $u_fetch=mysqli_fetch_assoc($u_exist);
   
   ?>



       
 

    <!-- container rooms and availability -->

        <div class="container-fluid">
            <div class="row ">
               
                <div class="fs-5 mb-4">
                    <h2 class=" pt-4 mb-4 fw-bold h-font fs-1">Profile<h2>
                    <div class="fs-5">
                        <a href="index.php" class="text-secondary text-decoration-none ">HOME</a>
                        <span class="text-secondary"> > </span>
                        <a href="#" class="text-decoration-none text-secondary">Profile</a>
                    </div>
                </div>

                <div class="col-12 mb-5">
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                        <form id="info_form">
                            <h5>Basic Information</h5>
                            <div class="row">
                                    <div class="col-md-4 ps-0 mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required >
                                    </div>
        
                                    <div class="col-md-4 ps-0 mb-3">
                                        <label class="form-label">Phone number</label>
                                        <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>"  class="form-control shadow-none" required >
                                    </div>
                                 
                                    <div class="col-md-4 ps-0 mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input name="datebirth" type="date" value="<?php echo $u_fetch['datebirth'] ?>" class="form-control shadow-none" required >
                                    </div>
                                    <div class="col-md-4 ps-0 mb-3">
                                        <label class="form-label">Adresse</label>
                                        <textarea name="adresse"  class="form-control"  rows="1" required><?php echo $u_fetch['adresse'] ?>"</textarea>
                                    </div>
                                    <div class="col-md-4 ps-0 mb-3">
                                        <label class="form-label">Pin Code</label>
                                        <input name="pincode" type="number" value="<?php echo $u_fetch['pincode'] ?>" class="form-control shadow-none" required >
                                    </div>
                                                                    
                                </div>
                                <button type='submit' class='rounded-2 bg-outline-primary '>save changes</button>
                            </div>
                        </form>
                       
                    </div>
                </div>



                <div class="col-4 mb-5">
                    <div class="bg-white p-3 p-md-4 rounded shadow-sm">
                        <form id="picture_form">
                            <h5>change picture</h5>
                            <img src="<?php echo USERS_IMG_PATH.$u_fetch['picture'] ?>" width="100px" class="img-fluid mb-3">                          
                            <input name="picture" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none mb-3" required >
                            <button type='submit' class='rounded-2 bg-outline-primary '>save changes</button>
                        </form>
                    </div>
                </div>
               
           
               
           

                
            </div>
            
               
        </div>
   
  
     
    
    <?php require('inc/footer.php'); ?>


    <script>

        let info_form=document.getElementById('info_form');

        info_form.addEventListener('submit',function(e)
        {
            e.preventDefault();

            let data =new FormData();
                data.append('info_form','');
                data.append('name',info_form.elements['name'].value);
                data.append('phonenum',info_form.elements['phonenum'].value);
                data.append('adresse',info_form.elements['adresse'].value);
                data.append('pincode',info_form.elements['pincode'].value);
                data.append('datebirth',info_form.elements['datebirth'].value);

                let xhr= new XMLHttpRequest();
                xhr.open("POST","ajax_db_index/profile.php",true);
                
                xhr.onload=function()
                {

            

                if(this.responseText == 'phone_already')
                {
                
                alert ('error','phone number is already registered');
                }

                else if(this.responseText == 0)
                {
                
                alert ('error','no change made')
                }

                else{
                alert('success','changes saved');
                }

            }
            xhr.send(data);

    


        })





        let picture_form=document.getElementById('picture_form');

        picture_form.addEventListener('submit',function(e)
        {
            e.preventDefault();

            let data =new FormData();
                data.append('picture_form','');
                data.append('picture',picture_form.elements['picture'].files[0]);
            

                let xhr= new XMLHttpRequest();
                xhr.open("POST","ajax_db_index/profile.php",true);
                
                xhr.onload=function()
                {

            
                if(this.responseText == "inv_img")
                {
                
                alert ('error','only jpg & webp & png images are allowed')
                }

                else if(this.responseText == "upd_failed")
                {
                alert ('error','image upload failed');
                }

                else if(this.responseText ==0)
                {
                alert ('error','updation failed');
                }
                else if(this.responseText ==1)
                {
                alert ('success','image has been updated ');
                }

                else
                {
                window.location.href=window.location.pathname;
                }
            }
            xhr.send(data);




    })

        
            
    </script>

      
</body>
</html>