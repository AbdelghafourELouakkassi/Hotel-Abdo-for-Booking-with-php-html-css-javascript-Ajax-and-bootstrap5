<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Abdo-Rooms</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php');

    $checkin_default="";
    $checkout_default="";
    $adult_default="";
    $children_default="";
    
    if(isset($_GET['check_availability']))
    {
        $frm_data= filteration($_GET);
        $checkin_default=$frm_data['checkin'];
        $checkout_default=$frm_data['checkout'];
        $adult_default=$frm_data['adult'];
        $children_default=$frm_data['children'];

    }
    ?>

    
     <!-- container rooms and availability -->

     <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS<h2>
        <div class="container-fluid">
            <div class="row ">

                <!-- check availability form -->
                <div class="col-lg-3 col-md-3 p-1 rounded border border-dark border-1  mb-4 bg-white shadow h-80">
                    <div class=" bg-white shadow mb-2 p-4 ">
                        <!-- check availability logic -->
                    <div class="d-flex align-items-center justify-content-between">
                    <h3>check availability</h3>
                    <button class="btn btn-lg text-secondary d-none" onclick="check_avail_clear()" id="check_avail_btn">
                        Reset
                    </button>
                    </div>
                        <div class="mb-3 fs-5">
                            <label class="form-label fs-5">check-in</label>
                            <input type="date" class="form-controle shadow-none" value="<?php echo $checkin_default ?>"  id="checkin" onchange="check_avail_filter()">
                            </div>
                            <div class="mb-3 fs-5">
                            <label class="form-label fs-5">check-out</label>
                            <input type="date" class="form-controle shadow-none" value="<?php echo $checkout_default ?>" id="checkout" onchange="check_avail_filter()">
                        </div>
                    </div>

                    <div class=" bg-white shadow  p-4">
                        <div class="d-flex align-items-center justify-content-between">  
                            <h3>Facilities</h3>     
                            <button class="btn btn-lg text-secondary d-none mb-3" onclick="facilities_clear()" id="facilities_btn">
                                Reset
                            </button>
                        </div>

                        <?php

                           $facilities_q=selectAll('facilities');
                           while($row=mysqli_fetch_assoc($facilities_q))
                           {
                            echo<<<facilities
                                <div class="form-check fs-5">
                                <input class="form-check-input" name="facilities" value="$row[id]" onclick="fetch_rooms()" type="checkbox" id="$row[id]">
                                <label class="form-check-label" for="$row[id]">
                                $row[name]</label>
                                </div>

                           facilities;

                           }        
                         ?>
                         
                    </div> 

                    <div class=" bg-white shadow mb-2 p-4">   
                        <div class="d-flex align-items-center justify-content-between">  
                            <h3>Guests</h3>     
                            <button class="btn btn-lg text-secondary d-none mb-3" onclick="guests_clear()" id="guests">
                                Reset
                            </button>
                        </div>
                        <div>
                        <label class="form-label fs-5">Adults</label>
                        <input type="number" min="1" id="adults" value="<?php echo $adult_default ?>"  oninput="guests_filter()" class="form-controle shadow-none mb-3 fs-5 ">
                        </div>
                        <div class="mb-3 fs-5">
                        <label class="form-label fs-5">Children</label>
                        <input type="number" min="1" id="children" value="<?php echo $children_default ?>"  oninput="guests_filter()" class="form-controle shadow-none fs-5">
                        </div>
                     </div>
                </div>
                    
                
                <!-- close availability form -->

                <!-- rooms column-->
                
                <div class="col-lg-9 col-md-9 fs-5 " id="rooms_data">
                  
                 
               
                
               </div>
               </div>
            
            </div>
          </div>
                
                
    <?php require('inc/footer.php') ?>

    <script>
        
        
        
        let rooms_data=document.getElementById('rooms_data');
        let checkin=document.getElementById('checkin');
        let checkout=document.getElementById('checkout');
        let check_avail_btn=document.getElementById('check_avail_btn');


        let adults=document.getElementById('adults');
        let children=document.getElementById('children');
        let guests_btn=document.getElementById('guests');

        facilities_btn=document.getElementById('facilities_btn');


        function fetch_rooms(){
            
            let check_avail=JSON.stringify({
                checkin: checkin.value,
                checkout: checkout.value

            });

            let guests=JSON.stringify({
                adults: adults.value,
                children: children.value

            });

            let facility_list={"facilities":[]};
        
            let get_facilities=document.querySelectorAll('[name="facilities"]:checked');
            
  
            if(get_facilities.length>0)
            {
                get_facilities.forEach((facility)=>{
                    facility_list.facilities.push(facility.value);
                });
                facilities_btn.classList.remove('d-none');

            }

            else{
                facilities_btn.classList.add('d-none');

            }


            facility_list=JSON.stringify(facility_list);
          
            let xhr= new XMLHttpRequest();
            xhr.open("GET","ajax_db_index/rooms.php?fetch_rooms&check_avail="+check_avail+"&guests="+guests+"&facility_list="+facility_list,true);




           xhr.onprogress=function()
           {
            rooms_data.innerHTML= `<div class="spinner-border text-info mb-3 mx-auto d-block" id="info_loader" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>`;

           }

           xhr.onload=function()
           {
          
            rooms_data.innerHTML=this.responseText;

           }
          
           xhr.send();

         }
        
         function check_avail_filter(){
            if(checkin.value !='' && checkout.value !='')
            {
                fetch_rooms();
                check_avail_btn.classList.remove('d-none');

            }
         }
             
         function check_avail_clear(){
            checkin.value='' ;
            checkout.value='';
            check_avail_btn.classList.add('d-none');
            fetch_rooms();
            
         }


         function guests_filter(){
            if(adults.value>0 || children.value>0)
            {
                fetch_rooms();
                guests_btn.classList.remove('d-none');

            }
         }

         function guests_clear(){
            adults.value='' ;
            children.value='';
            guests_btn.classList.add('d-none');
            fetch_rooms();
            
         }

         function facilities_clear(){
            let get_facilities=document.querySelectorAll('[name="facilities"]:checked');

            get_facilities.forEach((facility)=>{
                facility.checked=false;
                });
                facilities_btn.classList.add('d-none');
            fetch_rooms();
            
         }

         window.onload=function(){
        
            fetch_rooms();
        
        }

  


    </script>

   
   
</body>
</html>