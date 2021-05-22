<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
    <div class="sidebar-header">
      <div class="d-flex justify-content-between">
        <div class="align-self-center">
        <h2><?= !empty($user->nama_pelanggan) ? $user->nama_pelanggan."<h6>".$user->no_hp."</h6>" : $user->nama ?></h2>
        <h6><?= $_SESSION['level'] ?></h6>
        </div>
        <div class="toggler">
          <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
        </div>
      </div>
    </div>
    <?php
    if ($_SESSION['level'] == "admin") {
    ?>
      <div class="sidebar-menu">
        <ul class="menu">
          <li class="sidebar-title">Menu</li>

          <li class="sidebar-item<?= $_GET['page'] == 'home' ? " active" : "" ?>">
            <a href="index.php?page=home" class='sidebar-link'>
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="sidebar-title">Kelola</li>

          <li class="sidebar-item<?= $_GET['page'] == 'pelanggan' ? " active" : "" ?>">
            <a href="index.php?page=pelanggan" class='sidebar-link'>
              <i class="bi bi-file-earmark-medical-fill"></i>
              <span>Pelanggan</span>
            </a>
          </li>
          <li class="sidebar-item<?= $_GET['page'] == 'data_pulsa' ? " active" : "" ?>">
            <a href="index.php?page=data_pulsa" class='sidebar-link'>
              <i class="bi bi-file-earmark-medical-fill"></i>
              <span>Data Pulsa</span>
            </a>
          </li>
          <li class="sidebar-item<?= $_GET['page'] == 'transaksi' ? " active" : "" ?>">
            <a href="index.php?page=transaksi" class='sidebar-link'>
              <i class="bi bi-file-earmark-medical-fill"></i>
              <span>Transaksi</span>
            </a>
          </li>
          <li class="sidebar-item<?= $_GET['page'] == 'detail_transaksi' ? " active" : "" ?>">
            <a href="index.php?page=detail_transaksi" class='sidebar-link'>
              <i class="bi bi-file-earmark-medical-fill"></i>
              <span>Detail Transaksi</span>
            </a>
          </li>

          <li class="sidebar-title">Pengaturan</li>

          <li class="sidebar-item">
            <a href="admin/logout.php" class='sidebar-link'>
              <i class="bi bi-door-closed-fill"></i>
              <span>Log out</span>
            </a>
          </li>
        </ul>
      </div>
    <?php
    } else {
    ?>
      <div class="sidebar-menu">
        <ul class="menu">
          <li class="sidebar-title">Menu</li>

          <li class="sidebar-item<?= $_GET['page'] == 'home' ? " active" : "" ?>">
            <a href="index.php?page=home" class='sidebar-link'>
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="sidebar-title">Daftar</li>

          <li class="sidebar-item<?= $_GET['page'] == 'data_pulsa' ? " active" : "" ?>">
            <a href="index.php?page=data_pulsa" class='sidebar-link'>
              <i class="bi bi-file-earmark-medical-fill"></i>
              <span>Data Pulsa</span>
            </a>
          </li>
          <li class="sidebar-item<?= $_GET['page'] == 'transaksi' ? " active" : "" ?>">
            <a href="index.php?page=transaksi" class='sidebar-link'>
              <i class="bi bi-file-earmark-medical-fill"></i>
              <span>Transaksi</span>
            </a>
          </li>
          
          <li class="sidebar-title">Pengaturan</li>

          <li class="sidebar-item">
            <a href="admin/logout.php" class='sidebar-link'>
              <i class="bi bi-door-closed-fill"></i>
              <span>Log out</span>
            </a>
          </li>
        </ul>
      </div>
    <?php
    }
    ?>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>