<?php
error_reporting(0);

$host = "localhost";
$user = "root";
$pass = "";
$db = "responsipwb";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function rupiah($angka)
{

  $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
  return $hasil_rupiah;
}

function query($sql)
{
  global $conn;
  $result = mysqli_query($conn, $sql);
  return $result;
}

function insertPelanggan($data)
{
  global $conn;
  $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $kota = htmlspecialchars($data["kota"]);
  // tipe crud 1=insert data
  $query = "CALL manage_pelanggan ('', '$nama_pelanggan', '$no_hp', '$kota', 1)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function insertPulsa($data)
{
  global $conn;
  $provider = htmlspecialchars($data["provider"]);
  $nominal = htmlspecialchars($data["nominal"]);
  $harga = htmlspecialchars($data["harga"]);
  // tipe crud 1=insert data
  $query = "CALL manage_pulsa ('', '$provider', '$nominal', '$harga', 1)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function insertTransaksi($data)
{
  global $conn;
  $id_pulsa = htmlspecialchars($data["id_pulsa"]);
  $jenis_pulsa = htmlspecialchars($data["jenis_pulsa"]);
  $id_pelanggan = $_SESSION['level'] == 'pelanggan' ? $_SESSION['id'] : $data["id_pelanggan"];
  // tipe crud 1=insert data
  $query = "CALL manage_transaksi ('', '$id_pulsa', '$id_pelanggan', '$jenis_pulsa', 1)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function insertDetail($data)
{
  global $conn;
  $id_transaksi = htmlspecialchars($data["id_transaksi"]);
  $tanggal = "(now())";
  $bayar = htmlspecialchars($data["bayar"]);
  $metode_bayar = strtolower(htmlspecialchars($data["metode_bayar"]));
  if ($metode_bayar == 'kredit') {
    $cek = mysqli_query($conn, "SELECT id_detail, bayar FROM detail_transaksi WHERE id_transaksi = '$id_transaksi'");
    $r = mysqli_fetch_array($cek);
    $bayaranBaru = ($r['bayar'] + $bayar);
    if (mysqli_num_rows($cek)) {
      $query = "CALL manage_detailtransaksi('$r[id_detail]', '$id_transaksi', $tanggal, '$metode_bayar', '$bayaranBaru', 2)";
      mysqli_query($conn, $query);
      return mysqli_affected_rows($conn);
    } else {
      // tipe crud 1=insert data
      $query = "CALL manage_detailtransaksi('', '$id_transaksi', $tanggal, '$metode_bayar', '$bayar', 1)";
      mysqli_query($conn, $query);
      return mysqli_affected_rows($conn);
    }
  } else {
    $cek = mysqli_query($conn, "SELECT id_transaksi FROM detail_transaksi WHERE id_transaksi = '$id_transaksi'");
    if (mysqli_fetch_assoc($cek)) {
      echo "
        <script>
            alert('id transaksi sudah ada');
            document.location.href = 'index.php?page=home';
        </script>
        ";
      return false;
    } else {
      $q = query("SELECT * FROM transaksi t JOIN data_pulsa dp ON t.`id_pulsa` = dp.`id_pulsa` WHERE id_transaksi = '$id_transaksi'");
      $r = mysqli_fetch_array($q);
      if ($bayar >= $r['harga']) {
        // tipe crud 1=insert data
        $query = "CALL manage_detailtransaksi('', '$id_transaksi', $tanggal, '$metode_bayar', '$bayar', 1)";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
      } else {
        echo "
        <script>
            alert('jumlah bayar tidak sesuai');
            document.location.href = 'index.php?page=home';
        </script>
        ";
        return false;
      }
    }
  }
}

function updatePulsa($data)
{
  global $conn;
  $id_pulsa = htmlspecialchars($data["id_pulsa"]);
  $provider = htmlspecialchars($data["provider"]);
  $nominal = htmlspecialchars($data["nominal"]);
  $harga = htmlspecialchars($data["harga"]);
  // tipe crud 2=update data
  $query = "CALL manage_pulsa ('$id_pulsa', '$provider', '$nominal', '$harga', 2)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function updatePelanggan($data)
{
  global $conn;
  $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
  $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
  $no_hp = htmlspecialchars($data["no_hp"]);
  $kota = htmlspecialchars($data["kota"]);
  // tipe crud 2=update data
  $query = "CALL manage_pelanggan ('$id_pelanggan', '$nama_pelanggan', '$no_hp', '$kota', 2)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function updateTransaksi($data)
{
  global $conn;
  $id_transaksi = htmlspecialchars($data["id_transaksi"]);
  $id_pulsa = htmlspecialchars($data["id_pulsa"]);
  $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
  $jenis_pulsa = htmlspecialchars($data["jenis_pulsa"]);
  // tipe crud 2=update data
  $query = "CALL manage_transaksi ('$id_transaksi', '$id_pulsa', '$id_pelanggan', '$jenis_pulsa', 2)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function updateDetail($data)
{
  global $conn;
  $id_detail = htmlspecialchars($data["id_detail"]);
  $id_transaksi = htmlspecialchars($data["id_transaksi"]);
  $tanggal = htmlspecialchars($data["tanggal"]);
  $metode_bayar = htmlspecialchars($data["metode_bayar"]);
  $bayar = htmlspecialchars($data["bayar"]);
  // tipe crud 2=update data
  $query = "CALL manage_detailtransaksi ('$id_detail', '$id_transaksi', '$tanggal', '$metode_bayar', '$bayar', 2)";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function deletePelanggan($id_pelanggan)
{
  global $conn;
  // tipe crud 3=delete data
  mysqli_query($conn, "CALL Manage_pelanggan('$id_pelanggan', '', '', '', 3)");
  return mysqli_affected_rows($conn);
}

function deletePulsa($id_pulsa)
{
  global $conn;
  // tipe crud 3=delete data
  mysqli_query($conn, "CALL manage_pulsa('$id_pulsa', '', '', '', 3)");
  return mysqli_affected_rows($conn);
}

function deleteTransaksi($id_transaksi)
{
  global $conn;
  // tipe crud 3=delete data
  mysqli_query($conn, "CALL manage_transaksi('$id_transaksi', '', '', '', 3)");
  return mysqli_affected_rows($conn);
}

function deleteDetail($id_detail)
{
  global $conn;
  // tipe crud 3=delete data
  mysqli_query($conn, "CALL manage_detailtransaksi('$id_detail', '', '', '', '', 3)");
  return mysqli_affected_rows($conn);
}

// implementasi View
function belum_terproses()
{
  global $conn;
  $result = mysqli_query($conn, "SELECT * FROM belum_terproses");
  return $result;
}

// Implementasi Function
function LaporanTotal($id)
{
  global $conn;
  $result = mysqli_query($conn, "SELECT LaporanTotal('$id') AS total_pembayaran");
  return $result;
}
