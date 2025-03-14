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

        h5 {
            background-color: #000;
            width: 40%;
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
            text-align: center;
        }

        .e-station:hover {
            transform: scale(1.05);
        }

        .content {
            margin-top: 70px;
        }

        .navbar-area .navbar {
            background-color: #000 !important;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
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

        .card {
            background-color: #212847;
            border: none;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-img-top {
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            color: #fff;
        }
    </style>

</head>

<body>
    <div class="navbar-area">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand ms-4">
                    <img src="resources/electric.png" width="50" height="40" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                    aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
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
                                <a class="nav-link active" aria-current="page" href="homeuser.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="estationuser.php">E-Station</a>
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


    <div class="container-fluid" style="background-color: #212847;">
        <div id="carouselExample" style="width: 70%; transform: translate(20%, 0%); margin-bottom: 50px;" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="resources/e-bike1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="resources/e-bike2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="resources/e-bike3.webp" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="resources/e-bike1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ride with Our E-Bike !</h5>
                        <p class="card-text">With cheap price and easy steps to rent quickly</p>
                        <a href="#" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="resources/e-bike2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Ride anywhere you want to go!</h5>
                        <a href="#" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="resources/e-bike3.webp" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Even in the mountains!</h5>
                        <a href="#" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="e-station">
        <h2 style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold;">E-Station</h2>
        <p style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold">You can see all of the e-stations available in your nearest area
            here in the city. Click the Button Below to see !
        </p>
        <a class="btn btn-dark" href="estationuser.php">Estation</a>
    </div>

    <div class="e-station">
        <h2 style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold;">Ongoing</h2>
        <p style="text-align: center; margin-bottom: 50px; color: white; font-weight: bold">You can see all of the ongoing rent that you did or
            check the status of your payment on the button below !
        </p>
        <a class="btn btn-dark" href="ongoing.php">Ongoing</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
