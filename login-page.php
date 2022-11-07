<?php 
include './inc/head.php';
session_start(); 
?>
      <!--loading-->
      <div class="loading">
        <div class="lds-heart"><div></div></div>
     </div>
     <!--end loading-->
     <!--login-->
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
                <h4>login</h4>
                <form action="<?php echo URL ?>handlers/login-page.php" method="POST">
                    <select class="form-select" name="type_reg" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="doctor">doctor</option>
                        <option value="lap">lap</option>
                        <option value="pharmacy">pharmacy</option>
                        <option value="patient">patient</option>
                    </select>
                    <div class="email">
                       <input id="email" name="email" type="text" placeholder="email">
                       <i class="icon-user fa fa-user"></i>
                    </div>
                    <div class="password">
                        <input name="pass" name="pass" type="password" placeholder="password">
                        <i class="icon-lock fa fa-lock"></i>
                        <i class="icon-eye fa fa-eye" aria-hidden="true"></i>
                     </div>
                     <div class="confirm-password">
                        <input id="confirm_password" name="confirm_password" type="password" placeholder="confirm password">
                        <i class="icon-lock fa fa-lock"></i>
                        <i class="icon-eye fa fa-eye" aria-hidden="true"></i>
                     </div>
                     <div class="item-check">
                        <div class="checkbox">
                            <input type="checkbox">
                            <label for="for">remember me</label>
                        </div>
                        <div class="sign-up">
                            <p>you don't have account ?<a href="<?php echo URL ?>register-page.php">sign up</a></p>
                        </div>
                     </div>
                     <div class="btn-login">
                        <button name="login_user" id="btn-register" class="btn_sub">
                           login
                        </button>
                     </div>
                </form>
            </div>
        </div>
    </div>
    <!--end login-->

<?php include './inc/footer.php'; ?>
