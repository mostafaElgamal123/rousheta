<?php 
session_start();
include './inc/header-dash.php'; 
include './database/database.php';
if(isset($_SESSION['login']['type'])){
    if($_SESSION['login']['type']=='doctor'){
        if(isset($_SESSION['login']['id_user'])){
            $user_id=$_SESSION['login']['id_user'];
            $sql="SELECT * FROM `doctors` WHERE `reg_id`='$user_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
        }
    }elseif($_SESSION['login']['type']=='lap'){
        if(isset($_SESSION['login']['id_user'])){
            $user_id=$_SESSION['login']['id_user'];
            $sql="SELECT * FROM `laps` WHERE `reg_id`='$user_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
        }
    }elseif($_SESSION['login']['type']=='pharmacy'){
        if(isset($_SESSION['login']['id_user'])){
            $user_id=$_SESSION['login']['id_user'];
            $sql="SELECT * FROM `pharmacys` WHERE `reg_id`='$user_id'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
        }
    }
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
                <form class="row" method="POST" action="<?php echo URL ?>handlers/dashborad-doctor-profile.php" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">your name</label>
                            <input type="text" value="<?php if(isset($row['username'])): echo $row['username']; endif; ?>" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">location</label>
                            <input type="text"value="<?php if(isset($row['location'])): echo $row['location']; endif; ?>" name="location" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">phone</label>
                            <input type="text" value="<?php if(isset($row['phone'])): echo $row['phone']; endif; ?>" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">email</label>
                            <input type="email" value="<?php if(isset($row['email'])): echo $row['email']; endif; ?>" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">email 2</label>
                            <input type="email" value="<?php if(isset($row['gmail'])): echo $row['gmail']; endif; ?>" name="email_2" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Specialization</label>
                            <input type="text" value="<?php if(isset($row['Specialization'])): echo $row['Specialization']; endif; ?>" name="Specialization" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">about me</label>
                            <div class="form-floating">
                                <textarea class="form-control" name="about_me" placeholder="Leave a comment here" id="floatingTextarea"><?php if(isset($row['about_me'])): echo $row['about_me']; endif; ?></textarea>
                                <label for="floatingTextarea">Comments</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="fs-5 fw-bolder" for="" class="form-label">opening time</label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">from</label>
                            <input type="text" value="<?php if(isset($row['opening_from'])): echo $row['opening_from']; endif; ?>" name="opening_from" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">to</label>
                            <input type="text" value="<?php if(isset($row['opening_to'])): echo $row['opening_to']; endif; ?>" name="opening_to" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">opening date</label>
                            <select class="form-select form-control" value="<?php if(isset($row['opening_date'])): echo $row['opening_date']; endif; ?>" name="opening_date" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="saturday">saturday</option>
                                <option value="saturday/Monday">saturday/Monday</option>
                                <option value="saturday/Tuesday">saturday/Tuesday</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">appoiment price</label>
                            <input type="text" value="<?php if(isset($row['appoiment_price'])): echo $row['appoiment_price']; endif; ?>" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">map</label>
                            <div class="form-floating">
                                <textarea class="form-control" name="map" placeholder="Leave a comment here" id="floatingTextarea"><?php if(isset($row['map'])): echo $row['map']; endif; ?></textarea>
                                <label for="floatingTextarea">Comments</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">image 1</label>
                            <input type="file" value="<?php if(isset($row['image_1'])): echo $row['image_1']; endif; ?>" name="image_1" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">image 2</label>
                            <input type="file" value="<?php if(isset($row['image_2'])): echo $row['image_2']; endif; ?>" name="image_2" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">image 3</label>
                            <input type="file" value="<?php if(isset($row['image_3'])): echo $row['image_3']; endif; ?>" name="image_3" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">image 4</label>
                            <input type="file" value="<?php if(isset($row['image_4'])): echo $row['image_4']; endif; ?>" name="image_4" class="form-control">
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