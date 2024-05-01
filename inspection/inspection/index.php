<?php 

$title = "Inspection List";
require "./../includes/side-header.php";

?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

        <?php require './../includes/top-header.php'?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="d-flex align-items-center justify-content-between card-header h-75">
                    <h1 class="h3 text-gray-800 mt-2"><?php echo $title ?></h1>
                    <a href="./add-inspection.php"
                        class="btn btn-success d-flex justify-content-center align-items-center">
                        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline">Add</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                            <thead>

                            </thead>

                            <tbody>

                                <?php 
                                    $inspectionQuery = "SELECT DISTINCT inspection_id, bus_name, bus_img_url, date_inspected FROM inspection_view ORDER BY inspection_id DESC";
                                    $inspectionStatement = $pdo->query($inspectionQuery);
                                    $inspections = $inspectionStatement->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                <?php 
                                    if ($inspections) : 
                                        foreach ($inspections as $inspection) :
                                ?>


                                <tr class="d-flex justify-content-between align-items-center border-bottom py-1">
                                    <td class="p-0 m-0">
                                        <a href="./view-inspection.php?inspection_id=<?php echo $inspection['inspection_id']?>"
                                            class="d-flex flex-row align-items-center justify-content-center text-decoration-none
                                text-gray-700 flex-gap">
                                            <div class="image-container img-fluid">
                                                <img src="./../business/images/<?php echo $inspection['bus_img_url'] ?? 'no-image.png'?>"
                                                    alt="inspector-image" class="img-fluid rounded-circle" />
                                            </div>

                                            <div>
                                                <div class="text">
                                                    <span class="d-none d-md-inline ">Name:</span>
                                                    <?php echo $inspection['bus_name']?>
                                                </div>
                                                <div class="sub-title d-none d-md-flex">Date Inspected:
                                                    <?php echo $inspection['date_inspected']?></div>

                                            </div>
                                        </a>
                                    </td>
                                </tr>

                                <?php
                                   
                                    endforeach;
                                ?>
                                <?php else : ?>

                                <div class="img-fluid w-100 d-flex flex-column align-items-center bg-white m-0 p-0">
                                    <img src="<?php echo SITEURL?>assets/img/no_data.png" alt="no-data-image"
                                        class="img-fluid w-50 m-0 no-data-image" />
                                    <p class="font-weight-bolder m-0 p-0">No Data</p>
                                </div>

                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
        
    if (isset($_SESSION['add'])) { //Checking whether the session is set or not
	//DIsplaying session message
        echo $_SESSION['add'];
        //Removing session message
        unset($_SESSION['add']);
    }

?>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php 
require './../includes/footer.php';
?>

</body>

</html>