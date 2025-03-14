<?php

include 'includes/connection.php';

if (isset($_POST['entry'])) {
    $status = $_POST['status'];
    $harga = $_POST['harga'];
    $jam = $_POST['jam'];
    $id = $_GET['id'];
    $msg = $ebikeui->editDetailPenyewaan($detail_penyewaan, $id, $status);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Styling -->
    <style>
       
         @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .content-web {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }

        .table-dark tbody {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="navbar-area">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #09111a;">
            <div class="container-fluid">
                <a class="navbar-brand ms-4"> <b>ADMIN</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                            Admin Panel
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="homeadmin.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="estationadmin.php">E-Station List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="penyewaanadmin.php">Penyewaan</a>
                            </li>
                            <li class="nav-item ms-auto">
                                <a class="nav-link" aria-current="page" href="index.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="content-web my-5">
        <div class="col-md-12">
                <form method="post">
                    <?= isset($msg) ? '<div class="alert alert-danger">' . $msg . '</div>' : '' ?>
                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_ditambahkan') ? '<div class="alert alert-success">Data berhasil ditambahkan</div>' : '' ?>
                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_dihapus') ? '<div class="alert alert-success">Data berhasil dihapus</div>' : '' ?>
                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_diedit') ? '<div class="alert alert-success">Data berhasil diedit</div>' : '' ?>

                    <?php
                        if (isset($_GET['edit'])) {
                            echo '<h2>Edit Detail Penyewaan - ' . $_GET['id'] . '</h2>
                            <p>status</p>
                            <select class="form-control" name="status" id="">
                                <option value="1">Unpaid</option>
                                <option value="2">Paid</option>
                            </select><br />
        
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark btn-lg mt-3 mb-5" name="entry">Edit</button>
                            </div>';
                        }
                    ?>
                </form>
            </div>

            <?php
            $check_data = $detail_penyewaan->check_data();

            if ($check_data->rowCount() == 0) : ?>
                <p>Tidak ada detail penyewaan yang ditambahkan.</p>
            <?php else : ?>

                <br />
                <h2>Detail Penyewaan List - ID Penyewaan <?= $_GET['idpenyewaan'] ?></h2>
                <table class="table">
                    <thead class="table-dark">
                        <th scope="col" width="250">ID</th>
                        <th scope="col" width="200">Status</th>
                        <th scope="col" width="200">ID_Penyewaan</th>
                        <th scope="col" width="200">ID_Ebike</th>
                        <th scope="col" width="200">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($detail_penyewaan->getAll()->fetchAll(PDO::FETCH_ASSOC) as $data): 
                        ?>
                            <tr>
                                <td>
                                    <?= $data['id'] ?>
                                </td>
                                <td>
                                <?php if ($data['status'] == 1) {
                                        echo 'unpaid';
                                    } else {
                                        echo 'paid';
                                    } ?>
                                </td>
                                <td>
                                    <?= $data['id_penyewaan'] ?>
                                </td>
                                <td>
                                    <?= $data['id_ebike'] ?>
                                </td>
                                <td>
                                    <a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="detailpenyewaanadmin.php?idpenyewaan= <?= $_GET['idpenyewaan'] ?>&id=<?=$data['id']?>&edit=1" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>

            <?php endif ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>