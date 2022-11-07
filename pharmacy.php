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
$sql="SELECT * FROM `medicine` WHERE `med_name` like '%$search%' OR `med_location` like '%$search%' LIMIT $start_from, $per_page_record";
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
                            <div class="mb-5 menu-page d-flex justify-content-between align-items-center flex-wrap">
                                <h2>pharmacys</h2>
                                <div class="search">
                                    <form action="<?php URL ?>handlers/search-pha.php" method="POST">
                                        <input type="search" name="search" placeholder="search by city" aria-label="Search">
                                        <button type="submit"><i class="icon-search fa fa-map-marker-alt" aria-hidden="true"></i></button>
                                    </form>
                                    <form action="<?php URL ?>handlers/search-pha.php" method="POST">
                                        <input type="search" name="search" placeholder="Search" aria-label="Search">
                                        <button type="submit"><i class="icon-search fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                                <a class="ocr" href="<?php URL ?>ocr.php">rousheta ocr</a>
                            </div>
                            <div id="message"></div>
                                <section class="items-doctors">
                                <div class="row g-5">
                                    <?php if(isset($result)): foreach($result as $resul): ?>
                                    <div class="col-12 col-md-4">
                                        <div class="content-box">
                                             <div class="datelis-doc">
                                                 <a class="none" href="<?php URL ?>single-profile-pharmacy.php?id=<?php echo $resul['pharm_id']; ?>&med_id=<?php echo $resul['med_id']; ?>"><img src="<?php echo $resul['med_image']; ?>" alt=""></a>
                                                 <h2><?php echo $resul['med_name']; ?></h2>
                                                 <p><?php echo $resul['med_location']; ?></p>
                                                 <div class="card-footer p-1">
                                                    <form action="" class="form-submit">
                                                        <div class="row p-2">
                                                        <div class="col-md-6 py-1 pl-4">
                                                            <b>Quantity : </b>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="number" class="form-control pqty" value="<?= $resul['med_count'] ?>" max="<?= $resul['med_count'] ?>" min="1">
                                                        </div>
                                                        </div>
                                                        <input type="hidden" class="pid" value="<?= $resul['med_id'] ?>">
                                                        <input type="hidden" class="pname" value="<?= $resul['med_name'] ?>">
                                                        <input type="hidden" class="pprice" value="<?= $resul['med_price'] ?>">
                                                        <input type="hidden" class="pimage" value="<?= $resul['med_image'] ?>">
                                                        <input type="hidden" class="pcode" value="<?= $resul['med_code'] ?>">
                                                        <input type="hidden" class="pharm_id" value="<?= $resul['pharm_id'] ?>">
                                                        <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                                                        cart</button>
                                                    </form>
                                                </div>
                                             </div>
                                             <div class="call-details">
                                                 <p class="w-75 bg-white fw-bold"><?php echo $resul['med_count']; ?> left in stored</p>
                                                 <p class="w-25">
                                                    <svg class="svg-inline--fa fa-star fa-w-18 icon-rate" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <i class="icon-rate fa fa-star" aria-hidden="true"></i> Font Awesome fontawesome.com -->
                                                    <span>
                                                    <?php
                                                    $id_rate=$resul['pharm_id'];
                                                    $query = mysqli_query($conn,"SELECT AVG(user_rating) as AVGRATE from comments where  `get_comment_id`='$id_rate'");
                                                    $row = mysqli_fetch_array($query);
                                                    $AVGRATE=$row['AVGRATE'];
                                                    echo round($AVGRATE,1);
                                                    ?>
                                                    </span>
                                                 </p>
                                             </div>
                                             <div class="rate-doc">
                                                <i class="icon-rate fa fa-money-bill-alt fs-5" aria-hidden="true"></i>
                                                 <span class="fs-5"><?php echo $resul['med_price']; ?>$</span>
                                             </div>
                                         </div>
                                    </div>
                                    <?php endforeach; unset($_SESSION['search']); endif; ?>
                                </div>
                                <!--pagination-->
                                <div class="pagination">
                                    <ul>
                                        <?php
                                            $query = "SELECT COUNT(*) FROM pharmacys";     
                                            $rs_result = mysqli_query($conn, $query);     
                                            $row = mysqli_fetch_row($rs_result);     
                                            $total_records = $row[0];     
                                            
                                            echo "</br>";     
                                            // Number of pages required.   
                                            $total_pages = ceil($total_records / $per_page_record);     
                                            $pagLink = "";     
                                            if($page>=2) {   
                                                echo "<li><a id='prev' href='pharmacy.php?page=".($page-1)."'>  Prev </a></li>";   
                                            }       
                                                        
                                            for ($i=1; $i<=$total_pages; $i++) {   
                                                if ($i == $page) {   
                                                    $pagLink .= "<li class='active'><a class = 'btn-pagination' href='pharmacy.php?page="  
                                                                                        .$i."'>".$i." </a> </li>";   
                                                }               
                                                else  {   
                                                    $pagLink .= "<li><a href='pharmacy.php?page=".$i."'>   
                                                                                        ".$i." </a></li>";     
                                                }   
                                            };     
                                            echo $pagLink;   

                                            if($page<$total_pages){   
                                                echo "<li><a id='next' href='pharmacy.php?page=".($page+1)."'>  Next </a></li>";   
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

<script type="text/javascript">
    $(document).ready(function() {

        // Send product details in the server
        $(".addItemBtn").click(function(e) {
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var pid = $form.find(".pid").val();
        var pname = $form.find(".pname").val();
        var pprice = $form.find(".pprice").val();
        var pimage = $form.find(".pimage").val();
        var pcode = $form.find(".pcode").val();
        var pharm_id = $form.find(".pharm_id").val();
        var pqty = $form.find(".pqty").val();

        $.ajax({
            url: 'handlers/action.php',
            method: 'post',
            data: {
            pid: pid,
            pname: pname,
            pprice: pprice,
            pqty: pqty,
            pimage: pimage,
            pcode: pcode,
            pharm_id: pharm_id,
            },
            success: function(response) {
            $("#message").html(response);
            window.scrollTo(0, 0);
            load_cart_item_number();
            }
        });
        });

        // Load total no.of items added in the cart and display in the navbar
        load_cart_item_number();

        function load_cart_item_number() {
        $.ajax({
            url: 'handlers/action.php',
            method: 'get',
            data: {
            cartItem: "cart_item"
            },
            success: function(response) {
            $("#cart-item").html(response);
            }
        });
        }
    });
  </script>
