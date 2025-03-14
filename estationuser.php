<?php
    include 'includes/connection.php';
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
<body style ="background-color: rgb(0,0,0)">
<div class="navbar-area">
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #09111a;">
            <div class="container-fluid">
                <a class="navbar-brand ms-4"> 
                <img src="resources/electric.png" width="50" height="40" alt="">
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
                                <a class="nav-link active" aria-current="page" href="estationuser.php">E-Station</a>
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
            $check_data = $estation->check_data();

            if ($check_data->rowCount() == 0) : ?>
                <p>Tidak ada Estation yang ditambahkan.</p>
            <?php else : ?>
                <br />
                <div class="container">
                <h2 style="color: white;">List Estation</h2>
                <table class="table">
                    <thead class="table-dark">
                        <th scope="col" width="50">ID</th>
                        <th scope="col" width="300">Alamat</th>
                        <th scope="col" width="50">Jumlah Sepeda</th>
                        <th scope="col" width="50">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($estation->getAll()->fetchAll(PDO::FETCH_ASSOC) as $data): 
                        ?>
                            <tr>
                                <td>
                                    <?= $data['id'] ?>
                                </td>
                                <td>
                                    <?= $data['alamat'] ?>
                                </td>
                                <td>
                                    <?= $ebike->getList($data['id'])->rowCount() ?>

                                </td>
                                <td>
                                    <a style="padding-left: 24px; padding-right: 24px; font-size: 18px" href="ebikeuser.php?idstation= <?= $data['id'] ?>" class="btn btn-success btn-sm">View</a>
                                </td>
                            </tr>
                        <?php endforeach?>
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