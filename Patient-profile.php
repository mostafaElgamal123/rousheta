<?php 
include './inc/header.php';
if(isset($_SESSION['login']['id_user'])){
    $user_id=$_SESSION['login']['id_user'];
    $sql_profile="SELECT * FROM `register_user` WHERE `reg_id`='$user_id'";
    $result_profile=mysqli_query($conn,$sql_profile);
    $row_profile=mysqli_fetch_assoc($result_profile);
    $sql_profile1="SELECT * FROM `patient` WHERE `reg_id`='$user_id'";
    $result_profile1=mysqli_query($conn,$sql_profile1);
    $row_profile1=mysqli_fetch_assoc($result_profile1);
    $sql_id_doc="SELECT `doctor_id` FROM `appoinment_doctor` WHERE `reg_id`='$user_id'";
    $result_id_doc=mysqli_query($conn,$sql_id_doc);
    $row_get_id_doc=mysqli_fetch_assoc($result_id_doc);
    if(isset($row_get_id_doc['doctor_id'])):
    $doc_id_doc=$row_get_id_doc['doctor_id'];
    else:
        $doc_id_doc='';
    endif;
    $sql="SELECT * FROM `doctors` WHERE `reg_id`='$doc_id_doc'";
    $result=mysqli_query($conn,$sql);
    $sql_id_lap="SELECT `lap_id` FROM `appoinment_lap` WHERE `patient_id`='$user_id'";
    $result_id_lap=mysqli_query($conn,$sql_id_lap);
    $row_get_id_lap=mysqli_fetch_assoc($result_id_lap);
    if(isset($row_get_id_lap['lap_id'])):
    $doc_id_lap=$row_get_id_lap['lap_id'];
    else:
        $doc_id_lap='';
    endif;
    $sql1="SELECT * FROM `laps` WHERE `reg_id`='$doc_id_lap'";
    $result1=mysqli_query($conn,$sql1);
}

?>
             <!--loading-->
             <div class="loading">
                <div class="lds-heart"><div></div></div>
             </div>
             <!--end loading-->
    <main>
                <!-- content page -->
                <div class="container py-5">
                    <div class="row g-4">
                         <div class="col-12">
                            <section class="items-patient-dateils">
                                <div class="doc-avatar">
                                    <img  src="content/images/avatar-logo/team-2.png" alt="">
                                </div>
                                <div class="datelis-doc">
                                    <h2><?php if(isset($row_profile['username'])): echo $row_profile['username']; endif ?></h2>
                                    <p><?php if(isset($row_profile['set_loaction'])): echo $row_profile['set_loaction']; endif ?></p>
                                    <p><?php if(isset($row_profile['phone'])): echo $row_profile['phone']; endif ?></p>
                                    <p><?php if(isset($row_profile['email'])): echo $row_profile['email']; endif ?></p>
                                </div>
                                <div class="line"></div>
                                <div class="details-patient">
                                    <p>
                                        <strong>date of birth</strong>
                                        <span><?php if(isset($row_profile1['date_of_birth'])): echo $row_profile1['date_of_birth']; endif ?></span>
                                    </p>
                                    <p>
                                        <strong>blood type</strong>
                                        <span><?php if(isset($row_profile1['blood_type'])): echo $row_profile1['blood_type']; endif ?></span>
                                    </p>
                                    <p>
                                        <strong>personal id</strong>
                                        <span><?php if(isset($row_profile1['personal_id'])): echo $row_profile1['personal_id']; endif ?></span>
                                    </p>
                                    <p>
                                        <strong>weight</strong>
                                        <span><?php if(isset($row_profile1['weight'])): echo $row_profile1['weight']; endif ?> kg</span>
                                    </p>
                                    <p>
                                        <strong>height</strong>
                                        <span><?php if(isset($row_profile1['height'])): echo $row_profile1['height']; endif ?> cm</span>
                                    </p>
                                    <p>
                                        <strong>member since</strong>
                                        <span><?php if(isset($row_profile1['member_since'])): echo $row_profile1['member_since']; endif ?></span>
                                    </p>
                                </div>
                            </section>
                            <section class="items-doctors-history">
                                <h2>
                                    <i class="fa fa-user-md" aria-hidden="true"></i>
                                    <span>doctors history</span>
                                </h2>
                                <div class="doctor-history">
                                    <div class="row g-4">
                                        <?php if(isset($result)): foreach($result as $resul): ?>
                                            <div class="doc-hist">
                                                <div class="content-box">
                                                    <div class="datelis-doc">
                                                        <img src="<?php echo $resul['ava_image']; ?>" alt="">
                                                        <h2><?php echo $resul['username']; ?></h2>
                                                        <p><?php echo $resul['location']; ?></p>
                                                        <a href="<?php echo URL ?>single-profile-doctor.php?id=<?php echo $resul['reg_id']; ?>">
                                                        <?php echo $resul['Specialization']; ?>
                                                        </a>
                                                    </div>
                                                    <div class="call-details">
                                                        <p>
                                                            <i class="icon-box fa fa-phone-alt" aria-hidden="true"></i>
                                                            <span><?php echo $resul['phone']; ?></span>
                                                            </p>
                                                        <p>
                                                            <i class="icon-box fa fa-money-bill-alt" aria-hidden="true"></i>
                                                            <span><?php echo $resul['appoiment_price']; ?>$</span>
                                                        </p>
                                                    </div>
                                                    <div class="rate-doc">
                                                        <i class="icon-rate fa fa-star" aria-hidden="true"></i>
                                                        <span>4.9</span>
                                                    </div>
                                                    <div class="check-doc">
                                                        <i class=" icon-check fa fa-check-circle" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endforeach; endif; ?>
                                        <div class="full-hist">
                                            <a href="#!">
                                                <span>full history</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="items-lap-history">
                                <h2>
                                    <i class="fa fa-flask" aria-hidden="true"></i>
                                    <span>lap history</span>
                                </h2>
                                <div class="lap-history">
                                    <div class="row g-4">
                                    <?php if(isset($result1)): foreach($result1 as $resul): ?>
                                        <div class="doc-hist">
                                                <div class="content-box">
                                                    <div class="datelis-doc">
                                                        <img src="<?php echo $resul['ava_image']; ?>" alt="">
                                                        <h2><?php echo $resul['username']; ?></h2>
                                                        <p><?php echo $resul['location']; ?></p>
                                                        <a href="<?php echo URL ?>single-profile-lap.php?id=<?php echo $resul['reg_id']; ?>">
                                                        <?php echo $resul['Specialization']; ?>
                                                        </a>
                                                    </div>
                                                    <div class="call-details">
                                                        <p>
                                                            <i class="icon-box fa fa-phone-alt" aria-hidden="true"></i>
                                                            <span><?php echo $resul['phone']; ?></span>
                                                            </p>
                                                        <p>
                                                            <i class="icon-box fa fa-money-bill-alt" aria-hidden="true"></i>
                                                            <span><?php echo $resul['appoiment_price']; ?>$</span>
                                                        </p>
                                                    </div>
                                                    <div class="rate-doc">
                                                        <i class="icon-rate fa fa-star" aria-hidden="true"></i>
                                                        <span>4.9</span>
                                                    </div>
                                                    <div class="check-doc">
                                                        <i class=" icon-check fa fa-check-circle" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; endif; ?>
                                        <div class="full-hist">
                                            <a href="#!">
                                                <span>full history</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="covid-19">
                                <h2>
                                    <i class="fa fa-virus" aria-hidden="true"></i>
                                    <span>covid-19</span>
                                </h2>
                                <img src="content/images/images-section/lab-img/photo-1589209934789-4aacd30e8e3d.jfif" alt="">
                            </section>
                        </div>
                </div>
              </div>
              <!-- end content page -->

    </main>



<?php include './inc/footer.php'; ?>