<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ciudadano Sano</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="../../assets/library/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../assets/library/toastr/toastr.min.css">
        <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
        <link rel="stylesheet" href="../../assets/css/styles.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php 
                include_once('../shared/pageTop.php');

                include_once('../shared/sidebar.php');
           ?>
            <div class="content-wrapper">
                <?php include_once('../shared/breadcrumb.php'); ?>
                <section class="content">
                    
                </section>
            </div>
            <?php include_once('../shared/footer.php'); ?>
        </div>
        <script src="../../assets/library/jquery/jquery.min.js"></script>
        <script src="../../assets/library/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/library/toastr/toastr.min.js"></script>
        <script src="../../assets/library/moment/moment.min.js"></script>
        <script src="../../assets/js/adminlte.min.js"></script>
        <script src="../../assets/js/demo.js"></script>
        <script src="../../helpers/app.js"></script>
        <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>
        <script src="./pagesCtrl.js"></script>
        <script>
            $(document).ready(pagesCtrl);
        </script>
    </body>
</html>    
