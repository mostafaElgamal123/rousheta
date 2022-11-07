<?php 
include './inc/header.php';
if(isset($_GET['id'])):
    $id=$_GET['id'];
    $sql_profile="SELECT * FROM `pharmacys` WHERE `reg_id`='$id'";
    $result_profile=mysqli_query($conn,$sql_profile);
    $row_profile=mysqli_fetch_assoc($result_profile);
    $sql_comment="SELECT * FROM `comments` WHERE `get_comment_id`='$id'";
    $result_comment=mysqli_query($conn,$sql_comment);
endif;
$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(med_name, '(',med_count,')') AS ItemQty, total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  $grand_total += $row['total_price'];
  $items[] = $row['ItemQty'];
}
$allItems = implode(', ', $items);
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
                            <section class="items-doctor-dateils">
                                <div class="doc-avatar">
                                    <img  src="<?php if(isset($row_profile['ava_image'])): echo $row_profile['ava_image']; endif; ?>" alt="">
                                </div>
                                <div class="datelis-doc">
                                    <h2><?php if(isset($row_profile['username'])): echo $row_profile['username']; endif; ?></h2>
                                    <p><?php if(isset($row_profile['location'])): echo $row_profile['location']; endif; ?></p>
                                    <p>wating:30min</p>
                                    <a href="#!">
                                    <?php if(isset($row_profile['Specialization'])): echo $row_profile['Specialization']; endif; ?>
                                    </a>
                                </div>
                                <div class="items-rate">
                                    <div class="item-rate">
                                        <i class="icon-rate fa fa-star" aria-hidden="true"></i>
                                        <span>
                                        <?php
                                        $query = mysqli_query($conn,"SELECT AVG(user_rating) as AVGRATE from comments where  `get_comment_id`='$id'");
                                        $row = mysqli_fetch_array($query);
                                        $AVGRATE=$row['AVGRATE'];
                                        echo round($AVGRATE,1);
                                        ?>
                                        </span>
                                        <p> 
                                        <?php
                                        $query = mysqli_query($conn,"SELECT count(user_rating) as Total  from comments where  `get_comment_id`='$id'");
                                        $row = mysqli_fetch_array($query);
                                        echo $row['Total'];
                                        ?>    
                                        reviw</p>
                                    </div>
                                    <a href="#!">
                                        <span>150 request</span>
                                    </a>
                                    <a href="#!">
                                        <span><?php if(isset($row_profile['appoiment_price'])): echo $row_profile['appoiment_price']; endif; ?> $ price</span>
                                    </a>
                                </div>
                                <div class="line"></div>
                                <div class="connect">
                                    <a href="#!">
                                        <i class="fa fa-phone-alt" aria-hidden="true"></i>
                                        <span><?php if(isset($row_profile['phone'])): echo $row_profile['phone']; endif; ?></span>
                                    </a>
                                    <a href="#!">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <span><?php 
                                        if(isset($row_profile['email'])): 
                                        $new_email=$row_profile['email']; 
                                        $new_email=substr($new_email,0,20);
                                        echo $new_email."..";
                                        endif; ?></span>
                                    </a>
                                    <a href="#!">
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                        <span>
                                        <?php 
                                            if(isset($row_profile['email'])): 
                                            $new_email=$row_profile['email']; 
                                            $new_email=substr($new_email,0,20);
                                            echo $new_email."..";
                                            endif; 
                                        ?>
                                        </span>
                                    </a>
                            </div>
                            </section>
                            <section class="items-about">
                                <h2>
                                    <i class="fa fa-medkit" aria-hidden="true"></i>
                                    <span>About pharmacys</span>
                                </h2>
                                <p><?php if(isset($row_profile['about_me'])): echo $row_profile['about_me']; endif; ?>
                                </p>
                                <div class="row g-4">
                                    <div class="col-12 col-md-4">
                                        <div class="item-time">
                                            <i class="fa fa-clock" aria-hidden="true"></i>
                                            <p>opening time:<span>from <?php if(isset($row_profile['opening_from'])): echo $row_profile['opening_from']; endif; ?> AM TO <?php if(isset($row_profile['opening_to'])): echo $row_profile['opening_to']; endif; ?> PM</span></p>
                                        </div>
                                        <div class="item-day">
                                            <?php
                                             if(isset($row_profile['opening_date'])):
                                                $new_date=$row_profile['opening_date'];
                                                $new_date=explode('/',$new_date);
                                                for($i=0;$i<count($new_date);$i++):
                                             ?>
                                            <a href="#!">
                                                <span><?php echo $new_date[$i]; ?></span>
                                            </a>
                                            <?php
                                            endfor;
                                            endif;
                                            ?>
                                        </div>
                                        <div class="item-verfied">
                                        <p><i class="fa fa-address-card" aria-hidden="true"></i> <span><strong>joined time:</strong><?php if(isset($row_profile['created_at'])): echo $row_profile['created_at']; endif; ?></span> </p>
                                        <p><i class="fa fa-check-circle" aria-hidden="true"></i> <span>Verified</span> </p>
                                        <p><i class="fa fa-money-bill" aria-hidden="true"></i><span><?php if(isset($row_profile['appoiment_price'])): echo $row_profile['appoiment_price']; endif; ?>$ for price</span></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <iframe width="100%" height="200" id="gmap_canvas" src="<?php if(isset($row_profile['map'])): echo $row_profile['map']; endif; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                    </div>
                                </div>
                                <div class="item-clinic">
                                    <h2 class="mb-3">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        <span>pharmacys</span>
                                    </h2>
                                    <div  class="owl-carousel owl-theme owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                        <div class="owl-stage">
                                        <?php if(isset($row_profile['image_1'])): 
                                               $arrayimage=array(
                                                $row_profile['image_1'],
                                                $row_profile['image_2'],
                                                $row_profile['image_3'],
                                                $row_profile['image_4']
                                               );
                                               for($i=0;$i<count($arrayimage);$i++):
                                            ?>
                                                <div class="owl-item active">
                                                    <div class="card">
                                                        <img class="w-100" src="<?php echo $arrayimage[$i]; ?>" alt="">
                                                    </div>
                                                </div>
                                            <?php endfor; endif; ?>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <?php if(isset($_SESSION['errors_comment'])): foreach($_SESSION['errors_comment'] as $error): ?>
                                    <div class="alert alert-danger mt-5" role="alert">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endforeach; unset($_SESSION['errors_comment']); endif; ?>
                                <?php if(isset($_SESSION['success_comment'])): foreach($_SESSION['success_comment'] as $succes): ?>
                                    <div class="alert alert-success mt-5" role="alert">
                                        <?php echo $succes; ?>
                                    </div>
                                <?php endforeach; unset($_SESSION['success_comment']); endif; ?>
                            <section class="doctor-review">
                                <a href="#!">
                                    <i class="fa fa-medkit" aria-hidden="true"></i>
                                    <span>pharmacys review</span>
                                </a>
                                <div class="doctor-review__write-comment">
                                    <div class="text-message">
                                        <form action="<?php URL ?>handlers/add-comment-pha.php?id=<?php echo $id; ?>" method="post">
                                            <textarea name="comment" id="" cols="30" rows="10">
                                            </textarea>
                                            <p><i class="icon-text fa fa-comment-dots" aria-hidden="true"></i> <span>write your comment here?</span></p>
                                            <div class="box-rate">
                                                <div class="rate">
                                                    <span>put the rate:</span>
                                                    <div id="star-rating">
                                                        <input type="radio" name="example" class="rating" value="1" />
                                                        <input type="radio" name="example" class="rating" value="2" />
                                                        <input type="radio" name="example" class="rating" value="3" />
                                                        <input type="radio" name="example" class="rating" value="4" />
                                                        <input type="radio" name="example" class="rating" value="5" />
                                                    </div>
                                                </div>
                                                <button name="add_comment">
                                                    <span>post the rate</span>
                                               </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php if(isset($result_comment)): foreach($result_comment as $result_commen): ?>
                                <div class="comment-view">
                                    <div class="details-avatar">
                                        <div class="logo-avatar">
                                            <img src="<?php echo $result_commen['user_image']; ?>" alt="">
                                        </div>
                                        <div class="data-avatar">
                                            <h2><?php echo $result_commen['user_name']; ?></h2>
                                            <p><span><?php echo $result_commen['user_location']; ?></span></p>
                                        </div>
                                        <div class="line"></div>
                                    </div>
                                    <p class="comment"><?php echo $result_commen['user_comment']; ?></p>
                                    <div class="avatar-rate">
                                        <p>
                                            <i class="icon-rate fa fa-star" aria-hidden="true"></i>
                                            <span><?php echo $result_commen['user_rating']; ?></span>
                                        </p>
                                        <span><?php echo $result_commen['created_at']; ?></span>
                                    </div>
                                    <?php
                                    if(isset($_SESSION['login']['id_user'])):
                                        $user_id=$_SESSION['login']['id_user'];
                                        if($user_id==$result_commen['user_id']):

                                    ?>
                                    <a href="<?php URL ?>handlers/delete-comment-pha.php?id=<?php echo $result_commen['comment_id']; ?>&id_doc=<?php echo $id ?>">delete</a>
                                    <?php endif; endif; ?>
                                </div>
                                <?php endforeach; endif; ?>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- end content page -->
            </main>


            <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'handlers/action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
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
<?php include './inc/footer.php'; ?>