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
    $sql="SELECT * FROM `appoinment_lap_accept` WHERE (`Patient_name` like '%$search%' OR `Patient_date` like '%$search%' OR `Patient_time` like '%$search%' OR `type_test` like '%$search%') AND `lap_id`='$id_user'";
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
            <form action="<?php URL ?>handlers/search-dash-lap-acc.php" method="POST" class="btn-search">
                <input type="text" name="search" placeholder="search">
                <button name="submit" class="icon-search"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <?php if(isset($_SESSION['errors'])): foreach($_SESSION['errors'] as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; unset($_SESSION['errors']); endif; ?>
            <?php if(isset($_SESSION['success'])): foreach($_SESSION['success'] as $succes): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $succes; ?>
                </div>
            <?php endforeach; unset($_SESSION['success']); endif; ?>
        <div class="table-patient">
            <h2><i class="fa fa-table" aria-hidden="true"></i> <span>request patient</span></h2>
          <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">patient name</th>
                    <th scope="col">Appoinment date</th>
                    <th scope="col">appoinment time</th>
                    <th scope="col">type test</th>
                    <th scope="col">send test</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; if(isset($result)): foreach($result as $resul): ?>
                  <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $resul['Patient_name']; ?></td>
                    <td><?php echo $resul['Patient_date']; ?></td>
                    <td><?php echo $resul['Patient_time']; ?></td>
                    <td><?php echo $resul['type_test']; ?></td>
                    <td>
                        <form class="btn_send_test" action="<?php URL ?>handlers/send-test-patient.php?id_patient=<?php echo $resul['patient_id']; ?>&id_lap=<?php echo $resul['lap_id']; ?>" method="POST" >
                            <input type="url" name="test_url" placeholder="enter url file test"/>
                            <button name="send_test">
                                send test
                            </button>
                        </form>
                    </td>
                    <td>
                        <a class="btn-delete" href="<?php URL ?>handlers/Appoinment-lap-accept-delete.php?id=<?php echo $resul['app_acc_lap_id']; ?>">
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
    <!--jquery-->
    <script src="content/js/vendors/jquery.js"></script>
    <!--font js-->
    <script src="content/js/vendors/all.min.js"></script>
    <!--js bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!--js page-->
    <script src="content/js/main/js.js"></script>
</body>
</html>