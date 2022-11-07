<?php 
include './inc/header.php';
require './database/database.php';
$grand_total = 0;
$allItems = '';
$items = [];
if(isset($_SESSION['login']['id_user'])):
    $user_reg=$_SESSION['login']['id_user'];
  endif;
$sql = "SELECT CONCAT(med_name,'(',med_count,')') AS ItemQty,pharm_id, total_price FROM cart WHERE `reg_id`='$user_reg'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  $grand_total += $row['total_price'];
  $items[] = $row['ItemQty'];
  $pharm_id_all[]=$row['pharm_id'];
}
$allItems = implode(', ', $items);
if(isset($pharm_id_all)):
$allItems_pharm = implode(', ', $pharm_id_all);
endif;
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
                            <section class="items-about">
                                <div class="col-lg-12 px-4 pb-4 appoinment" id="order">
                                    <h4 class="text-center text-info p-2">Complete your order!</h4>
                                    <div class="jumbotron p-3 mb-2 text-center">
                                    <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
                                    <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                                    <h5><b>Total Amount Payable : </b><?= number_format($grand_total,2) ?>/-</h5>
                                    </div>
                                    <form action="" method="post" id="placeOrder">
                                        <input class='p-3' type="hidden" name="products" value="<?= $allItems; ?>">
                                        <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                                        <div class='p-3' class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                        </div>
                                        <div class='p-3' class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                                        </div>
                                        <div class='p-3' class="form-group">
                                            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                                        </div>
                                        <div class='p-3' class="form-group">
                                            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
                                        </div>
                                        <h6 class='p-3' class="text-center lead">Select Payment Mode</h6>
                                        <div class='p-3' class="form-group">
                                            <select name="pmode" class="form-control">
                                            <option value="" selected disabled>-Select Payment Mode-</option>
                                            <option value="cod">Cash On Delivery</option>
                                            <option value="netbanking">Net Banking</option>
                                            <option value="cards">Debit/Credit Card</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="pharm_id_all" value="<?php if(isset($allItems_pharm)): echo $allItems_pharm; endif; ?>">
                                        <div class='p-3' class="form-group">
                                            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <!-- end content page -->
            </main>



<?php include './inc/footer.php'; ?>
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
        },
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