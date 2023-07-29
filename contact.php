<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Abdo-Contact-us</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-white">
    <?php require('inc/header.php') ?>
       

     <!-- reach us -->

     <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">CONTACT US<h2>
        <div class="container">
        <div class="row ">
                <div class="col-lg-6 col-md-6 p-4 mb-lg-0 mb-3 bg-light rounded border border-dark border-4">
                <iframe height="370px" class="w-100 " src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13592.372972710205!2d-7.9510088!3d31.6039047!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3f0add3667984970!2z2YXYp9mG2K_YsdmK2YYg2KPZiNix2YrZhtiq2KfZhCDZhdix2KfZg9i0!5e0!3m2!1sar!2sma!4v1674683680221!5m2!1sar!2sma"   loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <h6>Address</h6>

                <a href="https://goo.gl/maps/MhQjEf4gz5avvp659" class="fs-5 text-black" target="_blank">
                <i class="bi bi-geo-alt-fill fs-4"></i> Mandarin Oriental Marrakech</a>
                <h6 class="mt-3">Call us</h6>
                <i class="bi bi-telephone-fill fs-4"></i> <a href="+212707554563" class="fs-5 text-black" target="_blank">+212707554563</a><br>
                <i class="bi bi-telephone-fill fs-4"></i> <a href="+212656622394" class="fs-5 text-black" target="_blank">+212656622394</a>
                <h6 class="mt-3">Email</h6>
                <i class="bi bi-envelope-fill fs-4"></i><a href="hotelabdo@gmail.com" class="fs-5 text-black" target="_blank">hotelabdo@gmail.com</a>
                <h6 class="mt-3">Follow us</h6>
                <div class="p-0">
                <a href="www.facebook.com" class="d-inline-block mb-2 text-decoration-none"> <i class="bi bi-facebook fs-1 text-primary"></i></a>
                <a href="www.instagram.com" class="d-inline-block mb-2 text-decoration-none"> <i class="bi bi-instagram fs-1 text-danger"></i></a>
                <a href="www.twitter.com" class="d-inline-block mb-2 text-decoration-none"> <i class="bi bi-twitter fs-1"></i></a>
                </div>
                </div>

                <div class="col-lg-6 col-md-12 px-4">
                    <div class=" bg-white rounded shadow p-4 border border-dark border-4">
                        <form method="POST">
                            <h4>Send Message</h4>
                            <div class="mb-3">
                                <label class="form-label fs-4">Name</label>
                                <input name="name" type="text"  required   class="form-controle shadow-none w-100 ">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-4">Email</label>
                                <input  name="email"   type="email"  required   class="form-controle shadow-none w-100">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-4">Subject</label>
                                <input   name="subject"  type="text"   required   class="form-controle shadow-none w-100">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fs-4">Message</label>
                                <textarea  name="message"   required   class="form-controle shadow-none w-100" rows="5" style="resize:none;"></textarea>
                            </div>
                            <button name="send" type="submit" class="btn btn-primary fs-6">SEND</button>
                            
                        </form>
                    </div>

                </div>




        </div>
        </div>

<!-- end reach us -->
 


       <?php

        if(isset($_POST["send"]))
        {

        $frm_data=filteration($_POST);

        $q= " INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?) ";

        $values=[$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

        $res= insert($q,$values,'ssss');

        if($res==1){
            alert('success','mail sent');
        }



        else{
            alert('error','server down! try again later');
        }

        }        


       ?>


    
    <?php require('inc/footer.php') ?>

   
   
</body>
</html>