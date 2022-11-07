<?php 
include './inc/header.php';
include './functions/functions.php'; 
?>
  
  <main>
  <div class="container pt-4 pb-4">
    <div class="row justify-content-center">
      <div class="col-lg-12">
      <div style="display:<?php if (isset($_SESSION['showAlert'])) {
            echo $_SESSION['showAlert'];
            } else {
            echo 'none';
            } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            } unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Products in your cart!</h4>
                </td>
              </tr>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <a href="<?php URL ?>handlers/action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                include './database/database.php';
                if(isset($_SESSION['login']['id_user'])):
                    $user_reg=$_SESSION['login']['id_user'];
                endif;
                $stmt = $conn->prepare("SELECT * FROM cart WHERE `reg_id`='$user_reg'");
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                <td><?= $row['cart_id'] ?></td>
                <input type="hidden" class="pid" value="<?= $row['cart_id'] ?>">
                <td><img src="<?= $row['med_image'] ?>" width="50"></td>
                <td><?= $row['med_name'] ?></td>
                <td>
                  <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['med_price'],2); ?>
                </td>
                <input type="hidden" class="pprice" value="<?= $row['med_price'] ?>">
                <td>
                  <input type="number" class="form-control itemQty" value="<?= $row['med_count'] ?>" style="width:75px;" max="<?= $row['med_count'] ?>" min="1">
                </td>
                <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                <td>
                  <a href="<?php URL ?>handlers/action.php?remove=<?= $row['cart_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php $grand_total += $row['total_price']; ?>
              <?php endwhile; ?>
              <tr>
                <td colspan="3">
                  <a href="<?php URL ?>pharmacy.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                    Shopping</a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td><b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                <td>
                  <a href="<?php URL ?>checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </main>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'handlers/action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
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