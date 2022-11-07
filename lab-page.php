<?php 
include './inc/header.php';
include './functions/functions.php'; 
include './database/database.php';
$per_page_record = 6;  // Number of entries to show in a page.   
// Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {    
      $page  = $_GET["page"];    
 }    
 else {    
       $page=1;    
 }    
    
//determine the sql LIMIT starting number for the results on the displaying page  
$start_from = ($page-1) * $per_page_record;  
if(isset($_SESSION['search'])){
$search=$_SESSION['search'];
}else{
    $search='';
}
$sql="SELECT * FROM `laps` WHERE `username` like '%$search%' OR `location` like '%$search%' OR `Specialization` like '%$search%' LIMIT $start_from, $per_page_record";
$result=mysqli_query($conn,$sql);


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
                            <div class="menu-page d-flex justify-content-between align-items-center flex-wrap">
                                <h2>laps</h2>
                                <div class="search">
                                    <form action="<?php URL ?>handlers/search-lap.php" method="POST">
                                        <input type="search" name="search" placeholder="search by city" aria-label="Search">
                                        <button type="submit"><i class="icon-search fa fa-map-marker-alt" aria-hidden="true"></i></button>
                                    </form>
                                    <form action="<?php URL ?>handlers/search-lap.php" method="POST">
                                        <input type="search" name="search" placeholder="Search" aria-label="Search">
                                        <button type="submit"><i class="icon-search fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                                <div class="categories">
                                    <ul>
                                        <li class="active" ><a href="<?php URL ?>handlers/search-Specialization-lap.php?search">All</a></li>
                                        <li><a href="<?php URL ?>handlers/search-Specialization-lap.php?search=General">General</a></li>
                                        <li><a href="<?php URL ?>handlers/search-Specialization-lap.php?search=Branch">Branch</a></li>
                                        <li><a href="<?php URL ?>handlers/search-Specialization-lap.php?search=Medical practice">Medical practice</a></li>
                                        <li><a href="<?php URL ?>handlers/search-Specialization-lap.php?search=Specialised">Specialised</a></li>
                                    </ul>
                                    <div class="more hiden">
                                        <span>more...</span>
                                    </div>
                                </div>
                                <section class="items-doctors">
                                <div class="row g-5">
                                    <?php if(isset($result)): foreach($result as $resul): ?>
                                    <div class="col-12 col-md-4">
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
                                                <span>
                                                   <?php
                                                    $id_rate=$resul['reg_id'];
                                                    $query = mysqli_query($conn,"SELECT AVG(user_rating) as AVGRATE from comments where  `get_comment_id`='$id_rate'");
                                                    $row = mysqli_fetch_array($query);
                                                    $AVGRATE=$row['AVGRATE'];
                                                    echo round($AVGRATE,1);
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="check-doc">
                                                <i class=" icon-check fa fa-check-circle" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; unset($_SESSION['search']); endif; ?>
                                </div>
                                <!--pagination-->
                                <div class="pagination">
                                    <ul>
                                        <?php
                                            $query = "SELECT COUNT(*) FROM laps";     
                                            $rs_result = mysqli_query($conn, $query);     
                                            $row = mysqli_fetch_row($rs_result);     
                                            $total_records = $row[0];     
                                            
                                            echo "</br>";     
                                            // Number of pages required.   
                                            $total_pages = ceil($total_records / $per_page_record);     
                                            $pagLink = "";     
                                            if($page>=2) {   
                                                echo "<li><a id='prev' href='lab-page.php?page=".($page-1)."'>  Prev </a></li>";   
                                            }       
                                                        
                                            for ($i=1; $i<=$total_pages; $i++) {   
                                                if ($i == $page) {   
                                                    $pagLink .= "<li class='active'><a class = 'btn-pagination' href='lab-page.php?page="  
                                                                                        .$i."'>".$i." </a> </li>";   
                                                }               
                                                else  {   
                                                    $pagLink .= "<li><a href='lab-page.php?page=".$i."'>   
                                                                                        ".$i." </a></li>";     
                                                }   
                                            };     
                                            echo $pagLink;   

                                            if($page<$total_pages){   
                                                echo "<li><a id='next' href='lab-page.php?page=".($page+1)."'>  Next </a></li>";   
                                            } 

                                        ?>
                                    </ul>
                                </div>
                                <!-- end pagination-->
                                </section>
                        </div>
                    </div>
                </div>
                <!-- end content page -->
            </main>

<?php include './inc/footer.php'; ?>