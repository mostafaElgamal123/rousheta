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
$sql="SELECT * FROM `medicine` WHERE ( `med_name` like '%$search%') AND `pharm_id`='$user_id'";
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
                                    <form action="<?php URL ?>handlers/search-pha-med.php" method="POST">
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
                                                    <th scope="col">medicine name</th>
                                                    <th scope="col">location</th>
                                                    <th scope="col">pharmacy name</th>
                                                    <th scope="col">price</th>
                                                    <th scope="col">count</th>
                                                    <th scope="col">code</th>
                                                    <th scope="col">update</th>
                                                    <th scope="col">delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=1; if(isset($result)): foreach($result as $resul): ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i++ ?></th>
                                                    <td><?php echo $resul['med_name']; ?></td>
                                                    <td><?php echo $resul['med_location']; ?></td>
                                                    <td><?php echo $resul['med_pharmacy']; ?></td>
                                                    <td><?php echo $resul['med_price']; ?></td>
                                                    <td><?php echo $resul['med_count']; ?></td>
                                                    <td><?php echo $resul['med_code']; ?></td>
                                                    <td>
                                                        <a class="btn btn-primary" href="<?php URL ?>dashborad-medicine-update.php?id=<?php echo $resul['med_id']; ?>">
                                                            update
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="btn-delete" href="<?php URL ?>handlers/med-delete.php?id=<?php echo $resul['med_id']; ?>">
                                                            delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; unset($_SESSION['search']); endif; ?>
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