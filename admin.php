<?php
include 'db.php';

// Handle add item
if (isset($_POST['add_item'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    $sql = "INSERT INTO table_barang (kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan) VALUES ('$kode_barang', '$nama_barang', '$harga_beli', '$harga_jual', '$stok', '$satuan')";
    $conn->query($sql);
}

// Handle edit item
if (isset($_POST['edit_item'])) {
    $id = $_POST['id'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    $sql = "UPDATE table_barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok', satuan='$satuan' WHERE id=$id";
    $conn->query($sql);
}

// Handle delete item
if (isset($_GET['delete_item'])) {
    $id = $_GET['delete_item'];
    $sql = "DELETE FROM table_barang WHERE id=$id";
    $conn->query($sql);
}

// Handle add sale
if (isset($_POST['add_sale'])) {
    $no_penjualan = $_POST['no_penjualan'];
    $nama_kasir = $_POST['nama_kasir'];
    $tgl_penjualan = $_POST['tgl_penjualan'];
    $jam_penjualan = $_POST['jam_penjualan'];
    $kode_barang = $_POST['kode_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];

    // Retrieve the current stock and name of the item
    $sql = "SELECT nama_barang, stok, harga_jual, satuan FROM table_barang WHERE kode_barang='$kode_barang'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_barang = $row['nama_barang'];
        $stok = $row['stok'];
        $harga_jual = $row['harga_jual'];
        $satuan = $row['satuan'];

        // Check if enough stock is available
        if ($stok >= $jumlah_barang) {
            // Calculate the total for this sale
            $total = $harga_jual * $jumlah_barang;

            // Insert into table_penjualan
            $sql = "INSERT INTO table_penjualan (no_penjualan, nama_kasir, tgl_penjualan, jam_penjualan, total) VALUES ('$no_penjualan', '$nama_kasir', '$tgl_penjualan', '$jam_penjualan', '$total')";
            $conn->query($sql);

            // Insert into table_detail_penjualan
            $sql = "INSERT INTO table_detail_penjualan (no_penjualan, nama_barang, harga_barang, jumlah_barang, satuan, sub_total) VALUES ('$no_penjualan', '$nama_barang', '$harga_jual', '$jumlah_barang', '$satuan', '$total')";
            $conn->query($sql);

            // Update the stock in table_barang
            $new_stok = $stok - $jumlah_barang;
            $sql = "UPDATE table_barang SET stok='$new_stok' WHERE kode_barang='$kode_barang'";
            $conn->query($sql);
        } else {
            echo "Not enough stock available.";
        }
    } else {
        echo "Item not found.";
    }
}

// Handle delete sale
if (isset($_GET['delete_sale'])) {
    $id = $_GET['delete_sale'];
    $sql = "DELETE FROM table_penjualan WHERE id=$id";
    $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ADMIN - Toko Toserba</title>
</head>
<body>
<div class="container mt-4">
    <h1>Kelola Data Barang dan Penjualan</h1>
    
    <!-- Daftar Barang -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Barang
                        <a href="index.php" class="btn btn-secondary float-end">Home</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM table_barang");
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <form method="POST">
                                        <td><?php echo $row['id']; ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"></td>
                                        <td><input type="text" name="kode_barang" value="<?php echo $row['kode_barang']; ?>"></td>
                                        <td><input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>"></td>
                                        <td><input type="number" name="harga_beli" value="<?php echo $row['harga_beli']; ?>"></td>
                                        <td><input type="number" name="harga_jual" value="<?php echo $row['harga_jual']; ?>"></td>
                                        <td><input type="number" name="stok" value="<?php echo $row['stok']; ?>"></td>
                                        <td><input type="text" name="satuan" value="<?php echo $row['satuan']; ?>"></td>
                                        <td><input type="submit" name="edit_item" value="Update" class="btn btn-primary"></td>
                                    </form>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Barang -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Barang</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="text" name="kode_barang" placeholder="Kode Barang" class="form-control mb-2" required>
                        <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control mb-2" required>
                        <input type="number" name="harga_beli" placeholder="Harga Beli" class="form-control mb-2" required>
                        <input type="number" name="harga_jual" placeholder="Harga Jual" class="form-control mb-2" required>
                        <input type="number" name="stok" placeholder="Stok" class="form-control mb-2" required>
                        <input type="text" name="satuan" placeholder="Satuan" class="form-control mb-2" required>
                        <input type="submit" name="add_item" value="Tambah Barang" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus Barang -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Hapus Barang</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $conn->query("SELECT * FROM table_barang");
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['kode_barang']; ?></td>
                                <td><?php echo $row['nama_barang']; ?></td>
                                <td><?php echo $row['harga_beli']; ?></td>
                                <td><?php echo $row['harga_jual']; ?></td>
                                <td><?php echo $row['stok']; ?></td>
                                <td><?php echo $row['satuan']; ?></td>
                                <td><a href="admin.php?delete_item=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Penjualan -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Penjualan</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="text" name="no_penjualan" placeholder="No Penjualan" class="form-control mb-2" required>
                        <input type="text" name="nama_kasir" placeholder="Nama Kasir" class="form-control mb-2" required>
                        <input type="date" name="tgl_penjualan" placeholder="Tanggal Penjualan" class="form-control mb-2" required>
                        <input type="time" name="jam_penjualan" placeholder="Jam Penjualan" class="form-control mb-2" required>
                        <input type="text" name="kode_barang" placeholder="Kode Barang" class="form-control mb-2" required>
                        <input type="number" name="jumlah_barang" placeholder="Jumlah Barang" class="form-control mb-2" required>
                        <input type="submit" name="add_sale" value="Tambah Penjualan" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus Penjualan -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Hapus Penjualan</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>No Penjualan</th>
                                <th>Nama Kasir</th>
                                <th>Tanggal Penjualan</th>
                                <th>Jam Penjualan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $conn->query("SELECT * FROM table_penjualan");
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['no_penjualan']; ?></td>
                                <td><?php echo $row['nama_kasir']; ?></td>
                                <td><?php echo $row['tgl_penjualan']; ?></td>
                                <td><?php echo $row['jam_penjualan']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <td><a href="admin.php?delete_sale=<?php echo $row['id']; ?>" class="btn btn-danger">Hapus</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
