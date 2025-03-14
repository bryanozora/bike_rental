<?php

include 'includes/connection.php';

$id_station = $_GET['idstation'];

if (isset($_POST['entry'])) {
    $baterai = $_POST['baterai'];
    $status_sewa = $_POST['status_sewa'];
    $status_keamanan = $_POST['status_keamanan'];
    $id_station = $_GET['idstation'];
    if (isset ($_GET['edit'])){
        $id = $_GET['id'];
        $msg = $ebikeui->editEbike($ebike, $id, $baterai, $status_sewa, $status_keamanan, $id_station);
    }
    else {
        $msg = $ebikeui->addEbike($ebike, $baterai, $status_sewa, $status_keamanan, $id_station);
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['delete'] == 1) {
        $id = $_GET['id'];
        $msg = $ebikeui->deleteEbike($ebike, $id);
    }
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
                                <a class="nav-link" aria-current="page" href="penyewaannadmin.php">Penyewaan</a>
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
                    <h2><?php if(isset($_GET['edit'])) echo 'Edit Ebike - ' . $_GET['id']; else echo 'Add Ebike' ?></h2>

                    <?= isset($msg) ? '<div class="alert alert-danger">' . $msg . '</div>' : '' ?>

                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_ditambahkan') ? '<div class="alert alert-success">Data berhasil ditambahkan</div>' : '' ?>
                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_dihapus') ? '<div class="alert alert-success">Data berhasil dihapus</div>' : '' ?>
                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_diedit') ? '<div class="alert alert-success">Data berhasil diedit</div>' : '' ?>
                
                    <p>Baterai</p>
                    <input type="text" name="baterai" id="" class="form-control form-control-lg" placeholder="<?php if(isset($_GET['edit'])) echo 'input baterai baru'; else echo 'input baterai' ?>"><br/>
                    <p>Status Sewa</p>
                    <select class="form-control" name="status_sewa" id="">
                        <option value="0">Available</option>
                        <option value="1">Sedang Disewa</option>
                        <option value="2">Unavailable</option>
                    </select><br />
                    <p>Status Keamanan</p>
                    <select class="form-control" name="status_keamanan" id="">
                        <option value="0">Nonaktif</option>
                        <option value="1">Aktif</option>
                    </select><br />
                    <p>Estation</p>
                    <!-- <select class="form-control" name="id_station" id="">
                        <?php
                        foreach ($estation->getAll()->fetchAll(PDO::FETCH_ASSOC) as $data): 
                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['alamat'] ?></option>
                        <?php endforeach?>
                    </select><br /> -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark btn-lg mt-3 mb-5" name="entry"><?php if(isset($_GET['edit'])) echo 'Edit'; else echo 'Add' ?></button>
                    </div>
                </form>
            </div>

            <?php
            $check_data = $ebike->check_data($_GET['idstation']);

            if ($check_data->rowCount() == 0) : ?>
                <p>Tidak ada Ebike yang ditambahkan.</p>
            <?php else : ?>

                <br />
                <table class="table">
                    <thead class="table-dark">
                        <th scope="col" width="50">ID</th>
                        <th scope="col" width="100">Baterai</th>
                        <th scope="col" width="100">Status Sewa</th>
                        <th scope="col" width="100">Status Keamanan</th>
                        <!-- <th scope="col" width="100">ID Estation</th> -->
                        <th scope="col" width="200">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ebike->getAll()->fetchAll(PDO::FETCH_ASSOC) as $data): 
                            if ($data['id_estation'] == $_GET['idstation']) {
                        ?>
                            <tr>
                                <td>
                                    <?= $data['id'] ?>
                                </td>
                                <td>
                                    <?= $data['baterai'] ?>
                                </td>
                                <td>
                                    <?php
                                        if ($data['status_sewa'] == 0) {
                                            echo 'Available';
                                        } else if ($data['status_sewa'] == 1) {
                                            echo 'Sedang Disewa';
                                        } else {
                                            echo 'Unavailable';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if ($data['status_keamanan'] == 0) {
                                            echo 'Nonaktif';
                                        } else {
                                            echo 'Aktif';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ebikeadmin.php?idstation=<?= $_GET['idstation']?>&id= <?= $data['id'] ?>&edit=1" class="btn btn-primary btn-sm">Edit</a>
                                    <a style="padding-left: 18px; padding-right: 18px; font-size: 18px" href="ebikeadmin.php?idstation=<?= $_GET['idstation']?>&id= <?= $data['id'] ?>&delete=1" class="btn btn-danger btn-sm">Remove</a>
                                </td>
                            </tr>
                        <?php } 
                        endforeach?>
                    </tbody>
                </table>

            <?php endif ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>