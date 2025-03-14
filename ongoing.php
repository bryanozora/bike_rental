<?php
    include 'includes/connection.php';

    if(isset($_GET['pay'])){
        $id_detail_penyewaan = $_GET['id'];
        $idebike = $_GET['idebike'];
        $msg = $ebikeui->pay($detail_penyewaan, $penyewaan, $ebike, $id_detail_penyewaan, $idebike);
    }

    if(isset($_GET['pengaman'])){
        if ($_GET['pengaman'] == 1) {
            $idebike = $_GET['idebike'];
            $msg = $ebikeui->aktifkanPengaman($ebike, $idebike);
        } else {
            $idebike = $_GET['idebike'];
            $msg = $ebikeui->nonaktifkanPengaman($ebike, $idebike);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Inline styling -->
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
<div class="navbar-area">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #09111a;">
            <div class="container-fluid">
                <a class="navbar-brand ms-4"> <img src="/proyekADSI/proyekADSI/resources/electric.png" width="50" height="40" alt="">
                </a></a>
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
                                <a class="nav-link" aria-current="page" href="estationuser.php">Estation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="ongoing.php">Ongoing</a>
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
            $check_data = $penyewaan->check_data();

            if ($check_data->rowCount() == 0) : ?>
                <p>Tidak ada Estation yang ditambahkan.</p>
            <?php else : ?>
                <br />
                <div class="container">
                    <?= isset($msg) ? '<div class="alert alert-danger">' . $msg . '</div>' : '' ?>

                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_dibayar') ? '<div class="alert alert-success">berhasil dibayar</div>' : '' ?>
                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_aktifkan') ? '<div class="alert alert-success">berhasil diaktifkan</div>' : '' ?>
                    <?= (isset($_GET['msg']) && $_GET['msg'] == 'berhasil_nonaktifkan') ? '<div class="alert alert-success">berhasil dinonaktifkan</div>' : '' ?>

                <h2>Penyewaan Sedang Berjalan</h2>
                <table class="table">
                    <thead class="table-dark">
                        <th scope="col" width="50">ID</th>
                        <th scope="col" width="200">Status</th>
                        <th scope="col" width="200">Harga</th>
                        <th scope="col" width="100">Jam Sewa</th>
                        <th scope="col" width="200">ID_Akun</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($penyewaan->getAll()->fetchAll(PDO::FETCH_ASSOC) as $data):
                            if ($data['status'] == '1' && $data['id_akun'] == $_SESSION['login']){ 
                        ?>
                            <tr>
                                <td>
                                    <?= $data['id'] ?>
                                </td>
                                <td>
                                    <?= 'unpaid' ?>
                                </td>
                                <td>
                                    <?= $data['harga'] ?>
                                </td>
                                <td>
                                    <?= $data['jam_sewa'] ?>
                                </td>
                                <td>
                                    <?= $data['id_akun'] ?>
                                    <!-- <a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ongoing.php?id= <?= $data['id'] ?>&idebike=<?= $data['id_ebike'] ?>&pay=1" class="btn btn-success btn-sm">Pay</a>
                                    <?php
                                        $status_keamanan = $ebike->getBikeById($data['id_ebike'])->fetch(PDO::FETCH_ASSOC)['status_keamanan'];
                                        if ($status_keamanan == 0) {
                                            echo '<a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ongoing.php?id=' . $data['id'] . '&idebike=' . $data['id_ebike'] . '&pengaman=1" class="btn btn-primary btn-sm">Aktifkan Pengaman</a>';
                                        } else {
                                            echo '<a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ongoing.php?id=' . $data['id'] . '&idebike=' . $data['id_ebike'] . '&pengaman=0" class="btn btn-danger btn-sm">Nonaktifkan Pengaman</a>';
                                        }
                                    ?> -->
                                </td>
                            </tr>
                        <?php } endforeach?>
                    </tbody>
                </table>
                <h2>Detail Penyewaan</h2>
                <table class="table">
                    <thead class="table-dark">
                        <th scope="col" width="50">ID</th>
                        <th scope="col" width="100">Status</th>
                        <th scope="col" width="50">ID_Penyewaan</th>
                        <th scope="col" width="50">ID_Ebike</th>
                        <th scope="col" width="100">Status Keamanan</th>
                        <th scope="col" width="200">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($detail_penyewaan->getAll()->fetchAll(PDO::FETCH_ASSOC) as $data):
                            $id_akun = $penyewaan->getIDAkun($data['id_penyewaan'])->fetch();
                            if ($data['status'] == '1' && $id_akun['id_akun'] == $_SESSION['login']){ 
                        ?>
                            <tr>
                                <td>
                                    <?= $data['id'] ?>
                                </td>
                                <td>
                                    <?= 'unpaid' ?>
                                </td>
                                <td>
                                    <?= $data['id_penyewaan'] ?>
                                </td>
                                <td>
                                    <?= $data['id_ebike'] ?>
                                </td>
                                <td>
                                    <?php
                                        if ($ebike->getBikeById($data['id_ebike'])->fetch(PDO::FETCH_ASSOC)['status_keamanan'] == 0){
                                            echo 'Tidak Aktif';
                                        } else{
                                            echo 'Aktif';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ongoing.php?id= <?= $data['id'] ?>&idebike=<?= $data['id_ebike'] ?>&pay=1" class="btn btn-success btn-sm">Pay</a>
                                    <?php
                                        $status_keamanan = $ebike->getBikeById($data['id_ebike'])->fetch(PDO::FETCH_ASSOC)['status_keamanan'];
                                        if ($status_keamanan == 0) {
                                            echo '<a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ongoing.php?id=' . $data['id'] . '&idebike=' . $data['id_ebike'] . '&pengaman=1" class="btn btn-primary btn-sm">Aktifkan Pengaman</a>';
                                        } else {
                                            echo '<a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ongoing.php?id=' . $data['id'] . '&idebike=' . $data['id_ebike'] . '&pengaman=0" class="btn btn-danger btn-sm">Nonaktifkan Pengaman</a>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php } endforeach?>
                    </tbody>
                </table>
                </div>  
            <?php endif ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>