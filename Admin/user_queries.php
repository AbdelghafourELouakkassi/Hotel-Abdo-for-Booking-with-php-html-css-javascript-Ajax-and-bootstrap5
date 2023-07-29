<?php
 require('inc/essentials.php');
 require('inc/db_config.php');
 adminLogin();

if (isset($_GET['seen'])){
    $frm_data = filteration($_GET);

    if($frm_data['seen']=='all'){
        $q="UPDATE `user_queries` SET `seen`=? ";
        $values= [1];
        if(update($q,$values,'i')){
            alert('success','mark all as read ');
        }

        else{
            alert('error','operation failed');
        }


    }

    else{
        $q="UPDATE `user_queries` SET `seen`=? WHERE `id_user`=?" ;
        $values= [1,$frm_data['seen']];
        if(update($q,$values,'ii')){
            alert('success','mark as read ');
        }

        else{
            alert('error','operation failed');
        }


    }
}


if (isset($_GET['del'])){
    $frm_data = filteration($_GET);

    if($frm_data['del']=='all'){
        $q="DELETE FROM `user_queries`" ;
        if(mysqli_query($con,$q)){
            alert('success','all data deleted');
        }

        else{
            alert('error','operation failed');
        }

    }

    else{
        $q="DELETE FROM `user_queries` WHERE `id_user`=?" ;
        $values= [$frm_data['del']];
        if(delete($q,$values,'i')){
            alert('success','data deleted');
        }

        else{
            alert('error','operation failed');
        }


    }
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-User-Queries</title>
    <?php require('inc/links.php') ?>

</head>
<body class="bg-light">
    
    <?php require('inc/header.php') ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden mt-4">
                <h3>User Queries</h3>


                <div class="card border-0 mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                              
                            <a href='?seen=all' class='btn btn-sm rounded-pill btn-dark text-white mt-2 '><i class="bi bi-check2-all"></i> mark all read</a>
                            <a href='?del=all' class='btn btn-sm rounded-pill btn-dark text-white mt-2 '><i class="bi bi-trash3"></i> delete all read</a>

                        </div>

                        <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                        <table class="table table-hover table-bordered border-dark border">
                            <thead class="sticky-top">
                                <tr class="bg-dark text-light">
                                <th scope="col">id_user</th>
                                <th scope="col">name</th>
                                <th scope="col">email</th>
                                <th scope="col">subject</th>
                                <th scope="col">message</th>
                                <th scope="col">date</th>
                                <th scope="col" class="w-50">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   $q=  "SELECT * FROM `user_queries` ORDER BY `id_user` DESC ";
                                   $data=mysqli_query($con,$q);
                                   $i=1;

                                   while($row=mysqli_fetch_assoc($data))
                                   {

                                    $seen='';
                                    if($row['seen']!=1){
                                        $seen="<a href='?seen=$row[id_user]' class='btn btn-sm rounded-pill btn-primary'>Mark As Read</a>";
                                    }
                                    $seen.="<a href='?del=$row[id_user]' class='btn btn-sm rounded-pill btn-danger mt-2'>Delete</a>";
                                    echo<<<query
                                      <tr>
                                        <td>$i</td>
                                        <td>$row[name]</td>
                                        <td>$row[email]</td>
                                        <td>$row[subject]</td>
                                        <td>$row[message]</td>
                                        <td>$row[date]</td>
                                        <td>$seen</td>
                                     </tr>
                                     query;
                                     $i++;
                                     
                                   }
                                ?>
                            </tbody>
                            </table>
                        </div>
                        
                       
                    </div>
                </div>



            </div>

        </div>
    </div>




<?php require('inc/script.php') ?>
</body>
</html>