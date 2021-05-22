<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mb-4">Detail Transaksi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=home">Kelola</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <?php
    if ($_POST && $_POST['act'] == 'edit') {
        if (updateTransaksi($_POST) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Transaksi berhasil diupdate.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Transaksi gagal diupdate.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        }
    } elseif ($_POST['id_detail'] && $_POST['act'] == 'delete') {
        if (deleteDetail($_POST['id_detail']) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Detail berhasil dihapus.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data Detail gagal dihapus.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        }
    } elseif ($_POST) {
        if (insertTransaksi($_POST) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Transaksi berhasil ditambahkan.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Transaksi gagal ditambahkan.
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
                        <h4 class="card-title">Detail Transaksi</h4>
                    </div>
                    <div class="card-content">
                        <!-- Table with no outer spacing -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-md table-bordered" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>TRANSAKSI</th>
                                        <th>TANGGAL</th>
                                        <th>METODE BAYAR</th>
                                        <th>BAYAR</th>
                                        <th>SISA BAYAR</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = query("SELECT * FROM detail_transaksi dt JOIN transaksi t ON dt.`id_transaksi` = t.`id_transaksi` JOIN data_pulsa dp ON dp.`id_pulsa` = t.`id_pulsa`");
                                    while ($row = mysqli_fetch_object($result)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $row->id_detail ?></td>
                                            <td><?= $row->provider . " - " . $row->nominal . " (" . rupiah($row->harga) . ")" ?></td>
                                            <td><?= $row->tanggal ?></td>
                                            <td><?= $row->metode_bayar ?></td>
                                            <td><?= rupiah($row->bayar) ?></td>
                                            <td><?= rupiah($row->sisa_bayar) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#delete<?= $row->id_detail ?>">
                                                    Delete
                                                </button>
                                                <div class="modal fade" id="delete<?= $row->id_detail ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel1">Hapus Detail Transaksi</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="act" value="delete">
                                                                    <input type="hidden" name="id_detail" value="<?= $row->id_detail ?>">
                                                                    <h6>Apakah anda yakin ingin menghapus detail transaksi ini?</h6>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn" data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-danger ml-1">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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