<div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3 class="mb-4">Data Pulsa</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php?page=home">Daftar</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Pulsa</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <?php
            if ($_POST) {
                if (inserttransaksi($_POST) > 0) {
                    echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Pulsa berhasil dipesan.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                    ';
                } else {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Pulsa gagal dipesan.
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
                                <h4 class="card-title">Data Pulsa</h4>
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
                                                <th>PENJUAL</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = query("SELECT dp.*, a.`nama` FROM data_pulsa dp JOIN admin a ON dp.`id_admin` = a.`id_admin`");
                                            while ($row = mysqli_fetch_object($result)) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?= $row->id_pulsa ?></td>
                                                    <td><?= $row->provider ?></td>
                                                    <td><?= $row->nominal ?></td>
                                                    <td><?= rupiah($row->harga) ?></td>
                                                    <td><?= $row->nama ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pesan<?= $row->id_pulsa ?>">
                                                            Pesan
                                                        </button>
                                                        <div class="modal fade" id="pesan<?= $row->id_pulsa ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel1">Pesan Pulsa</h5>
                                                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                            <i data-feather="x"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="" method="post">
                                                                            <input type="hidden" name="id_pulsa" value="<?= $row->id_pulsa ?>">
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
                                                                        <button type="submit" class="btn btn-primary ml-1">Pesan</button>
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