<?php 
session_start();
include './inc/header-dash.php'; 
include './database/database.php';
if(isset($_SESSION['login']['id_user'])){
    $id_user=$_SESSION['login']['id_user'];
    //determine the sql LIMIT starting number for the results on the displaying page   
    if(isset($_SESSION['search'])){
      $search=$_SESSION['search'];
      }else{
          $search='';
      }
    $sql="SELECT * FROM `patient_request` WHERE (`doc_lap_name` like '%$search%' OR `Patient_date` like '%$search%' OR `Patient_time` like '%$search%') AND `patient_id`='$id_user'";
    $result=mysqli_query($conn,$sql);
}
?>
    <!--loading-->
    <div class="loading">
        <div class="lds-heart"><div></div></div>
     </div>
     <!--end loading-->
      <!--page content-->
      <div class="container py-5">
        <div class="group-search-patient">
            <form action="<?php URL ?>handlers/search-patient-req.php" method="POST" class="btn-search">
                <input type="text" name="search" placeholder="search">
                <button name="submit" class="icon-search"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="table-patient">
            <h2><i class="fa fa-table" aria-hidden="true"></i> <span>request</span></h2>
          <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">Appoinment date</th>
                    <th scope="col">appoinment time</th>
                    <th scope="col">type test</th>
                    <th scope="col">case</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; if(isset($result)): foreach($result as $resul): ?>
                  <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $resul['doc_lap_name']; ?></td>
                    <td><?php echo $resul['Patient_date']; ?></td>
                    <td><?php echo $resul['Patient_time']; ?></td>
                    <td><?php echo $resul['type_test']; ?></td>
                    <td>Request denied</td>
                    <td>
                        <a class="btn-delete" href="<?php URL ?>handlers/Appoinment-patient-delete.php?id=<?php echo $resul['patient_request_id']; ?>">
                            delete
                        </a>
                    </td>
                  </tr>
                  <?php endforeach; unset($_SESSION['search']); endif; ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
      <!--end page content-->

<?php include './inc/footer.php'; ?>