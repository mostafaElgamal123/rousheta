<?php 
session_start();
include './inc/header-dash.php'; 
include './database/database.php';
if(isset($_SESSION['login']['id_user'])){
    $user_id=$_SESSION['login']['id_user'];
    $sql="SELECT * FROM `patient` WHERE `reg_id`='$user_id'";
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
                <form class="row" method="POST" action="<?php echo URL ?>handlers/dashborad-profile-patient.php" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">date of birth</label>
                            <input type="date" value="<?php if(isset($row['date_of_birth'])): echo $row['date_of_birth']; endif; ?>" name="date_of_birth" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">blood type</label>
                            <input type="text"value="<?php if(isset($row['blood_type'])): echo $row['blood_type']; endif; ?>" name="blood_type" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">personal id</label>
                            <input type="text" value="<?php if(isset($row['personal_id'])): echo $row['personal_id']; endif; ?>" name="personal_id" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">weight</label>
                            <input type="text" value="<?php if(isset($row['weight'])): echo $row['weight']; endif; ?>" name="weight" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">height</label>
                            <input type="text" value="<?php if(isset($row['height'])): echo $row['height']; endif; ?>" name="height" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">member since</label>
                            <input type="date" value="<?php if(isset($row['member_since'])): echo $row['member_since']; endif; ?>" name="member_since" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                      <button type="submit"  name="create_profile" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
      <!--end page content-->
<?php include './inc/footer.php'; ?>