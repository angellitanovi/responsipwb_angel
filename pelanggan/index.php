<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mb-4">Pelanggan</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=home">Kelola</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <?php
    // jika ada request post dihalaman edit maka updatepelanggan 
    if ($_POST && $_POST['act'] == 'edit') {
        if (updatePelanggan($_POST) > 0) {
            echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Pelanggan berhasil diupdate.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        ';
        } else {
            echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Pelanggan gagal diupdate.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        ';
        }
    }
    // jika ada request get id dan post act delete maka deletepelanggan  berdasarkan id
    elseif ($_POST['id_pelanggan'] && $_POST['act'] == 'delete') {
        if (deletePelanggan($_POST['id_pelanggan']) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data pelanggan berhasil dihapus.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data pelanggan gagal dihapus.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        }
    }
    // jika ada request post dihalaman home maka insertpelanggan 
    elseif ($_POST) {
        if (insertPelanggan($_POST) > 0) {
            // feedback
            echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Pelanggan berhasil ditambahkan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                        ';
        } else {
            echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pelanggan gagal ditambahkan.
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
                                Pelanggan
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                    Tambah Pelanggan
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
                                        <th>NOMOR HP</th>
                                        <th>KOTA</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = query("SELECT * FROM pelanggan");
                                    while ($row = mysqli_fetch_object($result)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $row->id_pelanggan ?></td>
                                            <td><?= $row->nama_pelanggan ?></td>
                                            <td><?= $row->no_hp ?></td>
                                            <td><?= $row->kota ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#edit<?= $row->id_pelanggan ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#delete<?= $row->id_pelanggan ?>">
                                                    Delete
                                                </button>
                                                <div class="modal fade" id="edit<?= $row->id_pelanggan ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel1">Edit Pelanggan</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="act" value="edit">
                                                                    <input type="hidden" name="id_pelanggan" value="<?= $row->id_pelanggan ?>">
                                                                    <div class="form-group">
                                                                        <label for="nama_pelanggan">Nama Pelanggan</label>
                                                                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="<?= $row->nama_pelanggan ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="no_hp">No. HP</label>
                                                                        <input type="phone" name="no_hp" id="no_hp" class="form-control" value="<?= $row->no_hp ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kota">Kota</label>
                                                                        <input type="text" name="kota" id="kota" class="form-control" value="<?= $row->kota ?>">
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
                                                <div class="modal fade" id="delete<?= $row->id_pelanggan ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel1">Hapus Pelanggan</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="act" value="delete">
                                                                    <input type="hidden" name="id_pelanggan" value="<?= $row->id_pelanggan ?>">
                                                                    <h6>Apakah anda yakin ingin menghapus pelanggan ini?</h6>
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
                    <h5 class="modal-title" id="myModalLabel1">Tambah Pelanggan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. HP</label>
                            <input type="phone" name="no_hp" id="no_hp" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control">
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