<?php 
include 'head.php';  
if(isset($_SESSION['login']['id_user'])){
include './database/database.php';
$id_user=$_SESSION['login']['id_user'];
$sql="SELECT `image`,`username` FROM `register_user` WHERE `reg_id`='$id_user'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
}
?>
<!--dash-header-->
<div class="dash-header">
    <div class="dash-menu">
        <div class="logout">
            <a href="<?php echo URL ?>index.php">
                <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
            </a>
        </div>
        <div class="avatar-details">
            <img class="fluid" src="<?php echo $row['image']; ?>" alt="">
            <h2><?php echo $row['username']; ?></h2>
        </div>
        <div class="toggle-dash">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <nav>
            <div class="logo">
                <img class="fluid" src="<?php echo $row['image']; ?>" alt="">
            </div>
            <ul>
                <?php
                    if(isset($_SESSION['login']['type'])){
                        if($_SESSION['login']['type']=='doctor'){
                            ?>
                            <li><a href="<?php echo URL ?>dashborad-doctor-request.php">request</a></li>
                            <li><a href="<?php echo URL ?>dashborad-doctor-appoinment.php">appoinment</a></li>
                            <li><a href="<?php echo URL ?>dashborad-profile.php">profile</a></li>
                            <?php
                        }elseif($_SESSION['login']['type']=='lap'){
                            ?>
                            <li><a href="<?php echo URL ?>dashborad-lap-request.php">request</a></li>
                            <li><a href="<?php echo URL ?>dashborad-lap-appoinment.php">appoinment</a></li>
                            <li><a href="<?php echo URL ?>dashborad-profile.php">profile</a></li>
                            <?php
                        }elseif($_SESSION['login']['type']=='pharmacy'){
                            ?>
                            <li><a href="<?php echo URL ?>dashborad-pharmacy-request.php">request</a></li>
                            <li><a href="<?php echo URL ?>dashborad-add-purch.php">add medicine</a></li>
                            <li><a href="<?php echo URL ?>dashborad-medicine.php">medicine</a></li>
                            <li><a href="<?php echo URL ?>dashborad-profile.php">profile</a></li>
                            <?php
                        }elseif($_SESSION['login']['type']=='patient'){
                            $sql="SELECT count(*) as count FROM `list_test_patient_with_lap` WHERE `id_patient`='$id_user'";
                            $result=mysqli_query($conn,$sql);
                            $row_count=mysqli_fetch_assoc($result);
                            $count=$row_count['count'];
                            ?>
                            <li><a href="<?php echo URL ?>dashborad-patient-request.php">request</a></li>
                            <li class="position-relative">
                               <a href="<?php echo URL ?>dashborad-lap-test-patient.php">lap test</a>
                                <?php if($count > 0): ?>
                                <div class="message_send_dash"><span><?php echo $count; ?></span></div>
                                <?php endif; ?>
                            </li>
                            <li><a href="<?php echo URL ?>dashborad-profile-patient.php">profile</a></li>
                            <?php
                        }
                    }
                    ?>
            </ul>
            <div class="logout">
                <a href="<?php echo URL ?>index.php">
                    <i class="fa fa-sign-out-alt" aria-hidden="true"></i>
                </a>
            </div>
        </nav>
    </div>
</div>
<!--end dash-header-->