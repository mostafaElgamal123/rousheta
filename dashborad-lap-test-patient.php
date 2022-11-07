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
    $sql="SELECT * FROM `list_test_patient_with_lap` WHERE (`lap_name` like '%$search%') AND `id_patient`='$id_user'";
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
            <form action="<?php URL ?>handlers/search-test-lap.php" method="POST" class="btn-search">
                <input type="text" name="search" placeholder="search">
                <button name="submit" class="icon-search"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="table-patient">
            <h2><i class="fa fa-table" aria-hidden="true"></i> <span>lap test</span></h2>
          <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">test url</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; if(isset($result)): foreach($result as $resul): ?>
                  <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $resul['lap_name']; ?></td>
                    <td><a class="btn btn-link" href="<?php echo $resul['test_url']; ?>">view test</a></td>
                    <td>
                        <a class="btn-delete" href="<?php URL ?>handlers/lap-test-delete.php?id=<?php echo $resul['test_id']; ?>">
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