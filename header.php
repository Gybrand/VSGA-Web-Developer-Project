<!DOCTYPE html>
<html lang="en">
<?php

require 'db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
$conn->close();
require 'db.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .navbar-nav .nav-link {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="image/Logoo.png" alt="Logo" style="width:40px;" class="rounded-pill">
            </a>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Inventory Hub</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#demo">Menu</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="demo" aria-labelledby="demo" data-bs-backdrop="false">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">You are logged in as <?php echo htmlspecialchars($username); ?></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav me-auto">
                <button onclick="location.href='index.php'" class="btn btn-primary active float-start me-2 btn-lg btn-block">
                    </i> Dashboard
                </button>
            </ul>
            <br>
            <ul class="navbar-nav me-auto">
                <button onclick="location.href='admin.php'" class="btn btn-warning active float-start me-2 btn-lg btn-block">
                    <!-- <i class="fas fa-clipboard-list"> --></i> Admin
                </button>
            </ul>
            <br>
            
            <ul class="navbar-nav me-auto">
                <button onclick="location.href='laporan.php'" class="btn btn-primary active float-start me-2 btn-lg btn-block">
                    <!-- <i class="fas fa-clipboard-list"> --></i> Laporan
                </button>
            </ul>
            <br>
            <div class="d-flex justify-content-center">
                <p>Do you want to log out?</p>
            </div>
            <div class="d-flex justify-content-center">
                <button onclick="location.href='auth/logout.php'" class="btn btn-danger active float-center me-2 btn-lg btn-block">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
