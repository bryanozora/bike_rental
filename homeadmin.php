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
            background-color: #000;
            color: #fff;
        }

        .e-station {
            display: inline-block;
            width: 30%;
            margin-left: 180px;
            border: 3px solid white;
            padding: 20px;
            margin-bottom: 100px;
            border-radius: 30px;
            transition: transform 0.3s ease;
            text-align : center;
        }

        .e-station:hover {
            transform: scale(1.05);
        }

        .btn-dark {
            background-color: #ffd800 !important;
            color: #000 !important;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #000 !important;
            color: #ffd800 !important;
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
                                <a class="nav-link active" aria-current="page" href="homeadmin.php">Home</a>
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

    <div class="container-fluid">
        <h2></h2>
        <h2></h2>
        <div class="e-station container">
            <h2 style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold;">E-Station</h2>
            <p style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold">You can see all of the e-stations available in your nearest area
                here in the city. Click the Button Below to see !
            </p>
            <a class="btn btn-dark" href="estationadmin.php">Estation</a>
        </div>

        <div class="e-station container">
            <h2 style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold;">Penyewaan</h2>
            <p style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold">You can see all of the ongoing rent that you did or
                check the status of your payment on the button below !
            </p>
            <div style = "align-items : center">
            <a class="btn btn-dark" href="penyewaanadmin.php">Penyewaan</a>
            </div>
        </div>
    </div>
    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>