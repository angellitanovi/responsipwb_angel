<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to our website.</p>
                    <?php
                    include "../config.php";

                    if ($_POST) {
                        $nama = htmlspecialchars(strip_tags($_POST['nama']));
                        $user = htmlspecialchars(strip_tags($_POST['username']));
                        $pass = htmlspecialchars(strip_tags($_POST['password']));
                        $confirmPass = htmlspecialchars(strip_tags($_POST['confirmPassword']));
                        $no_hp = htmlspecialchars(strip_tags($_POST['no_hp']));
                        $kota = htmlspecialchars(strip_tags($_POST['kota']));

                        if ($pass == $confirmPass) {
                            $query = "INSERT INTO pelanggan (nama_pelanggan,username,`password`,no_hp,kota) VALUES('$nama','$user','$pass','$no_hp','$kota')";
                            mysqli_query($conn, $query);
                            $status = mysqli_affected_rows($conn);
                            if ($status > 0) {
                    ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">Register success</div>
                            <?php
                            } else {
                            ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">Register failed</div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">Password are not matching</div>
                    <?php
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="nama" class="form-control form-control-xl" placeholder="Nama">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="confirmPassword" class="form-control form-control-xl" placeholder="Confirm Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="phone" name="no_hp" class="form-control form-control-xl" placeholder="No. HP">
                            <div class="form-control-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="kota" class="form-control form-control-xl" placeholder="Kota">
                            <div class="form-control-icon">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="index.php" class="font-bold">Log
                                in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>