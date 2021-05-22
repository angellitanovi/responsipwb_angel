<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mb-4">Data Pulsa</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=home">Kelola</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pulsa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <?php
    if ($_POST && $_POST['act'] == 'edit') {
        if (updatePulsa($_POST) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data pulsa berhasil diupdate.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data pulsa gagal diupdate.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        }
    }
    elseif ($_POST['id_pulsa'] && $_POST['act'] == 'delete') {
        if (deletePulsa($_POST['id_pulsa']) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data pulsa berhasil dihapus.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data pulsa gagal dihapus.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        }
    }
    elseif ($_POST) {
        if (insertPulsa($_POST) > 0) {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data pulsa berhasil ditambahkan.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
            ';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data pulsa gagal ditambahkan.
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
                                Data Pulsa
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                                    Tambah Data Pulsa
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
                                        <th>PROVIDER</th>
                                        <th>NOMINAL</th>
                                        <th>HARGA</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = query("SELECT * FROM data_pulsa");
                                    while ($row = mysqli_fetch_object($result)) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $row->id_pulsa ?></td>
                                            <td><?= $row->provider ?></td>
                                            <td><?= $row->nominal ?></td>
                                            <td><?= rupiah($row->harga) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-info w-100 mb-2" data-bs-toggle="modal" data-bs-target="#edit<?= $row->id_pulsa ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#delete<?= $row->id_pulsa ?>">
                                                    Delete
                                                </button>
                                                <div class="modal fade" id="edit<?= $row->id_pulsa ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel1">Edit Data Pulsa</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="act" value="edit">
                                                                    <input type="hidden" name="id_pulsa" value="<?= $row->id_pulsa ?>">
                                                                    <div class="form-group">
                                                                        <label for="provider">Provider</label>
                                                                        <input type="text" name="provider" id="provider" class="form-control" value="<?= $row->provider ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nominal">Nominal</label>
                                                                        <input type="number" name="nominal" id="nominal" class="form-control" value="<?= $row->nominal ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="harga">Harga</label>
                                                                        <input type="number" name="harga" id="harga" class="form-control" value="<?= $row->harga ?>">
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
                                                <div class="modal fade" id="delete<?= $row->id_pulsa ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel1">Hapus Data Pulsa</h5>
                                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="act" value="delete">
                                                                    <input type="hidden" name="id_pulsa" value="<?= $row->id_pulsa ?>">
                                                                    <h6>Apakah anda yakin ingin menghapus data pulsa ini?</h6>
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
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data Pulsa</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="provider">Provider</label>
                            <input type="text" name="provider" id="provider" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="number" name="nominal" id="nominal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control">
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