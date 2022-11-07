<?php 
session_start();
include './inc/header-dash.php'; 
include './database/database.php';
include './functions/functions.php';
//FilterUpload_med();
if(isset($_SESSION['login']['id_user'])){
    $user_id=$_SESSION['login']['id_user'];
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
                <form class="row" method="POST" action="<?php echo URL ?>handlers/dashborad-add-purch.php" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine name</label>
                            <input type="text"  name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">pharmacy location</label>
                            <input type="text"  name="location" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">pharmacy name</label>
                            <input type="text"  name="phar_name" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine count</label>
                            <input type="text"  name="med_count" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine price</label>
                            <input type="text"  name="med_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine code</label>
                            <input type="text"  name="med_code" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">medicine image</label>
                            <input type="file"  name="med_image" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                      <button type="submit"  name="create_medicine" class="btn btn-primary">add medicine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
      <!--end page content-->
<?php include './inc/footer.php'; ?>