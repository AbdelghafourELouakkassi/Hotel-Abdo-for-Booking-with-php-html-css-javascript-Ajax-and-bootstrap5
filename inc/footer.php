 <!-- footer -->
 <div class="container-fluid bg-dark mt-5" id="footer">
        <div class="row ">
            <div class="col-lg-3 p-4 text-center ">
                <h3 class="h-font fw-bold fs-2 text-light">Hotel Abdo</h3>
                <p class="fs-6 text-light h-font">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste porro, et quaerat quisquam enim esse placeat 
                    facilis, similique culpa amet odit excepturi nesciunt dolorem exercitationem aliquam sunt id, mollitia ipsum!

                </p>
            </div>

            <div class="col-lg-6 p-4 d-flex flex-column justify-content-evenly text-center ">
                <h3 class="h-font fw-bold fs-2 mb-2 text-light text-center">Links</h3>
                <a href="#" class="d-inline-block text-decoration-none mb-2 text-white fs-6 h-font">home</a>
                <a href="#" class="d-inline-block text-decoration-none mb-2 text-white fs-6 h-font ">Rooms</a>
                <a href="#" class="d-inline-block text-decoration-none mb-2 text-white fs-6 h-font">Facilities</a>
                <a href="#" class="d-inline-block text-decoration-none mb-2 text-white fs-6 h-font">Contact us</a>
                <a href="#" class="d-inline-block text-decoration-none mb-2 text-white fs-6 h-font">About</a>
            </div>


            <div class="col-lg-3 p-4 d-flex flex-column text-center">

                 <h3 class="h-font fw-bold fs-2 mb-2 text-light">Follow us</h3>
                  <i class="bi bi-facebook fs-6 text-white"> <a href="www.facebook.com" class="d-inline-block mb-2 text-decoration-none text-white">Facebook</a></i>
                  <i class="bi bi-instagram fs-6 text-white"> <a href="www.instagram.com" class="d-inline-block mb-2 text-decoration-none text-white">instagram</a></i> 
                  <i class="bi bi-twitter fs-6 text-white"> <a href="www.twitter.com" class="d-inline-block mb-2 text-decoration-none text-white">Twitter</a></i>  

            </div>
            <div class="container-fluid text-center">
                <h6 class="text-white fs-4 pt-lg-1" >Designed and Devloped By Abdelghafour Elouakkassi</h6>
                <h6 class="text-center text-white ">Copyright &copy; <script type="text/javascript">
                   document.write(new Date().getFullYear());
                 </script></h6>
               </div>
        </div>
    </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
    <!-- end footer -->    

    <script>
 
         
        function alert(type,msg,position='body'){
                
                let bs_class=(type == 'success') ? 'alert-success': 'alert-danger' ;
                let element=document.createElement('div');
        
                element.innerHTML=`
                        <div class="alert ${bs_class} alert-dismissible fade show " role="alert">
                            <strong class="me-3">${msg}</strong> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> `;
        
                if(position=='body'){
                    document.body.append(element);
                    element.classList.add('custom-alert');
                }
        
                else{
                    document.getElementById(position).appendChild(element);
        
                }
        
                setTimeout(remAlert,3000);
                            
                }

        
        function remAlert(){
                document.getElementsByClassName('alert')[0].remove();
                }
        
        
        
        


        let register_form=document.getElementById('register_form');


            register_form.addEventListener('submit',(e)=>{
                e.preventDefault();

                let data =new FormData();
                data.append('name',register_form.elements['name'].value);
                data.append('email',register_form.elements['email'].value);
                data.append('phonenum',register_form.elements['phonenum'].value);
                data.append('adresse',register_form.elements['adresse'].value);
                data.append('pincode',register_form.elements['pincode'].value);
                data.append('datebirth',register_form.elements['datebirth'].value);
                data.append('passw',register_form.elements['passw'].value);
                data.append('confirmpassw',register_form.elements['confirmpassw'].value);
                data.append('picture',register_form.elements['picture'].files[0]);
                data.append('register','');


                var myModal=document.getElementById('RegisterModal');
                var modal=bootstrap.Modal.getInstance(myModal);
                modal.hide();

                let xhr= new XMLHttpRequest();
                xhr.open("POST","ajax_db_index/login_register.php",true);
                
                xhr.onload=function()
                {

                if(this.responseText == "pass_missmatch"){
                
                alert ('error','password missmatch');
                } 

                else if(this.responseText == "email_already")
                {
                
                alert ('error','email is already registered');
                }

                else if(this.responseText == "phone_already")
                {
                
                alert ('error','phone number is already registered');
                }

                else if(this.responseText == "inv_img")
                {
                
                alert ('error','only jpg & webp & png images are allowed')
                }

                else if(this.responseText == "upd_failed")
                {
                alert ('error','image upload failed');
                }

                else if(this.responseText == "mail_failed")
                {
                
                alert ('error','cannot send confirmation email! server down');
                }

                else if(this.responseText =="ins_failed")
                {
                
                alert ('error','registration failed! server down');
                }

                else{
                alert('success','registration successful, confirmation link sent to email');
                }

            }
            xhr.send(data);


            });







        let login_form=document.getElementById('login_form');

            login_form.addEventListener('submit',(e)=>{
                e.preventDefault();
            
                let data =new FormData();
                data.append('email_mob',login_form.elements['email_mob'].value);
                data.append('passw',login_form.elements['passw'].value);
                data.append('login','');

                var myModal=document.getElementById('LoginModal');
                var modal=bootstrap.Modal.getInstance(myModal);
                modal.hide();
                    
        
                let xhr= new XMLHttpRequest();
                xhr.open("POST","ajax_db_index/login_register.php",true);
                
                xhr.onload=function()
                {

                if(this.responseText == "inv_email_mob"){
                
                 alert ('error','invalid email or mobile phone');
                } 

                else if(this.responseText == "not_verified")
                {
                
                alert ('error','email is not verified');
                }

                else if(this.responseText == "inactive")
                {
                    alert ('error','Account suspended please contact Admin');

                }
            

                else if(this.responseText == "invalid_passw")
                {
                alert ('error','incorrect password');
                }

                else{
                   let fileurl=window.location.href.split('/').pop().split('?').shift();
                   if(fileurl=='room_details.php'){
                    window.location = window.location.href ;

                   } 

                   else{
                   window.location = window.location.pathname ;
                   }
                }

                

            }
            xhr.send(data);


            });







        let forgot_form=document.getElementById('forgot_form');

        forgot_form.addEventListener('submit',(e)=>{
            e.preventDefault();

            let data =new FormData();
            data.append('email',forgot_form.elements['email'].value);
            data.append('forgot_passw','');

            var myModal=document.getElementById('ForgotModal');
            var modal=bootstrap.Modal.getInstance(myModal);
            modal.hide();
                

            let xhr= new XMLHttpRequest();
            xhr.open("POST","ajax_db_index/login_register.php",true);
            
            xhr.onload=function()
            {

            if(this.responseText == "inv_email"){
            
            alert ('error','invalid email');
            } 

            else if(this.responseText == "not_verified")
            {
            
            alert ('error','email is not verified');
            }

            else if(this.responseText == "inactive")
            {
                alert ('error','Account suspended please contact Admin');

            }


            else if(this.responseText == "mail_failed")
            {
            alert ('error','cannot send email server down');
            }

            else if(this.responseText == "upd_failed")
            {
            alert ('error','password reset failed ');
            }

            else{
            alert ('success','reset link send to your email');
            forgot_form.reset();

            }

            

        }
        xhr.send(data);


        });



        function checkLoginToBook(status,room_id){
            if(status){
                window.location.href='confirm_booking.php?id='+room_id;

            }

            else{
                alert('error','please login to book room!');
            }
        }


    </script>

    