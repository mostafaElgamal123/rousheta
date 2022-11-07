<?php 
include './inc/head.php';
session_start(); 
?>
          <!--loading-->
          <div class="loading">
            <div class="lds-heart"><div></div></div>
         </div>
         <!--end loading-->
         <!--register-->
    <div class="container py-5">
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
        <div class="login">
            <div class="login-content">
                <h2>welcome back</h2>
                <h4>register</h4>
                <form action="<?php echo URL ?>handlers/register-page.php" method="POST" enctype="multipart/form-data">
                    <select class="form-select" name="type_reg" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="doctor">doctor</option>
                        <option value="lap">lap</option>
                        <option value="pharmacy">pharmacy</option>
                        <option value="patient">patient</option>
                    </select>
                    <div class="firstname">
                       <input id="firstname" name="firstname" type="text" placeholder="firstname">
                       <i class="icon-user fa fa-user"></i>
                    </div>
                    <div class="lastname">
                       <input id="lastname" name="lastname" type="text" placeholder="lastname">
                       <i class="icon-user fa fa-user"></i>
                    </div>
                    <div class="email">
                       <input id="email" name="email" type="text" placeholder="email">
                       <i class="icon-user fa fa-envelope"></i>
                    </div>
                    <div class="password">
                        <input id="pass" class="mybtn" name="pass" type="password" placeholder="password">
                        <i class="icon-lock fa fa-lock"></i>
                        <i class="icon-eye fa fa-eye" aria-hidden="true"></i>
                     </div>
                     <div class="confirm-password">
                        <input id="confirm_password" name="confirm_password" type="password" placeholder="confirm password">
                        <i class="icon-lock fa fa-lock"></i>
                        <i class="icon-eye fa fa-eye" aria-hidden="true"></i>
                     </div>
                     <div class="set-location">
                        <input id="setlocation" name="setlocation" type="text" placeholder="set location">
                        <i class="icon-user fa fa-map-marker-alt"></i>
                     </div>
                     <div class="phone">
                        <input id="phone" name="phone" type="text" placeholder="phone number">
                        <i class="icon-user fa fa-phone-alt"></i>
                     </div>
                     <div class="upload_iamge">
                        <input id="image" name="image" type="file" placeholder="image number">
                        <i class="icon-user fa fa-upload"></i>
                     </div>
                     <div class="item-check">
                        <div class="checkbox">
                            <input type="checkbox">
                            <label for="for">I agree</label>
                        </div>
                        <div class="sign-up">
                            <p>you have account already ?<a href="<?php echo URL ?>login-page.php">sign in</a></p>
                        </div>
                     </div>
                     <div class="btn-login">
                        <button name="add_user" id="btn-register" class="btn_sub">
                            register
                        </button>
                     </div>
                </form>
            </div>
        </div>
    </div>
        <!--end register-->

<?php include './inc/footer.php'; ?>