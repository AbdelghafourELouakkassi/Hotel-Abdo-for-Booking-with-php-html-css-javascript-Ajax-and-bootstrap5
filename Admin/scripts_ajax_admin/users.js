

function get_users()
{

let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax_db/users.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload=function()
    {
    
     document.getElementById('users-data').innerHTML = this.responseText;
     

    }

    xhr.send('get_users')
}


function toggle_status(id,val)
{

let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax_db/users.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload=function()
    {
    
        if(this.responseText == 1){
            alert('success','status toggled');
            get_users();
        }

        else{
            alert('error',"server dowwn")
        }

    
    }

    xhr.send('toggle_status='+id+'&value='+val)
}




function remove_user(user_id){

 if(confirm('are you sure you want to remove this user?'))
 {
     
     let data =new FormData();
      data.append('user_id',user_id);
      data.append('remove_user','');

      let xhr= new XMLHttpRequest();
      xhr.open("POST","ajax_db/users.php",true);
  
      xhr.onload=function ()
      { 
      if(this.responseText == 1){
          alert('success','user removed');
          get_users();
         
      }
  
      else{
          alert('error','user not removed');
        
          }
      
      }
  
      xhr.send(data);
 }

}


function search_user(username){


    let xhr= new XMLHttpRequest();
    xhr.open("POST","ajax_db/users.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onload=function()
    {
    
     document.getElementById('users-data').innerHTML = this.responseText;
     

    }

    xhr.send('search_user&name='+username)

}





window.onload=function(){
get_users();
}



