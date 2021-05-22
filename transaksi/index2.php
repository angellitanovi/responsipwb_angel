<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mb-4">Transaksi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=home">Daftar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <?php
    if ($_POST['action'] == 'cancel') {
        if (deleteTransaksi($_POST['id_transaksi']) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Pesanan berhasil dibatalkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                    ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Pesanan gagal dibatalkan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
        }
    } elseif ($_POST) {
        if (insertDetail($_POST) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Transaksi berhasil dibayar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                    ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Transaksi gagal dibayar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
        }
    }
    ?>



    <!-- Basic Tables start -->
    <section class="section">
        <div class="row" id="basic-table">
            <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <!-- Table with no outer spacing -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-md table-bordered" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>NAMA PELANGGAN</th>
                                        <th>PULSA</th>
                                        <th>HARGA</th>
                                        <th>JENIS PULSA</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = query("SELECT * FROM transaksi  join pelanggan on transaksi.id_pelanggan=pelanggan.id_pelanggan join data_pulsa on transaksi.id_pulsa=data_pulsa.id_pulsa WHERE pelanggan.id_pelanggan = '$_SESSION[id]'");
                                    while ($row = mysqli_fetch_object($result)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $row->id_transaksi ?></td>
                                            <td><?= $row->nama_pelanggan ?></td>
                                            <td><?= $row->provider . " - " . $row->nominal ?></td>
                                            <td><?= rupiah($row->harga) ?></td>
                                            <td><?= $row->jenis_pulsa ?></td>
                                            <td>
                                                <?php
                                                $q = query("SELECT * FROM detail_transaksi WHERE id_transaksi = '$row->id_transaksi' AND sisa_bayar >= '0'");
                                                $cek = mysqli_num_rows($q);
                                                if ($cek > 0) {
                                                ?>
                                                    <span class="badge bg-danger">Sudah Bayar</span>
                                                <?php
                                                } else {
                                                ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="action" value="cancel">
                                                        <input type="hidden" name="id_transaksi" value="<?= $row->id_transaksi ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger mb-2">
                                                            Batalkan Pesanan
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#bayar<?= $row->id_transaksi ?>">
                                                        Bayar
                                                    </button>
                                                    <div class="modal fade" id="bayar<?= $row->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <?php
                                                                $q = query("SELECT * FROM detail_transaksi WHERE id_transaksi = '$row->id_transaksi'");
                                                                $u = mysqli_fetch_object($q);
                                                                if (mysqli_num_rows($q) > 0) {
                                                                ?>
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel1">Bayar Pesanan</h5>
                                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                            <i data-feather="x"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="id_transaksi" value="<?= $row->id_transaksi ?>">
                                                                            <div class="form-group" hidden>
                                                                                <label for="metode_bayar">Metode Bayar</label>
                                                                                <input type="text" name="metode_bayar" id="metode_bayar" class="form-control" value="<?= $u->metode_bayar ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="bayar">Sisa Bayar</label>
                                                                                <input type="number" name="bayar" id="bayar" class="form-control" value="<?= abs($u->sisa_bayar) ?>">
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                                            <span class="d-none d-sm-block">Close</span>
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary ml-1">Bayar</button>
                                                                        </form>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                                } else {
                                                ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Bayar Pesanan</h5>
                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id_transaksi" value="<?= $row->id_transaksi ?>">
                                                            <div class="form-group">
                                                                <label for="metode_bayar">Metode Bayar</label>
                                                                <input type="text" name="metode_bayar" id="metode_bayar" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bayar">Bayar</label>
                                                                <input type="text" name="bayar" id="bayar" class="form-control">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary ml-1">Bayar</button>
                                                        </form>
                                                    </div>
                        </div>
                    </div>
                </div>
        <?php
                                                                }
                                                            }
        ?>
        </td>
        </tr>
    <?php
                                    }
    ?>
    </tbody>
    </table>
            </div>
        </div>
</div>
</div>
</div>
</section>