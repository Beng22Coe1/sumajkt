<?php
require_once('../config/db_config.php');
require_once('../config/session_config.php');
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include_once('../inc/admin_sideNav.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include_once('../inc/admin_topNav.php') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Products</h1>
                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <div class="container my-5">
                            <div class="row ">
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body rounded p-2" style=" display: flex; align-items: center; justify-content: center;">
                                            <img src="../uploads/africahome-01.webp" alt="Beverages" class="img-fluid rounded">
                                        </div>

                                        <div class="card-footer">
                                            <p class="m-0 p-0">The name of Product</p>
                                            <small>Discription is here</small>
                                            <div>
                                                <a href="#" class="btn btn-outline-secondary edit-button">Edit</a>

                                                <a href="#" class="btn btn-outline-secondary view-button">View</a>

                                                <a href="#" class="btn btn-outline-secondary hide-news-btn">Hide </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="border border-secondary rounded p-2" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                        <p class="text-secondary">Placeholder Image</p>
                                    </div>
                                    <h5 class="mt-2">Media</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="border border-secondary rounded p-2" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                        <p class="text-secondary">Placeholder Image</p>
                                    </div>
                                    <h5 class="mt-2">Other</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>