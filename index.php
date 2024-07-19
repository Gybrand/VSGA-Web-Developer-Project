<?php
include 'db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM table_barang WHERE nama_barang LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>HOME - Toko Toserba</title>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Barang
                            <a href="admin.php" class="btn btn-warning float-end ms-2">Admin</a>
                            <a href="laporan.php" class="btn btn-primary float-end">Penjualan</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Nama Barang" value="<?php echo $search; ?>">
                                <button type="submit" class="btn btn-success">Cari</button>
                            </div>
                        </form>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['kode_barang']; ?></td>
                                        <td><?php echo $row['nama_barang']; ?></td>
                                        <td><?php echo $row['harga_beli']; ?></td>
                                        <td><?php echo $row['harga_jual']; ?></td>
                                        <td><?php echo $row['stok']; ?></td>
                                        <td><?php echo $row['satuan']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
