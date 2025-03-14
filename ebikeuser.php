<?php

include 'includes/connection.php';

$id_station = $_GET['idstation'];

if (isset($_GET['select'])){
    array_push($_SESSION['selected'], $_GET['select']);
}

if (isset($_POST['sewa'])) {
    if ($_POST['jam'] == null || $_POST['jam'] == "") {
        $msg = 'Jam tidak boleh kosong';
    } else {
        $jam = $_POST['jam'];
        $harga = $jam * 8000;
        $id_user = $_SESSION['login'];
        $msg = $ebikeui->sewaEbike($penyewaan, $ebike, $detail_penyewaan, $harga, $jam, $id_user);
        $_SESSION['selected'] = [];
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
                <a class="navbar-brand ms-4"> 
                <img src="/proyekADSI/proyekADSI/resources/electric.png" width="50" height="40" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                            USER Panel
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="homeuser.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  " aria-current="page" href="estationuser.php">E-Station</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="ongoing.php">Ongoing</a>
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
        
            <?php
            $check_data = $ebike->check_data($_GET['idstation']);

            if ($check_data->rowCount() == 0) : ?>
                <p>Tidak ada Estation yang ditambahkan.</p>
            <?php else : ?>

                <br />
                <h2>Selected Sepeda</h2>
                <table class="table">
                    <thead class="table-dark">
                        <th scope="col" width="50">ID</th>
                        <th scope="col" width="100">Baterai</th>
                        <th scope="col" width="50">Status Sewa</th>
                        <th scope="col" width="50">Status Keamanan</th>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['selected']) && count($_SESSION['selected']) != 0) {
                        foreach ($ebike->getAll()->fetchAll(PDO::FETCH_ASSOC) as $data): 
                            if ($data['id_estation'] == $_GET['idstation'] && in_array($data['id'], $_SESSION['selected'])) {
                                        echo '<tr>
                                            <td>
                                                ' . $data['id'] . '
                                            </td>
                                          

                                            <td>
                                                ' . $data['baterai'] . '
                                            </td>
                                            <td>';
                                                if ($data['status_sewa'] == 0) {
                                                    echo 'Available';
                                                } else {
                                                    echo 'Sedang Disewa';
                                                } 
                                                echo '
                                            </td>
                                            <td>';
                                                if ($data['status_keamanan'] == 0) {
                                                    echo 'Nonaktif';
                                                } else {
                                                    echo 'Aktif';
                                                }
                                                echo '
                                            </td>
                                        </tr>';    
                            }
                        endforeach;
                        }
                        ?>
                    </tbody>
                </table>
                <form method="post">
                    <p>Jam</p>
                    <input type="text" name="jam" id="" class="form-control form-control-lg" placeholder="Input Jam Sewa"><br/>
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark btn-lg mt-3 mb-5" name="sewa">Sewa</button>
                    </div>
                </form>
                <h2>List Sepeda</h2>
                <table class="table">
                    <thead class="table-dark">
                        <th scope="col" width="50">ID</th>
                        <th scope="col" width="100">Baterai</th>
                        <th scope="col" width="100">Status Sewa</th>
                        <th scope="col" width="100">Status Keamanan</th>
                        <th scope="col" width="50">Aksi</th>
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
                                        } else {
                                            echo 'Sedang Disewa';
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
                                    <a class="btn btn-primary" href="ebikeuser.php?idstation=<?=$_GET['idstation']?>&select=<?=$data['id']?>">Select</a>
                                </td>
                            </tr>
                        <?php } 
                        endforeach?>
                    </tbody>
                </table>
            <?php endif ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>