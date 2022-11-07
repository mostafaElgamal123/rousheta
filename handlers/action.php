<?php
	session_start();
	require '../database/database.php';

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pharm_id = $_POST['pharm_id'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice * $pqty;
	  if(isset($_SESSION['login']['id_user'])):
		$user_reg=$_SESSION['login']['id_user'];
	  endif;
	  $stmt = $conn->prepare("SELECT `med_code` FROM `cart` WHERE `med_code`=? AND `reg_id`='$user_reg'");
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code'] ?? '';

	  if (!$code) {
	    $query = $conn->prepare("INSERT INTO cart (med_name,med_price,med_image,med_count,total_price,med_code,`reg_id`,`pharm_id`) VALUES (?,?,?,?,?,?,'$user_reg','$pharm_id')");
	    $query->bind_param('ssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'&&isset($_SESSION['login']['id_user'])) {
	  $user_reg = $_SESSION['login']['id_user'];
	  $stmt = $conn->prepare("SELECT * FROM cart WHERE  `reg_id`='$user_reg'");
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])&&isset($_SESSION['login']['id_user'])) {
	  $id = $_GET['remove'];
	  $user_reg=$_SESSION['login']['id_user'];
	  $stmt = $conn->prepare("DELETE FROM cart WHERE  cart_id=? AND `reg_id`='$user_reg' ");
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:../cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])&&isset($_SESSION['login']['id_user'])) {
		$user_reg=$_SESSION['login']['id_user'];
	  $stmt = $conn->prepare("DELETE FROM `cart` WHERE `reg_id`='$user_reg'");
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:../cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])&&isset($_SESSION['login']['id_user'])) {
		$user_reg=$_SESSION['login']['id_user'];
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare("UPDATE cart SET qty=?, total_price=? WHERE id=? AND `reg_id`='$user_reg'");
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order' && isset($_SESSION['login']['id_user'])) {
	  $user_reg=$_SESSION['login']['id_user'];
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $pmode = $_POST['pmode'];
	  $data = '';
	  $pharm_id_all =$_POST['pharm_id_all'];
	  $pharm_id_all =explode(', ',$pharm_id_all);
	  $pharm_id_all1 =array_unique($pharm_id_all,SORT_REGULAR);
	  $pharm_id_all2 =array_values($pharm_id_all1);
	  for($i=0;$i<count($pharm_id_all2);$i++):
		$pharm_id_all=$pharm_id_all2[$i];
		$sql="SELECT `med_name`,`total_price`,`med_count` FROM `cart` WHERE `pharm_id`='$pharm_id_all'";
		$result=mysqli_query($conn,$sql);
		foreach($result as $resul):
			$products_for_one=$resul['med_name'];
			$price_for_one=$resul['total_price'];
			$product_count_for_one=$resul['med_count'];
			$stmt = $conn->prepare("INSERT INTO orders (name,email,phone,address,pmode,products,product_count,amount_paid,user_id,phar_id)VALUES(?,?,?,?,?,'$products_for_one','$product_count_for_one','$price_for_one','$user_reg','$pharm_id_all')");
			$stmt->bind_param('sssss',$name,$email,$phone,$address,$pmode);
			$stmt->execute();
		endforeach;
	  endfor;
	  $stmt2 = $conn->prepare("DELETE FROM cart WHERE `reg_id`='$user_reg'");
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
						  </div>';
	  echo $data;
	}
?>