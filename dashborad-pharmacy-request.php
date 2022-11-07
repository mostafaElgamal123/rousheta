<?php 
session_start();
include './inc/header-dash.php';
include './functions/functions.php'; 
include './database/database.php';
if(isset($_SESSION['login']['id_user'])){
    $user_id=$_SESSION['login']['id_user'];
} 
if(isset($_SESSION['search'])){
$search=$_SESSION['search'];
}else{
    $search='';
}
$sql="SELECT * FROM `orders` WHERE (`name` like '%$search%' OR `address` like '%$search%') AND `phar_id`='$user_id'";
$result=mysqli_query($conn,$sql);

?>
             <!--loading-->
             <div class="loading">
                <div class="lds-heart"><div></div></div>
             </div>
             <!--end loading-->
                <!-- content page -->
                <div class="container py-4">
                    <div class="row g-4">
                            <div class="col-12">
                            <div class="menu-page d-flex justify-content-between align-items-center flex-wrap">
                                <div class="search">
                                    <form action="<?php URL ?>handlers/search-dash-pharm-request.php" method="POST">
                                        <input type="search" name="search" placeholder="Search" aria-label="Search">
                                        <button type="submit"><i class="icon-search fa fa-search" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                                <section class="items-doctors pt-4">
                                <div class="row g-5">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">name</th>
                                                    <th scope="col">email</th>
                                                    <th scope="col">phone</th>
                                                    <th scope="col">address</th>
                                                    <th scope="col">pmode</th>
                                                    <th scope="col">products</th>
                                                    <th scope="col">product count</th>
                                                    <th scope="col">amount paid</th>
                                                    <th scope="col">delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=1; if(isset($result)): foreach($result as $resul): ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i++ ?></th>
                                                    <td><?php echo $resul['name']; ?></td>
                                                    <td><?php echo $resul['email']; ?></td>
                                                    <td><?php echo $resul['phone']; ?></td>
                                                    <td><?php echo $resul['address']; ?></td>
                                                    <td><?php echo $resul['pmode']; ?></td>
                                                    <td><?php echo $resul['products']; ?></td>
                                                    <td><?php echo $resul['product_count']; ?></td>
                                                    <td><?php echo $resul['amount_paid']; ?></td>
                                                    <td>
                                                        <a class="btn-delete" href="<?php URL ?>handlers/Appoinment-pharmacy-delete-request.php?id=<?php echo $resul['order_id']; ?>">
                                                            delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                                </section>
                        </div>
                    </div>
                </div>
                <!-- end content page -->
<?php include './inc/footer.php'; ?>