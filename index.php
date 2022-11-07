<?php 
include './inc/header.php';
include './functions/functions.php'; 
if(isset($_SESSION['user_login'])){
//FilterUpload();
}
?>

             <!--loading-->
             <div class="loading">
                <div class="lds-heart"><div></div></div>
             </div>
             <!--end loading-->
            <main>
               <!-- content page -->
               <div class="container py-4">
                <div class="row g-4">
                <div class="col-12">
                <div class="header-page align-items-center d-flex justify-content-between flex-wrap">
                    <a href="#!" class="logo-page">
                        <img class="fluid" src="content/images/logo-page/istockphoto-1131552689-612x612.jpg" alt="">
                        <h1>Best notification</h1>
                    </a>
                    <div class="social align-items-center d-flex justify-content-between">
                        <ul>
                            <li><a href="#i">
                                <i class="icon-social fab fa-facebook-square" aria-hidden="true"></i>
                            </a></li>
                            <li><a href="#i">
                                <i class="icon-social fab fa-instagram-square" aria-hidden="true"></i>
                            </a></li>
                            <li><a href="#i">
                                <i class="icon-social fab fa-twitter-square" aria-hidden="true"></i>
                            </a></li>
                            <li><a href="#i">
                                <i class="icon-social fab fa-google-plus-square" aria-hidden="true"></i>
                            </a></li>
                            
                        </ul>
                        <!-- <div class="lang d-flex align-items-center">
                            <a href="#!">ع</a>
                            <a class="active" href="#!">en</a>
                        </div> -->
                    </div>
                </div>
                <div class="content-page">
                    <div class="row g-2">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="content">
                                <h3>hello <?php if(isset($_SESSION['login']['email'])): echo $_SESSION['login']['email']; endif;  ?></h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                <a href="<?php URL ?>doctors.php">
                                    <span>make an appoin</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="home-img">
                                <img src="content/images/home-img/istockphoto-1214753465-612x612.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="option">
                                <div class="row g-2">
                                    <div class="col-12 col-md-4">
                                           <a href="<?php URL ?>doctors.php">
                                            <i class="icon-option fa fa-search" aria-hidden="true"></i>
                                            <span>
                                                1
                                                <i></i>
                                            </span>
                                           </a>
                                           <p>search a doctor</p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <a href="<?php URL ?>lab-page.php">
                                         <i class="icon-option fa fa-flask" aria-hidden="true"></i>
                                         <span>
                                             2
                                             <i></i>
                                         </span>
                                        </a>
                                        <p>select a lap</p>
                                 </div>
                                 <div class="col-12 col-md-4">
                                    <a href="<?php URL ?>pharmacy.php">
                                     <i class="icon-option fa fa-medkit" aria-hidden="true"></i>
                                     <span>
                                         3
                                         <i></i>
                                     </span>
                                    </a>
                                    <p>select a pharmacy</p>
                             </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
              <!-- end content page right -->
               </div>
              </div>
               <!-- end content page -->
            </main>



<?php include './inc/footer.php'; ?>