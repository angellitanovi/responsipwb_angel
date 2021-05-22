<?php
session_start();

if (empty($_SESSION['id'])) {
    header("location:admin");
} else {
?>
    <?php include "config.php" ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

        <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/css/app.css">
        <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    </head>

    <body>
        <div id="app">
            <?php
            $query = $_SESSION['level'] == 'admin' ? query("SELECT * FROM `admin` WHERE id_admin = '$_SESSION[id]'") : query("SELECT * FROM `pelanggan` WHERE id_pelanggan = '$_SESSION[id]'");
            $user = mysqli_fetch_object($query);
            ?>
            <?php include "sidebar.php" ?>
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>

                <?php include "content.php" ?>

                <footer>
                    <div class="footer clearfix mb-0 text-muted my-5">
                        <div class="float-start">
                            <p>&copy; <?= date('Y') ?></p>
                        </div>
                        <div class="float-end">
                            <p>Created by <a href="#">Angellita Novianti</a></p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <script src="assets/vendors/apexcharts/apexcharts.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>

        <script src="assets/js/main.js"></script>
    </body>

    </html>
<?php
}
?>