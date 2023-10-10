<?php

include './../contact.php';
$banner_id= $_GET['id'];
$query ="SELECT * FROM banners WHERE id ='$banner_id'";
$result= mysqli_query($conn ,$query);
$post = mysqli_fetch_assoc($result);


include_once './backend_inc/header.php';


?>


<div class="Container-fluid ml-5 mr-5">
    <h2 class="text-center text-dark" >Add New Banner </h2>
    <?php
    if (isset($_SESSION['success'])){
 echo '<div class="alert alert-success">'.$_SESSION['success']."</div>";
}
 ?>
    <form class="row my-5" action="./../controllers/bannerupdate.php" method="POST" enctype="multipart/form-data">
        <div class="col-lg-12">
            <label for=""> Enter your Banner title</label>
            <input value="<?= $post['title'] ?>" name="title" class="form-control mb-4" type="text">
            <p class="text-danger"><?= isset($_SESSION['errors']['title_error'])? $_SESSION['errors']['title_error']: ''?></p>

        </div>
        <div class="col-lg-12">
            <label for=""> Enter your Banner Description</label>
            <textarea name="description"class="form-control mb-4"><?= $post['description'] ?></textarea>
            <p class="text-danger"><?= isset($_SESSION['errors']['description_error'])? $_SESSION['errors']['description_error']: ''?></p>

        </div>
        <div class="col-lg-4">
            <label for=""> Enter your Banner CTA Text</label>
            <input value="<?= $post['cta_text'] ?>"  name="cta_text"  class="form-control mb-4" type="text">
            <p class="text-danger"><?= isset($_SESSION['errors']['cta_text_error'])? $_SESSION['errors']['cta_text_error']: ''?></p>
        </div>
        <div class="col-lg-4">
            <label for=""> Enter your Banner CTA Link</label>
            <input value="<?= $post['cta_link'] ?>" name="cta_link" class="form-control mb-4" type="url">
            <p class="text-danger"><?= isset($_SESSION['errors']['cta_link_error'])? $_SESSION['errors']['cta_link_error']: ''?></p>
        </div>
        <div class="col-lg-4">
            <label for=""> Enter your Banner Video link </label>
            <input value="<?= $post['video_link'] ?>" name="video_link" class="form-control mb-4"type="url">
            <p class="text-danger"><?= isset($_SESSION['errors']['video_link_error'])? $_SESSION['errors']['video_link_error']: ''?></p>
        </div>
        <div class="col-lg-12">
            <label for=""> Enter your Banner  image </label>
            <input  class="form-control mb-4" type="file">
            <p class="text-danger"><?= isset($_SESSION['errors']['image_error'])? $_SESSION['errors']['image_error']: ''?></p>
            <img src="./../uploads/<?=$post['image']?>" width="200">
        </div>
        <div class="col-lg-12  text-center">
           <button type="submit" class="btn btn-info w-25">Update Banner </button>
        </div>

    </form>

</div>








            <?php
include_once './backend_inc/footer.php';

?>
<?php
unset($_SESSION['errors'],$_SESSION['success']);
?>