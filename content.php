<?php

// mempermudah membuat menu website dengan method get
switch ($_GET['page']) {
    case 'pelanggan':
        include "pelanggan/index.php";
        break;

    case 'data_pulsa':
        $_SESSION['level'] == 'pelanggan' ? include "data_pulsa/index2.php" : include "data_pulsa/index.php";
        break;

    case 'transaksi':
        $_SESSION['level'] == 'pelanggan' ? include "transaksi/index2.php" : include "transaksi/index.php";
        break;

    case 'detail_transaksi':
        include "detail_transaksi/index.php";
        break;

    default:
        if ($_SESSION['level'] == 'admin') {
        ?>
            <h1>KELOLA PENJUALAN PULSA ELEKTRONIK</h1>
            <img src="https://i1.wp.com/jakpat.net/info/wp-content/uploads/2019/09/Penukaran_ke_PULSA.png" alt="" class="mt-4">
        <?php
        } else {
            ?>
            <h1>TOKO PULSA ELEKTRONIK</h1>
            <img src="https://i1.wp.com/jakpat.net/info/wp-content/uploads/2019/09/Penukaran_ke_PULSA.png" alt="" class="mt-4">
        <?php
        }
        break;
}
