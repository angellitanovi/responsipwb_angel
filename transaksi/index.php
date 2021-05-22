<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mb-4">Transaksi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=home">Kelola</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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
    } elseif ($_POST['id_transaksi'] && $_POST['act'] == 'delete') {
        if (deleteTransaksi($_POST['id_transaksi']) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Transaksi berhasil dihapus.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data Transaksi gagal dihapus.
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
                        <h4 class="card-title">
                            <div class="d-flex align-items-centenr justify-content-between">
                                Transaksi
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                    Tambah Transaksi
                                </button>
                            </div>
                        </h4>
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
                                        <th>JENIS PULSA</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = query("SELECT * FROM transaksi  join pelanggan on transaksi.id_pelanggan=pelanggan.id_pelanggan join data_pulsa on transaksi.id_pulsa=data_pulsa.id_pulsa");
                                    while ($row = mysqli_fetch_object($result)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $row->id_transaksi ?></td>
                                            <td><?= $row->nama_pelanggan ?></td>
                                            <td><?= $row->provider . " - " . $row->nominal ?></td>
                                            <td><?= $row->jenis_pulsa ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#edit<?= $row->id_transaksi ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#delete<?= $row->id_transaksi ?>">
                                                    Delete
                                                </button>
                                                <div class="modal fade" id="edit<?= $row->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel1">Edit Transaksi</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="act" value="edit">
                                                                    <input type="hidden" name="id_transaksi" value="<?= $row->id_transaksi ?>">
                                                                    <div class="form-group">
                                                                        <label for="id_pelanggan">Pelanggan</label>
                                                                        <select name="id_pelanggan" id="id_pelanggan" class="form-select">
                                                                            <?php
                                                                            $q = query("SELECT * FROM pelanggan");
                                                                            while ($r = mysqli_fetch_object($q)) {
                                                                                if ($r->id_pelanggan == $row->id_pelanggan) {
                                                                            ?>
                                                                                    <option value="<?= $r->id_pelanggan ?>" selected><?= $r->nama_pelanggan ?></option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="<?= $r->id_pelanggan ?>"><?= $r->nama_pelanggan ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="id_pulsa">Pulsa</label>
                                                                        <select name="id_pulsa" id="id_pulsa" class="form-select">
                                                                            <?php
                                                                            $q = query("SELECT * FROM data_pulsa");
                                                                            while ($r = mysqli_fetch_object($q)) {
                                                                                if ($r->id_pulsa == $row->id_pulsa) {
                                                                            ?>
                                                                                    <option value="<?= $r->id_pulsa ?>" selected><?= $r->provider . " - " . $row->nominal ?></option>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <option value="<?= $r->id_pulsa ?>"><?= $r->provider . " - " . $r->nominal ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_pulsa">Jenis Pulsa</label>
                                                                        <input type="text" name="jenis_pulsa" id="jenis_pulsa" class="form-control" value="<?= $row->jenis_pulsa ?>">
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn" data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ml-1">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="delete<?= $row->id_transaksi ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel1">Hapus Transaksi</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="act" value="delete">
                                                                    <input type="hidden" name="id_transaksi" value="<?= $row->id_transaksi ?>">
                                                                    <h6>Apakah anda yakin ingin menghapus transaksi ini?</h6>
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
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Transaksi</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="id_pelanggan">Pelanggan</label>
                            <select name="id_pelanggan" id="id_pelanggan" class="form-select">
                                <?php
                                $q = query("SELECT * FROM pelanggan");
                                while ($row = mysqli_fetch_object($q)) {
                                ?>
                                    <option value="<?= $row->id_pelanggan ?>"><?= $row->nama_pelanggan ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_pulsa">Pulsa</label>
                            <select name="id_pulsa" id="id_pulsa" class="form-select">
                                <?php
                                $q = query("SELECT * FROM data_pulsa");
                                while ($row = mysqli_fetch_object($q)) {
                                ?>
                                    <option value="<?= $row->id_pulsa ?>"><?= $row->provider . " - " . $row->nominal ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis_pulsa">Jenis Pulsa</label>
                            <input type="text" name="jenis_pulsa" id="jenis_pulsa" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>