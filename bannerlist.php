<?php

include './../contact.php';
$query ="SELECT id,title,status,image FROM banners";
$result= mysqli_query($conn ,$query);
$posts = mysqli_fetch_all($result,1);


include_once './backend_inc/header.php';


?>





<div class="container">
        <p class=" display-4 h2 text-center mt-3 mb-3">Banner List</p>
        <?php
    if (isset($_SESSION['mess'])){
 echo '<div class="alert alert-success">'.$_SESSION['mess']."</div>";
}
 ?>
         <?php
    if (isset($_SESSION['delete'])){
 echo '<div class="alert alert-success">'.$_SESSION['delete']."</div>";
}
 ?>
        
    </div>
    <div class="container">
    <div class="row ">
  
<table class="table text-center table-bordered table-striped table-hover col-lg-12  col-md-12 col-12 mt-5 mx-auto text-danger" >
    <thead class="bg-info ">
      <tr>
        <th scope="col">serial no</th>
        <th scope="col">title</th>
        <!-- <th scope="col">description</th>
        <th scope="col">cta_text</th>
        <th scope="col">cta_link</th>
        <th scope="col">video_link</th> -->
        <th scope="col">image</th>
        <th scope="col">status</th>
        <th scope="col">action</th>
</tr>
    </thead>
        <tbody>
<?php
foreach($posts as $key=> $post){
   

?>
<tr>
    <th scope='row'><?= ++$key?></th>
    <td ><?=$post['title']?></td>
  
    <td ><img src="./../uploads/<?=$post['image']?>" width="100"></td>
    <td >
        <a href="./../controllers/bannerstatus.php?id=<?=$post['id']?>" class="btn">
     
        <i class="<?=$post['status']?'fas': 'far'?> fa-star"></i>

        </a>
    </td>
    <td >
       <div class="btn-group-sm">
        <a href="./bannerview.php?id=<?=$post['id']?>" class="btn btn-success"><i class="fas fa-eye"></i></a>
        <a href="./banneredit.php?id=<?=$post['id']?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
        <a href="./../controllers/bannerdelete.php?id=<?=$post['id']?>" class="btn btn-danger delete_btn"><i class="fas fa-trash"></i></a>

       </div> 
    </td>
    </tr> 
    <?php
}
   

?> 
        </tbody>




      
  
</table>
</div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>



$('.delete_btn').on('click',function(event){
  event.preventDefault();
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

let url =$(this).attr('href');
window.location.href =url;

    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})

})













</script>
 
    <?php
include_once './backend_inc/footer.php';
unset($_SESSION['mess'],$_SESSION['delete']);
?>