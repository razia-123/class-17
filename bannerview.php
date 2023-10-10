<?php

include './../contact.php';
$banner_id = $_GET['id'];
$query ="SELECT * FROM banners WHERE id ='$banner_id'";
$result= mysqli_query($conn ,$query);
$post = mysqli_fetch_assoc($result);

include_once './backend_inc/header.php';

?>


<div class="container">
        <p class=" display-4 h2 text-center mt-3 mb-3">Banner View</p>
  

        
    </div>

<section class="mt-5 ">
    <div class="container ">
        <div class="row text-center  ">
            <div class= "col-md-12 mb-md-0 mb-5">
                <div class="card">
                <div class="card-header">
                    <p class="text-danger ">status</p>
                        <hr class="sidebar-divider">
                        <p> 
        <i class="<?=$post['status']?'fas': 'far'?> fa-star"></i></p>

                    </div>
                    <div class="card-header">
                        <p class="text-danger  "> title</p>
                        <hr class="sidebar-divider">
                        <p><?=$post['title']?></p>


                    </div>
                    <div class="card-header ">
                    <p class="text-danger "> description</p>
                        <hr class="sidebar-divider">
                        <p> <?=$post['description']?></p>

                    </div>
                    <div class="card-header">
                    <p class="text-danger "> cta_text</p>
                        <hr class="sidebar-divider">
                        <p> <?=$post['cta_text']?></p>

                    </div>
                    <div class="card-header">
                    <p class="text-danger "> cta_link</p>
                        <hr class="sidebar-divider">
                        <p> <?=$post['cta_link']?> </p>

                    </div>
                    <div class="card-header">
                    <p class="text-danger "> video link</p>
                        <hr class="sidebar-divider">
                        <p> <?=$post['video_link']?> </p>

                    </div>
                    <div class="card-header">
                    <p class="text-danger "> image</p>
                        <hr class="sidebar-divider">
                        <p><img src="./../uploads/<?=$post['image']?>" width="200"></p>

                    </div>

                    



                </div>

            </div>

        </div>

    </div>

</section>



    
    

<?php
include_once './backend_inc/footer.php';
unset($_SESSION['mess'],$_SESSION['delete']);
?>
