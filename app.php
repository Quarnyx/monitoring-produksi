<!DOCTYPE html>
<html lang="en" data-topbar-color="dark" data-sidebar-color="light">

<head>
    <link href="assets/vendor/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
    <?php include 'layouts/head.php'; ?>
</head>

<body>

    <!-- START Wrapper -->
    <div class="app-wrapper">

        <!-- Topbar Start -->
        <?php include 'layouts/topbar.php'; ?>
        <!-- Topbar End -->

        <!-- App Menu Start -->
        <?php include 'layouts/sidebar.php'; ?>
        <!-- App Menu End -->

        <!-- ==================================================== -->
        <!-- Start right Content here -->
        <!-- ==================================================== -->
        <div class="page-content">

            <!-- Start Container Fluid -->
            <div class="container-fluid">
                <?php include 'layouts/content.php'; ?>

                <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h4" id="exampleModalLgLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container Fluid -->

            <!-- Footer Start -->
            <?php include 'layouts/footer.php'; ?>
            <!-- Footer End -->

        </div>
        <!-- ==================================================== -->
        <!-- End Page Content -->
        <!-- ==================================================== -->

    </div>
    <!-- END Wrapper -->

    <!-- Vendor Javascript -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/vendor/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- App Javascript -->
    <script src="assets/js/app.js"></script>
    <script src="assets/vendor/alertifyjs/build/alertify.min.js"></script>


</body>

</html>