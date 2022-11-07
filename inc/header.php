<?php 
include 'head.php'; 
session_start();
if(!isset($_SESSION['user_login'])){
    header("Location:./login-page.php");
}
if(isset($_SESSION['login']['id_user'])){
include './database/database.php';
$id_user=$_SESSION['login']['id_user'];
$sql="SELECT `image` FROM `register_user` WHERE `reg_id`='$id_user'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
}
?>
<!--header asd-->
<header class="header">
    <div class="menu">
        <div class="icon-page">
            <a href="<?php URL ?>index.php"><img class="fluid" src="content/images/logo-page/istockphoto-1131552689-612x612.jpg" alt=""></a>
        </div>
        <div class="toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="menu-list hiddin">
            <div class="avatar">
                <?php if(isset($_SESSION['login']['type'])): if($_SESSION['login']['type']=='patient'): ?>
                    <a href="<?php echo URL ?>Patient-profile.php"><img class="fluid" src="<?php echo $row['image']; ?>" alt=""></a>
                <?php else: ?>
                    <a href="<?php echo URL ?>profile.php"><img class="fluid" src="<?php echo $row['image']; ?>" alt=""></a>
                <?php endif; endif; ?>
            </div>
        <ul>
            <li><a href="<?php echo URL ?>index.php">
            <i class="icon-style fa fa-home" aria-hidden="true"></i>
            </a></li>
            <?php
                    if(isset($_SESSION['login']['type'])){
                        if($_SESSION['login']['type']=='doctor'){
                            $sql="SELECT count(*) as count FROM `appoinment_doctor` WHERE `doctor_id`='$id_user'";
                            $result=mysqli_query($conn,$sql);
                            $row_count=mysqli_fetch_assoc($result);
                            $count=$row_count['count'];
                            ?>
                            <li class="position-relative">
                                <a href="<?php echo URL ?>dashborad-doctor-request.php">
                                  <i class="icon-style fa fa-tachometer-alt" aria-hidden="true"></i>
                                </a>
                                <?php if($count > 0): ?>
                                <div class="message_send"><span><?php echo $count; ?></span></div>
                                <?php endif; ?>
                           </li>
                            <?php
                        }elseif($_SESSION['login']['type']=='lap'){
                            $sql="SELECT count(*) as count FROM `appoinment_lap` WHERE `lap_id`='$id_user'";
                            $result=mysqli_query($conn,$sql);
                            $row_count=mysqli_fetch_assoc($result);
                            $count=$row_count['count'];
                            ?>
                            <li class="position-relative">
                                <a href="<?php echo URL ?>dashborad-lap-request.php">
                                  <i class="icon-style fa fa-tachometer-alt" aria-hidden="true"></i>
                                </a>
                                <?php if($count > 0): ?>
                                <div class="message_send"><span><?php echo $count; ?></span></div>
                                <?php endif; ?>
                            </li>
                            <?php
                        }elseif($_SESSION['login']['type']=='pharmacy'){
                            $sql="SELECT count(*) as count FROM `orders` WHERE `phar_id`='$id_user'";
                            $result=mysqli_query($conn,$sql);
                            $row_count=mysqli_fetch_assoc($result);
                            $count=$row_count['count'];
                            ?>
                            <li class="position-relative">
                                <a href="<?php echo URL ?>dashborad-pharmacy-request.php">
                                 <i class="icon-style fa fa-tachometer-alt" aria-hidden="true"></i>
                                </a>
                                <?php if($count > 0): ?>
                                <div class="message_send"><span><?php echo $count; ?></span></div>
                                <?php endif; ?>
                            </li>
                            <?php
                        }elseif($_SESSION['login']['type']=='patient'){
                            $sql="SELECT count(*) as count FROM `patient_request` WHERE `patient_id`='$id_user'";
                            $result=mysqli_query($conn,$sql);
                            $row_count=mysqli_fetch_assoc($result);
                            $count=$row_count['count'];
                            $sql1="SELECT count(*) as count FROM `cart` WHERE `reg_id`='$id_user'";
                            $result1=mysqli_query($conn,$sql1);
                            $row_count1=mysqli_fetch_assoc($result1);
                            $count1=$row_count1['count'];
                            ?>
                            <li><a href="<?php echo URL ?>doctors.php">
                                <i class="icon-style fa fa-user-md" aria-hidden="true"></i>
                            </a></li>
                            <li><a href="<?php echo URL ?>lab-page.php">
                                <i class="icon-style fa fa-flask" aria-hidden="true"></i>
                            </a></li>
                            <li><a href="<?php echo URL ?>pharmacy.php">
                                <i class="icon-style fa fa-medkit" aria-hidden="true"></i>
                            </a></li>
                            <li class="position-relative"><a href="<?php echo URL ?>cart.php">
                                <i class="icon-style fa fa-shopping-basket" aria-hidden="true"></i>
                                <?php if($count1 > 0): ?>
                                <div class="message_send"><span><?php echo $count1; ?></span></div>
                                <?php endif; ?>
                            </a></li>
                            <li class="position-relative">
                                <a href="<?php echo URL ?>dashborad-patient-request.php">
                                  <i class="icon-style fa fa-tachometer-alt" aria-hidden="true"></i>
                                </a>
                                <?php if($count > 0): ?>
                                <div class="message_send"><span><?php echo $count; ?></span></div>
                                <?php endif; ?>
                            </li>
                            <?php
                        }
                    }
                    ?>
                
                
        </ul>
        <div class="logout">
            <a href="<?php echo URL ?>handlers/logout.php">
                <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
            </a>
        </div>
        </div>
    </div>
    <?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
    if($curPageName=='index.php'||$curPageName=='checkout.php'||$curPageName=='cart.php'||$curPageName=='doctors.php'||$curPageName=='pharmacy.php'||$curPageName=='lab-page.php'||$curPageName=='Patient-profile.php'): ?>
        <div class="open-section">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="items-sections hide">
            <div class="container py-4">
                <h2>emergency numbers</h2>
                <div class="section">
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <a href="#!">
                            <p><i class="icon-section fa fa-ambulance" aria-hidden="true"></i></p>
                            <span>123</span>
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="#!">
                            <p><i class="icon-section fa fa-stethoscope" aria-hidden="true"></i></p>
                            <span>chets</span>
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="#!">
                            <p><i class="icon-section fa fa-stethoscope" aria-hidden="true"></i></p>
                            <span>chets</span>
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="#!">
                            <p><i class="icon-section fa fa-fire-extinguisher" aria-hidden="true"></i></p>
                            <span>180</span>
                        </a>
                    </div>
                    <div class="col-12">
                        <a class="view-all" href="https://www.elbalad.news/4961333">
                            view all
                        </a>
                    </div>
                </div>
                </div>
                <div class="ask-free">
                    <img src="content/images/home-img/images.jfif" alt="">
                    <a href="https://www.who.int/ar/emergencies/diseases/novel-coronavirus-2019/advice-for-public/q-a-coronaviruses">free asking about covide-19</a>
                </div>
            </div>
        </div> 
    <?php else: ?>
        <?php if($curPageName=='single-profile-doctor.php'): ?>
        <div class="items-sections hide">
            <div class="open-section">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="container py-4">
                <div class="staf-group">
                    <a href="#!">
                    <i class="icon-staf fa fa-info" aria-hidden="true"></i>
                    <span>information</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-money-bill" aria-hidden="true"></i>
                    <?php
                    if(isset($_GET['id'])):
                        $id=$_GET['id'];
                        $sql_profile="SELECT * FROM `doctors` WHERE `reg_id`='$id'";
                        $result_profile=mysqli_query($conn,$sql_profile);
                        $row_profile=mysqli_fetch_assoc($result_profile);
                    endif;
                    if($row_profile['appoiment_price']>=150):
                    ?>
                    <span>High Price</span>
                    <?php else: ?>
                    <span>Lowest Price</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-star" aria-hidden="true"></i>
                    <?php
                    if(isset($_GET['id'])):
                        $id=$_GET['id'];
                    endif;
                    $query = mysqli_query($conn,"SELECT AVG(user_rating) as AVGRATE from comments where  `get_comment_id`='$id'");
                    $row = mysqli_fetch_array($query);
                    $AVGRATE=$row['AVGRATE'];
                    if($AVGRATE>=4):
                    ?>
                    <span>High Rated</span>
                    <?php else: ?>
                    <span>low Rated</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-clock" aria-hidden="true"></i>
                    <span>Faster</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-check-circle" aria-hidden="true"></i>
                    <span>Verified</span>
                    </a>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo $row_profile['location']; ?>
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <img src="<?php echo $row_profile['ava_image']; ?>" alt="">
                            <p>call:<?php echo $row_profile['phone']; ?></p>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div> 
    <?php elseif($curPageName=='single-profile-lap.php'): ?>
        <div class="items-sections hide">
            <div class="open-section">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="container py-4">
                <div class="staf-group">
                    <a href="#!">
                    <i class="icon-staf fa fa-info" aria-hidden="true"></i>
                    <span>information</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-money-bill" aria-hidden="true"></i>
                    <?php
                    if(isset($_GET['id'])):
                        $id=$_GET['id'];
                        $sql_profile="SELECT * FROM `laps` WHERE `reg_id`='$id'";
                        $result_profile=mysqli_query($conn,$sql_profile);
                        $row_profile=mysqli_fetch_assoc($result_profile);
                    endif;
                    if($row_profile['appoiment_price']>=150):
                    ?>
                    <span>High Price</span>
                    <?php else: ?>
                    <span>Lowest Price</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-star" aria-hidden="true"></i>
                    <?php
                    if(isset($_GET['id'])):
                        $id=$_GET['id'];
                    endif;
                    $query = mysqli_query($conn,"SELECT AVG(user_rating) as AVGRATE from comments where  `get_comment_id`='$id'");
                    $row = mysqli_fetch_array($query);
                    $AVGRATE=$row['AVGRATE'];
                    if($AVGRATE>=4):
                    ?>
                    <span>High Rated</span>
                    <?php else: ?>
                    <span>low Rated</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-clock" aria-hidden="true"></i>
                    <span>Faster</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-check-circle" aria-hidden="true"></i>
                    <span>Verified</span>
                    </a>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo $row_profile['location']; ?>
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <img src="<?php echo $row_profile['ava_image']; ?>" alt="">
                            <p>call:<?php echo $row_profile['phone']; ?></p>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div> 
    <?php elseif($curPageName=='single-profile-pharmacy.php'): ?>
        <div class="items-sections hide">
            <div class="open-section">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="container py-4">
                <div class="staf-group">
                    <a href="#!">
                    <i class="icon-staf fa fa-info" aria-hidden="true"></i>
                    <span>information</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-money-bill" aria-hidden="true"></i>
                    <?php
                    if(isset($_GET['id'])):
                        $id=$_GET['id'];
                        $sql_profile="SELECT * FROM `pharmacys` WHERE `reg_id`='$id'";
                        $result_profile=mysqli_query($conn,$sql_profile);
                        $row_profile=mysqli_fetch_assoc($result_profile);
                    endif;
                    if($row_profile['appoiment_price']>=150):
                    ?>
                    <span>High Price</span>
                    <?php else: ?>
                    <span>Lowest Price</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-star" aria-hidden="true"></i>
                    <?php
                    if(isset($_GET['id'])):
                        $id=$_GET['id'];
                    endif;
                    $query = mysqli_query($conn,"SELECT AVG(user_rating) as AVGRATE from comments where  `get_comment_id`='$id'");
                    $row = mysqli_fetch_array($query);
                    $AVGRATE=$row['AVGRATE'];
                    if($AVGRATE>=4):
                    ?>
                    <span>High Rated</span>
                    <?php else: ?>
                    <span>low Rated</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-clock" aria-hidden="true"></i>
                    <span>Faster</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-check-circle" aria-hidden="true"></i>
                    <span>Verified</span>
                    </a>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo $row_profile['location']; ?>
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <img src="<?php echo $row_profile['ava_image']; ?>" alt="">
                            <p>call:<?php echo $row_profile['phone']; ?></p>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div> 
    <?php elseif($curPageName=='profile.php'): ?>
        <div class="items-sections hide">
            <div class="open-section">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="container py-4">
                <div class="staf-group">
                    <a href="#!">
                    <i class="icon-staf fa fa-info" aria-hidden="true"></i>
                    <span>information</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-money-bill" aria-hidden="true"></i>
                    <?php
                    if(isset($_SESSION['login']['type'])){
                        if($_SESSION['login']['type']=='doctor'){
                            if(isset($_SESSION['login']['id_user'])){
                                $user_id=$_SESSION['login']['id_user'];
                                $sql_profile="SELECT * FROM `doctors` WHERE `reg_id`='$user_id'";
                                $result_profile=mysqli_query($conn,$sql_profile);
                                $row_profile=mysqli_fetch_assoc($result_profile);
                            }
                        }elseif($_SESSION['login']['type']=='lap'){
                            if(isset($_SESSION['login']['id_user'])){
                                $user_id=$_SESSION['login']['id_user'];
                                $sql_profile="SELECT * FROM `laps` WHERE `reg_id`='$user_id'";
                                $result_profile=mysqli_query($conn,$sql_profile);
                                $row_profile=mysqli_fetch_assoc($result_profile);  
                            }
                        }elseif($_SESSION['login']['type']=='pharmacy'){
                            if(isset($_SESSION['login']['id_user'])){
                                $user_id=$_SESSION['login']['id_user'];
                                $sql_profile="SELECT * FROM `pharmacys` WHERE `reg_id`='$user_id'";
                                $result_profile=mysqli_query($conn,$sql_profile);
                                $row_profile=mysqli_fetch_assoc($result_profile);
                            }
                        }
                    }
                    if($row_profile['appoiment_price']>=150):
                    ?>
                    <span>High Price</span>
                    <?php else: ?>
                    <span>Lowest Price</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-star" aria-hidden="true"></i>
                    <?php
                    if(isset($_SESSION['login']['id_user'])):
                        $user_id=$_SESSION['login']['id_user'];
                    endif;
                    $query = mysqli_query($conn,"SELECT AVG(user_rating) as AVGRATE from comments where  `get_comment_id`='$user_id'");
                    $row = mysqli_fetch_array($query);
                    $AVGRATE=$row['AVGRATE'];
                    if($AVGRATE>=4):
                    ?>
                    <span>High Rated</span>
                    <?php else: ?>
                    <span>low Rated</span>
                    <?php endif; ?>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-clock" aria-hidden="true"></i>
                    <span>Faster</span>
                    </a>
                    <a href="#!">
                    <i class="icon-staf fa fa-check-circle" aria-hidden="true"></i>
                    <span>Verified</span>
                    </a>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <?php echo $row_profile['location']; ?>
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <img src="<?php echo $row_profile['ava_image']; ?>" alt="">
                            <p>call:<?php echo $row_profile['phone']; ?></p>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div> 
    <?php endif; endif; ?>               
</header>
<!--end header asd-->