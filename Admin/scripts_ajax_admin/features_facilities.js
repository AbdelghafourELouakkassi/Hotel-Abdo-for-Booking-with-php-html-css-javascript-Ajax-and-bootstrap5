let features_s_form=document.getElementById("feature_s_form");
let facility_s_form=document.getElementById("facility_s_form");



features_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_feature();
})

// features-_crud

function add_feature()
{
   let data =new FormData();
   data.append('name',feature_s_form.elements['feature_name'].value);
   data.append('add_feature','');

   let xhr= new XMLHttpRequest();
   xhr.open("POST","ajax_db/features_facilities.php",true);

   xhr.onload=function ()
   {
    var myModal=document.getElementById('feature_s');
    var modal=bootstrap.Modal.getInstance(myModal);
    modal.hide();
    
    if(this.responseText == 1){
        alert('success','New feature data added');
        feature_s_form.elements['feature_name'].value='';
        get_features();
    }

    else{
        alert('error',"data not added")
    }

   }
  
   xhr.send(data);
}



function get_features()
{

   let xhr= new XMLHttpRequest();
   xhr.open("POST","ajax_db/features_facilities.php",true);
   xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

   xhr.onload=function()
   {

   document.getElementById('features_data').innerHTML=this.responseText;

   }
  
   xhr.send('get_features');
}



function rem_feature(val)
{

   let xhr= new XMLHttpRequest();
   xhr.open("POST","ajax_db/features_facilities.php",true);
   xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

   xhr.onload=function()
   {

   if(this.responseText==1)
        {
            alert('success','feature removed');
            get_features();
        }
        else if(this.responseText== 'room_added'){
            alert('error','feature is added in room');
        }
        else{
            alert('error','no feature is removed');
        }

   }
  
   xhr.send('rem_feature='+val);
}

// end features crud



//facility crud to ajax

facility_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_facility();
})


function add_facility()
{
   let data =new FormData();
   data.append('name',facility_s_form.elements['facility_name'].value);
   data.append('icon',facility_s_form.elements['facility_icon'].files[0]);
   data.append('desc',facility_s_form.elements['facility_desc'].value);
   data.append('add_facility','');

   let xhr= new XMLHttpRequest();
   xhr.open("POST","ajax_db/features_facilities.php",true);

   xhr.onload=function ()
   {
   
     var myModal=document.getElementById('facility_s');
     var modal=bootstrap.Modal.getInstance(myModal);
     modal.hide();
    
     if(this.responseText == 'inv_img'){
         alert('error','only jpg and png image are allowed');
     }

     else if(this.responseText=='inv_size'){
         alert('error',"image should be less than 2mb")
     }
     else if(this.responseText=='upd_failed'){
         alert('error',"image upload failed")
     }
     else{
         alert('success','new facility added');
         facility_s_form.reset();
         get_facilities();
     }

   }
  
   xhr.send(data);
}



function get_facilities()
{

   let xhr= new XMLHttpRequest();
   xhr.open("POST","ajax_db/features_facilities.php",true);
   xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

   xhr.onload=function()
   {
   document.getElementById('facilities_data').innerHTML=this.responseText;

   }
  
   xhr.send('get_facilities');
}


function rem_facility(val)
{

   let xhr= new XMLHttpRequest();
   xhr.open("POST","ajax_db/features_facilities.php",true);
   xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

   xhr.onload=function()
   {

   if(this.responseText==1)
        {
            alert('success','facility removed');
            get_facilities();
        }
        else if(this.responseText== 'room_added'){
            alert('error','feature is added in room');
        }
        else{
            alert('error','no facility is removed');
        }

   }
  
   xhr.send('rem_facility='+val);
}


 
window.onload=function(){
    get_features();
    get_facilities();
}

