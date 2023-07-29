<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Abdo-facilities</title>
    <?php require('inc/links.php') ?>
</head>
<body class="bg-light">
    <?php require('inc/header.php') ?>
       


     <h2 class="mt-5 pt-4 mb-5 text-center fw-bold h-font ">OUR FACILITIES<h2>
        <div class="container-fluid">
            <div class="row ">     <!-- begin of row -->

            <!-- bayn aya facilitie zdtiha mn admin panel f l facilitie li f lhome -->
            <?php
            $res=selectAll('facilities');
            $path=FACILITIES_IMG_PATH;
            while($row=mysqli_fetch_assoc($res)){
                echo <<<data
                <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="$path$row[icon]" width="40px">
                        <h5 class="ms-3 m-0">$row[name]</h5>
                    </div>
                    <p>
                        $row[description]
                    </p>
                </div>
                </div>  
                data ;
    

            }

            ?>

             </div> <!-- end row -->
        </div>
<!-- end container -->
     
    
    <?php require('inc/footer.php') ?>

   
   
</body>
</html>