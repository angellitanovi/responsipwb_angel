<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                    <?php
                    include "../config.php";

                    session_start();

                    if ($_POST) {
                        $user = htmlspecialchars(strip_tags($_POST['username']));
                        $pass = htmlspecialchars(strip_tags($_POST['password']));

                        $tabel = ['admin', 'pelanggan'];

                        $status = null;

                        $data = [];

                        foreach ($tabel as $t) {
                            $query = "SELECT * FROM $t WHERE username = '$user' AND password = '$pass'";
                            $login = mysqli_query($conn, $query);
                            $cek = mysqli_num_rows($login);

                            if ($cek > 0) {
                                $status = true;
                                $data = mysqli_fetch_array($login);
                                break;
                            } else {
                                $status = false;
                            }
                        }

                        if ($status > 0) {
                            if (!empty($data['id_admin'])) {
                                $_SESSION['id'] = $data['id_admin'];
                                $_SESSION['level'] = "admin";
                                header("location:../index.php?page=home");
                            } else {
                                $_SESSION['id'] = $data['id_pelanggan'];
                                $_SESSION['level'] = "pelanggan";
                                header("location:../index.php?page=home");
                            }
                        } else {
                    ?>
                            <div class="alert alert-danger alert-dismissible show fade">
                                Incorrect username or password.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <form action="" method="post">
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
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="register.php" class="font-bold">Sign
                                up</a>.</p>
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