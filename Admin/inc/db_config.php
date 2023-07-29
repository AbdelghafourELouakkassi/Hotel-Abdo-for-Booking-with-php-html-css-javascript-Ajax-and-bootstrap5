<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="hotelabdo";

// Create connection
$con=mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
  die("Connection failed:". mysqli_connect_error());
}


function filteration($data)
{
   foreach($data as $key=>$value){
      $value=trim($value);
      $value=stripcslashes($value);
      $value=htmlspecialchars($value);
      $value=strip_tags($value);
      $data[$key]=$value;

   }

   return $data;
}

function selectAll($table)
{
  $con=$GLOBALS['con'];
  $res=mysqli_query($con,"SELECT * FROM $table");
  return $res;

}

function select($sql,$values,$datatypes)
{

   $con=$GLOBALS['con'];

   if($stmt=mysqli_prepare($con,$sql)){
      
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);

      if(mysqli_stmt_execute($stmt)){
         $res=mysqli_stmt_get_result($stmt);
         mysqli_stmt_close($stmt);
         return $res;

      }
      
      else{
         mysqli_stmt_close($stmt);
         die("Query cannot be executed - Select");
      }
      
   }
   
   else
   {
      die("Query cannot be prepared - Select");
   }
  
}



function update($sql,$values,$datatypes)
{

   $con=$GLOBALS['con'];

   if($stmt=mysqli_prepare($con,$sql)){
      
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);

      if(mysqli_stmt_execute($stmt)){
         $res=mysqli_stmt_affected_rows($stmt);
         mysqli_stmt_close($stmt);
         return $res;

      }
      
      else{
         mysqli_stmt_close($stmt);
         die("Query cannot be executed - Update");
      }
   
   }

   else
   {
      die("Query cannot be prepared - Update");
   }
  
}





function insert($sql,$values,$datatypes)
{

   $con=$GLOBALS['con'];

   if($stmt=mysqli_prepare($con,$sql)){
      
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);

      if(mysqli_stmt_execute($stmt)){
         $res=mysqli_stmt_affected_rows($stmt);
         mysqli_stmt_close($stmt);
         return $res;

      }
      
      else{
         mysqli_stmt_close($stmt);
         die("Query cannot be executed - insert");
      }
   
   }

   else
   {
      die("Query cannot be prepared - insert");
   }
  
}




function delete($sql,$values,$datatypes)
{

   $con=$GLOBALS['con'];

   if($stmt=mysqli_prepare($con,$sql)){
      
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);

      if(mysqli_stmt_execute($stmt)){
         $res=mysqli_stmt_affected_rows($stmt);
         mysqli_stmt_close($stmt);
         return $res;

      }
      
      else{
         mysqli_stmt_close($stmt);
         die("Query cannot be executed - delete");
      }
   
   }

   else
   {
      die("Query cannot be prepared - delete");
   }
  
}






?>
