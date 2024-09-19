<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>PENJUALAN - Toko Toserba</title>
</head>

<body>
    <?php include ('header.php'); ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Penjualan
                            <a href="index.php" class="btn btn-secondary float-end">Home</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h2>Summary Penjualan</h2>

                        <!-- Search Form -->
                        <form method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search_1" class="form-control" placeholder="Nama Barang"
                                    value="<?php echo isset($_GET['search_1']) ? $_GET['search_1'] : ''; ?>">
                                <button type="submit" class="btn btn-success">Cari</button>
                            </div>
                        </form>

                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah Penjualan</th>
                                        <th>Satuan</th>
                                        <th>Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch search term
                                    $search = isset($_GET['search_1']) ? $_GET['search_1'] : '';

                                    // Modify query to filter by 'Nama Barang' if search term is provided
                                    if (!empty($search)) {
                                        $stmt = $conn->prepare("SELECT tb.kode_barang, tb.nama_barang, td.harga_barang AS harga_jual, 
                                                            SUM(td.jumlah_barang) AS jumlah_penjualan, td.satuan, 
                                                            SUM(td.sub_total) AS total_penjualan
                                                            FROM table_detail_penjualan td
                                                            JOIN table_barang tb ON td.nama_barang = tb.nama_barang
                                                            WHERE tb.nama_barang LIKE ?
                                                            GROUP BY tb.kode_barang, tb.nama_barang, td.harga_barang, td.satuan");
                                        $searchTerm = "%$search%";
                                        $stmt->bind_param("s", $searchTerm);
                                    } else {
                                        $stmt = $conn->prepare("SELECT tb.kode_barang, tb.nama_barang, td.harga_barang AS harga_jual, 
                                                            SUM(td.jumlah_barang) AS jumlah_penjualan, td.satuan, 
                                                            SUM(td.sub_total) AS total_penjualan
                                                            FROM table_detail_penjualan td
                                                            JOIN table_barang tb ON td.nama_barang = tb.nama_barang
                                                            GROUP BY tb.kode_barang, tb.nama_barang, td.harga_barang, td.satuan");
                                    }

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['kode_barang']; ?></td>
                                            <td><?php echo $row['nama_barang']; ?></td>
                                            <td><?php echo $row['harga_jual']; ?></td>
                                            <td><?php echo $row['jumlah_penjualan']; ?></td>
                                            <td><?php echo $row['satuan']; ?></td>
                                            <td><?php echo $row['total_penjualan']; ?></td>
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


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Penjualan</h4>
                    </div>

                    <div class="card-body">
                        <!-- Search Form -->
                        <form method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search_2" class="form-control" placeholder="Nama Barang"
                                    value="<?php echo isset($_GET['search_2']) ? $_GET['search_2'] : ''; ?>">
                                <button type="submit" class="btn btn-success">Cari</button>
                            </div>
                        </form>

                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No Penjualan</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Satuan</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch search term
                                    $search = isset($_GET['search_2']) ? $_GET['search_2'] : '';

                                    // Modify the SQL query based on the search input
                                    if (!empty($search)) {
                                        $stmt = $conn->prepare("SELECT * FROM table_detail_penjualan WHERE nama_barang LIKE ?");
                                        $searchTerm = "%$search%";
                                        $stmt->bind_param("s", $searchTerm);
                                    } else {
                                        $stmt = $conn->prepare("SELECT * FROM table_detail_penjualan");
                                    }

                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['no_penjualan']; ?></td>
                                            <td><?php echo $row['nama_barang']; ?></td>
                                            <td><?php echo $row['harga_barang']; ?></td>
                                            <td><?php echo $row['jumlah_barang']; ?></td>
                                            <td><?php echo $row['satuan']; ?></td>
                                            <td><?php echo $row['sub_total']; ?></td>
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