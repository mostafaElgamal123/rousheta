<?php 
session_start();
include './inc/header-dash.php'; 
include './database/database.php';
include './functions/functions.php';
//FilterUpload_med();
if(isset($_SESSION['login']['id_user'])&&isset($_GET['id'])){
    $med_id=$_GET['id'];
    $user_id=$_SESSION['login']['id_user'];
    $sql="SELECT * FROM `medicine` WHERE `pharm_id`='$user_id' AND `med_id`='$med_id'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
}
?>
    <!--loading-->
    <div class="loading">
        <div class="lds-heart"><div></div></div>
    </div>
     <!--end loading-->
      <!--page content-->
    <div class="container pt-4 pb-4">
            <?php if(isset($_SESSION['errors'])): foreach($_SESSION['errors'] as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; unset($_SESSION['errors']); endif; ?>
            <?php if(isset($_SESSION['success'])): foreach($_SESSION['success'] as $succes): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $succes; ?>
                </div>
            <?php endforeach; unset($_SESSION['success']); endif; ?>
        <div class="row">
            <div class="col-10 mx-auto">
                <form class="row" method="POST" action="<?php echo URL ?>handlers/dashborad-medicine-update.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine name</label>
                            <input type="text" value="<?php if(isset($row['med_name'])): echo $row['med_name']; endif; ?>" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">pharmacy location</label>
                            <input type="text" value="<?php if(isset($row['med_location'])): echo $row['med_location']; endif; ?>" name="location" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">pharmacy name</label>
                            <input type="text" value="<?php if(isset($row['med_pharmacy'])): echo $row['med_pharmacy']; endif; ?>"  name="phar_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine count</label>
                            <input type="text" value="<?php if(isset($row['med_count'])): echo $row['med_count']; endif; ?>"  name="med_count" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine price</label>
                            <input type="text" value="<?php if(isset($row['med_price'])): echo $row['med_price']; endif; ?>"  name="med_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine code</label>
                            <input type="text" value="<?php if(isset($row['med_code'])): echo $row['med_code']; endif; ?>"  name="med_code" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine image</label>
                            <input type="file" value="<?php if(isset($row['med_image'])): echo $row['med_image']; endif; ?>"  name="med_image" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                      <button type="submit"  name="update_medicine" class="btn btn-primary">update medicine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
      <!--end page content-->
<?php include './inc/footer.php'; ?>